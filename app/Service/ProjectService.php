<?php

namespace App\Service;

use App\Models\Department;
use App\Models\Project;
use App\Models\User;
use App\Service\UserService;
use Illuminate\Support\Facades\Auth;
use App\Models\Assessment;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Nette\Utils\Html;
use function Termwind\render;

class ProjectService
{
    public function __construct()
    {
        $userService = new UserService();
        $this->isAdmin = $userService->isAdmin();
        $this->isViewer = $userService->isViewer();
        $this->isAdminDept = $userService->isAdminDept();
    }

    public function getDepartment($type,$id){
        $dep =  Department::where('type',$type);
        if($id && $type == Department::TYPE['sub-department']){
            $dep->where('parent',$id);
        }
        if(!$this->isAdmin && !$this->isViewer
            && $type == Department::TYPE['department']){
            $dep->where('id', auth()->user()->department);
        }
        if(!$this->isAdmin && !$this->isViewer
            && $type == Department::TYPE['sub-department']){
            $dep->where('parent', auth()->user()->department);
        }
        return $dep->get();
    }

    public function projectNotAuthorized(Project $project){
        return (!$this->isAdmin &&
            $project->owner != Auth::user()->department);
    }

    public function priceToText($price){
        $price = str_replace('.', '', $price);
        return $price;
    }

    /**
     * Get All Project
     * @param $paginate
     * @return mixed
     */
    public function getAllProject($paginate){
        $department = auth()->user()->department;

        $project = Project::with(['createdBy','assessment','fel1','fel2','fel3',
            'business_case','cost_benefits'])
            ->filter(request(['q','owner','sponsor','category','type']));

        /*
         * Get All Data based on Admin Dept
         */
        if($this->isAdminDept){
            $project = $project->where('owner',$department);

        }

        if($paginate){
            $project = $project->orderBy('created_at', 'DESC')->paginate(20)->withQueryString();
        }

        return $project;
    }

    /**
     * Get Bc Status Project And Render Component Icon
     * Mature or Not Mature
     * @param Project $project
     * @return string
     */
    public function getBcStatus(Project $project){
        $templateLabel = '<span class="js-badge-status badge badge-danger">Not Mature</span>';
        $bg = 'bg-danger';
        $checked = '';
        if($project->bc_status == 'mature'){
            $templateLabel = '<span class="js-badge-status badge badge-success">Mature</span>';
            $bg = '';
            $checked = 'checked';
        }
        /*
         * Check if empty bc status render empty template
         */
        if(!$project->bc_status){
            $templateLabel = '<span class="js-badge-status badge">-</span>';
        }

        /*
        * Check permission for admin can update bc status
        */
        if($this->isAdmin){
            $template = '<div class="media" style="display: inline-block;">
                            <div class="media-body icon-state switch-outline mb-1">
                              <label class="switch">
                                <input class="js-switch-bc_status" data-id="'.$project->id.'" type="checkbox" '.$checked.'><span class="switch-state '.$bg.'"></span>
                              </label>
                            </div>
                            <div>
                                '.$templateLabel.'
                            </div>
                        </div>';
        } else {
            return '-';
        }

        return $template;
    }

    /**
     * Get Icon For Assessment and URL
     * @param Project $project
     * @return string
     */
    public function getRelatedDataProjectStatus(Project $project, $data, $type){
        $userService = new UserService();

        $url = '';
        switch ($type){
            case config('constants.related_data.assessment'):
                $url = "assessment";
                break;
            case config('constants.related_data.fel1'):
                $url = "fel1";
                break;
            case config('constants.related_data.fel2'):
                $url = "fel2";
                break;
            case config('constants.related_data.fel3'):
                $url = "fel3";
                break;
            case config('constants.related_data.business-case'):
                $url = "business-case";
                break;

        }

        // check if data not exist and select template url is it user can create the data or not
        if(!$data){
            return ' <a class="js-set-session setting-primary-custom bg-cross" data-url="'.$url.'"
            data-action="create" data-id="'.$project->id.'"
            href="/project/'.$project->id.'">
                        <i class="fa fa-times text-white text-large-custom"></i>
                        <div class="loader-box d-none">
                            <div class="loader-2"
                                style="width: 25px !important;
                                height: 25px !important;
                                border-right-color: white;
                                border-left-color: white">
                            </div>
                        </div>
                    </a>';
        }

        $icon = 'fa fa-check';
        $bgColor = 'bg-check';
        if($data->status == 'DRAFT'){
            $icon = 'fa fa-file-text-o';
            $bgColor = 'bg-draft';
        }

        // select template if data is draft or publish
        $template = '<a class="js-set-session setting-primary-custom '.$bgColor.'" data-id="'.$project->id.'" data-url="'.$url.'" href="/project/'.$project->id.'">
                        <i class="'.$icon.' text-white text-large-custom"></i>
                        <div class="loader-box d-none">
                            <div class="loader-2"
                                style="width: 25px !important;
                                height: 25px !important;
                                 border-right-color: white;
                                border-left-color: white">
                            </div>
                        </div>
                    </a>';

        return $template;
    }

    /**
     * Render Template Note in Project List Based On Role Admin
     * @param Project $project
     * @return string
     */
    public function getNoteTemplateForm(Project $project){
        $userService = new UserService();
        $isAdmin = $userService->isAdmin();

        $template = '';

        if($isAdmin){
            $template = '
                    <span class="alert-note alert-color-green">
                        <img src="'.asset('vendor/feather-icons/edit-green.svg').'" width="25" height="25"/>
                    </span>';
        }

        if(isset($project->note) && $project->note != '' && !$isAdmin){
            $template = '
                    <span class="alert-color-red">
                        <img src="'.asset('vendor/feather-icons/alert-triangle-red.svg').'" width="25" height="25" />
                    </span>';
        }

        return $template;
    }

    public function getTemplateCheck($value){

        if($value == 1){
            return '<i class="fa fa-check-circle-o text-check text-small-custom"></i>';
        }

        return '<i class="fa fa-times-circle-o text-time text-small-custom"></i>';
    }

    public function getTemplateExpandChar($value){
        $valueString = strip_tags($value);
        $valueLimit = Str::limit($valueString,255);
        $isOverChar = strlen($valueString) > 255;
        $isHide = $isOverChar ? 'd-none' : '';
        $buttonLimitCharacter = '';

        if($isOverChar){
            $buttonLimitCharacter = '
                            <span class="alert-note js-hide-text">
                                <i class="fa fa-arrow-left text-check"></i>
                            </span>';
        }

        $tempLimit = '
            <div class="js-limit-char js-show-char">
                <div>'.$valueLimit.'</div>
                <div class="alert-note js-expand-text">
                    <i class="fa fa-arrow-right text-check"></i>
                </div>
            </div>
        ';

        $tempFull = '
            <div class="js-expand-char js-show-char '.$isHide.'">
                '.$value.'
                '.$buttonLimitCharacter.'
            </div>
        ';


        if($isOverChar){
            return $tempLimit . $tempFull;
        }

        return $tempFull;
    }


}



