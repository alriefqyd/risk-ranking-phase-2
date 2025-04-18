<?php

namespace App\Service;

use App\Mail\NoteRemarkEmail;
use App\Mail\SubmissionNotificationEmail;
use App\Models\CapexInvestment;
use App\Models\CriteriasProjects;
use App\Models\Department;
use App\Models\Project;
use App\Models\Setting;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PHPUnit\Exception;

class ProjectService
{
    /**
     * Constructor to Initialize
     */
    public function __construct()
    {
        $userService = new UserService();
        $this->isAdmin = $userService->isAdmin();
        $this->isViewer = $userService->isViewer();
        $this->isAdminDept = $userService->isAdminDept();
    }

    /**
     * Get Department in All Area
     * @param $type
     * @param $id
     * @return mixed
     */
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
        return $dep->where('status','ACTIVE')->get();
    }

    public function projectNotAuthorized(Project $project){
        return (!$this->isAdmin &&
            $project->operation_area != Auth::user()->department);
    }

    public function priceToText($price){
        $price = str_replace('.', '', $price);
        return $price;
    }

    public function getAllProjectStatus($year){
        return $this->getAllProject(false,$year,null,false);
    }
    /**
     * Get All Project
     * @param $paginate
     * @return mixed
     */
    public function getAllProject($paginate, $year, $isHomePage = null, $isCountStatus = true){
        $department = auth()->user()->department;

        if(!isset($year)) {
            $year = date('Y') + 1;
        }

        $owner = 'owner';
        if($year >= config('constants.project_presented_year')){
            $owner = 'operation_area';
        }

        $filter = ['q','operation_area','sponsor_area','category','type'];
        if($isCountStatus) $filter = ['q','operation_area','sponsor_area','category','type','status'];
        if($year < config('constants.project_presented_year')){
            $new = ['owner','sponsor'];
            $filter = array_merge($new,$filter);
        }
        $project = Project::with(['createdBy','assessment','fel1','fel2','fel3',
            'business_case','cost_benefits'])
            ->filter(request($filter))->where('presented_year', $year);


        /*
         * Get All Data based on Admin Dept
         */
        if($this->isAdminDept){
            $project = $project->where($owner,$department);
        }

        if($year) {
            $project = $project->orderBy('created_at', 'DESC');
            if(!$isHomePage) $project = $project->paginate(20)->withQueryString();
        }

        if($paginate && !$year){
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
            return $templateLabel;
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

    /**
     * Get Template Icon
     * @param $value
     * @return string
     */
    public function getTemplateCheck($value){

        if($value == 1){
            return '<i class="fa fa-check-circle-o text-check text-small-custom"></i>';
        }

        return '<i class="fa fa-times-circle-o text-time text-small-custom"></i>';
    }

    /**
     * Render Template for Expand Text in Assessment Tab
     * @param $value
     * @return string
     */
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

    /**
     * Get Priority Template in Project Detail Page
     * @param $value
     * @return string
     */
    public function getPriorityTemplate($value){
        if(!$value){
            return '';
        }

        $bg = '#d3e1de';
        if($value > 0 && $value < 9){
            $bg = '#d22d3d';
        }
        if($value > 8 && $value < 16){
            $bg = '#f89618';
        }
        if($value > 15 && $value < 22){
            $bg = '#efe342';
        }
        if($value > 21 && $value < 31){
            $bg = '#45bb6a';
        }
        $template = '<span class="setting-primary" style="background-color:'.$bg.';color:white">
                        '.$value.'
                     </span>';

        return $template;

    }

    /**
     * Set Permission to Tab on Project Detail Page
     * @param Project $project
     * @param $relatedData
     * @return bool
     */
    public function checkPermissionRelatedData(Project $project,$relatedData){
        $arrayAccess = [];
        if($project?->assessment) array_push($arrayAccess,Setting::RELATED_DATA['assessment']);
        if($project?->fel1) array_push($arrayAccess,Setting::RELATED_DATA['felData']);
        if($project?->fel2) array_push($arrayAccess,Setting::RELATED_DATA['felData']);
        if($project?->fel3) array_push($arrayAccess,Setting::RELATED_DATA['felData']);
        if($project?->business_case) array_push($arrayAccess,Setting::RELATED_DATA['business_case']);
        if($project?->cost_benefits) array_push($arrayAccess,Setting::RELATED_DATA['cost_benefit']);

        return in_array($relatedData,$arrayAccess);
    }

    /**
     * Get Capex Category to Use in Capex Investment Form
     * @param $type
     * @param $parentId
     * @return null
     */
    public function getCapexCategory($type,$parentId){
        $data = CapexInvestment::with('basket.subBasket');
        if($type == CapexInvestment::type['capex_investment']) {
            return $data->where('type','CAPEX_INVESTMENT')->get();
        }

        if($type == CapexInvestment::type['basket'] && isset($parentId)){
            return $data->where('type',CapexInvestment::type['basket'])
                ->where('parent_id',$parentId)->get();
        }

        if($type == CapexInvestment::type['sub_basket']){
            return $data->where('type',CapexInvestment::type['sub_basket']);
        }

        return null;
    }

    /**
     * Get Basket List
     * @return \Illuminate\Database\Query\Builder
     */
    public function getBasketList(){
        return DB::table('capex_investment_categories as cic')->
            select('cic.id as category_id', 'cic.name as category_name','cic2.name as basket_name','cic2.code as basket_code','cic3.name as sub_basket')->
            join('capex_investment_categories as cic2','cic.id', '=', 'cic2.parent_id')->
            join('capex_investment_categories as cic3','cic2.id', '=', 'cic3.parent_id');
    }

    /**
     * Get Value Complexity Analysis Base on Key
     * @param Project $project
     * @param $key
     * @return mixed|null
     */
    public function getComplexityAnalysis(Project $project,$key){
        $data = $project?->assessment?->complexity_analysis;
        if(!$data){
            return null;
        }

        $complexity_analysis = json_decode($data,true);
        if(isset($complexity_analysis[$key])){
            return $complexity_analysis[$key];
        }

        return null;

    }

    public function getAllAttachment($value,$identifier){
        $attachments = json_decode($value,true);
        if(isset($attachments[$identifier])){
            return $attachments[$identifier];
        }
        return null;
    }

    public function getAttachmentListBusinessCase($value){
        if(!$value) return [];
        $attachments = json_decode($value, true);
        $documents = collect([]);
        foreach ($attachments as $key => $value){
            $documents->put($key,$value);
        }
        return $documents;
    }

    public function updateBudgetToolCriteria(Project $project, $request){
        $existingBasket = $project->basket;
        $existingSubBasket = $project->sub_basket;
        $existingCriteria = $project->criteria;

        $newBasket = $request->basket;
        $newSubBasket = $request->sub_basket;
        $newCriteria = $request->criteria;

        try {
            if($existingBasket == $newBasket
                && $existingSubBasket == $newSubBasket
                && $existingCriteria == $newCriteria){

                DB::table('criterias_projects')->where('project_id', $project->id)->delete();
            }
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * Convert USD to Euro
     */
    public function convertCurrency($curr){
        $value = str_replace('.','',$curr);
        $valueConvert = str_replace(',','.',$value);
        return $valueConvert;
    }

    public function duplicate($projects){
        $newProject = $projects->replicate();
        $newProject->project_name = $projects->project_name . ' - Copy';
        if(isset($this->project_no)){
            $newProject->project_no = $projects->project_no . 'C-' .uniqid();
        }
        $newProject->save();

        if(isset($projects->assessment)){
            $newAssessment = $projects->assessment->replicate();
            $newAssessment->project_id = $newProject->id;
            $newAssessment->save();
        }

        $budgetTool = CriteriasProjects::where('project_id', $projects->id)->get();
        foreach ($budgetTool as $bt){
            $newBudgetTool = $bt->replicate();
            $newBudgetTool->project_id = $newProject->id;
            $newBudgetTool->save();
        }


        if(isset($projects->fel1)){
            $newFel1 = $projects->fel1->replicate();
            $newFel1->project_id = $newProject->id;
            $newFel1->save();
        }

        if(isset($projects->fel2)){
            $newFel2 = $projects->fel2->replicate();
            $newFel2->project_id = $newProject->id;
            $newFel2->save();
        }

        if(isset($projects->fel3)){
            $newFel3 = $projects->fel3->replicate();
            $newFel3->project_id = $newProject->id;
            $newFel3->save();
        }

        if(isset($projects->business_case)){
            $newBc = $projects->business_case->replicate();
            $newBc->project_id = $newProject->id;
            $newBc->save();

            if(isset($projects->business_case->riskAssessment)){
                $newRiskAssessment = $projects->business_case->riskAssessment->replicate();
                $newRiskAssessment->business_case_assessment_id = $newBc->id;
                $newRiskAssessment->save();
            }
        }

        if(isset($projects->cost_benefits)){
            $newCostBenefit = $projects->cost_benefits->replicate();
            $newCostBenefit->project_id = $newProject->id;
            $newCostBenefit->save();
        }
    }

    public function generateProjectNumber()
    {
        $presentedYear = $this->getPresentedYear();

        // Fetch all active project numbers (not deleted) for the current year
        $existingNumbers = Project::where('presented_year', $presentedYear)
            ->pluck('project_number')
            ->toArray();

        // Remove 'C' prefix and convert numbers to integers
        $existingNumbers = array_map(function ($number) {
            return intval(Str::replaceFirst('C', '', $number));
        }, $existingNumbers);

        // Get the max existing number, default to 0 if none
        $maxNumber = !empty($existingNumbers) ? max($existingNumbers) : 0;

        // Generate next number
        $nextNumber = $maxNumber + 1;

        // Format the number as 'C000001', 'C000002', etc.
        return 'C' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }


    public function getPresentedYear(){
        $currentDate = new \DateTime();
        $october1st = new \DateTime(date('Y') . '-10-01');

        if ($currentDate > $october1st) {
            $presented_year = $currentDate->format('Y') + 1;
        } else {
            $presented_year = $currentDate->format('Y');
        }

        return $presented_year;
    }

    public function uploadDocumentRequestBC(Request $request){
        $documentsRequest = collect([]);
       if(isset($request->preliminary_design)) $documentsRequest->put(Setting::BUSINESS_CASE_ATTACHMENT['preliminary_design'],$request->preliminary_design);
       if(isset($request->hazop)) $documentsRequest->put(Setting::BUSINESS_CASE_ATTACHMENT['hazop'],$request->hazop);
       if(isset($request->moc_document)) $documentsRequest->put(Setting::BUSINESS_CASE_ATTACHMENT['moc_document'],$request->moc_document);
       if(isset($request->cost_estimate)) $documentsRequest->put(Setting::BUSINESS_CASE_ATTACHMENT['cost_estimate'],$request->cost_estimate);
       if(isset($request->quotation_of_equipment)) $documentsRequest->put(Setting::BUSINESS_CASE_ATTACHMENT['quotation_of_equipment'],$request->quotation_of_equipment);
       if(isset($request->lcc_report)) $documentsRequest->put(Setting::BUSINESS_CASE_ATTACHMENT['lcc_report'],$request->lcc_report);
        return $documentsRequest;
    }

    public function uploadFilepond(Request $request, Project $project)
    {
        $tempFolder = $request->folder; // Temporary folder name
        $att = collect([]); // Collection to store final attachments
        $pd = [];
        $attachments = Setting::BUSINESS_CASE_ATTACHMENT; // Attachment types or categories

        // Get existing attachments from the database (as an associative array)
        $currentAttachments = json_decode($project->business_case?->attachment, true) ?? [];

        // Retrieve temporary files
        $tempFiles = TemporaryFile::where('folder_name', $tempFolder)->get();
        if ($tempFiles->isNotEmpty() || count($currentAttachments) > 0) {
            $tempDir = 'documents/temp/' . $tempFolder . '/'; // Temporary folder path
            $dir = 'documents/' . $project->project_number . '/'; // Permanent folder path

            // Ensure the permanent directory exists
            if (!Storage::exists($dir)) {
                Storage::makeDirectory($dir);
            }

            // Process all files in the temporary folder
            $allFiles = Storage::allFiles($tempDir);
            foreach ($allFiles as $k => $filePath) {
                $dirUrl = dirname($filePath);
                $folder = basename($dirUrl);
                $fileName = basename($filePath);

                // Check if the folder already exists and compare files
                if (isset($currentAttachments[$folder])) {
                    // If the file is different, delete the old file
                    if ($currentAttachments[$folder] !== $fileName) {
                        if($folder == 'preliminary_design'){
                            foreach ($currentAttachments[$folder] as $ap) {
                                Storage::delete($dir . $folder . '/' . $ap);
                            }
                        } else {
                            Storage::delete($dir . $folder . '/' . $currentAttachments[$folder]);
                        }
                    }
                } else {
                    // Create new folder if it doesn't exist
                    Storage::makeDirectory($dir . $folder);
                }


                if($folder == 'preliminary_design'){
                   $allPD = Storage::allFiles($tempDir . $folder);
                   foreach ($allPD as $ap) {
                       if(!in_array(basename($ap), $pd)){
                           $pd[] = basename($ap);
                       }
                   }
                   //Handle Duplicate record file
                   $att->put($folder, $pd);
                } else {
                    $att->put($folder, $fileName);
                }

                $relativePath = str_replace($tempDir, '', $filePath); // Preserve relative path
                Storage::move($filePath, $dir . $relativePath);
            }

            // Merge new attachments with existing ones
            foreach ($currentAttachments as $folder => $fileName) {
                if (!$att->has($folder)) {
                    if($folder == 'preliminary_design'){
                        $pd = [];
                        foreach ($currentAttachments[$folder] as $ap) {
                            $pd[] = $ap;
                        }
                        $att->put($folder, $pd);
                    } else {
                        $att->put($folder, $fileName); // Keep existing file if it wasn’t replaced
                    }
                }
            }

            // Update the `business_case_attachment` column in the database
            //$project->business_case->attachment = $att->toJson();
            //$project->save();

            // Delete the temporary directory and its records
            Storage::deleteDirectory($tempDir);
            TemporaryFile::where('folder_name', $tempFolder)->delete();
        } else {
            // If no temporary files, return existing attachments
            return $project->business_case_attachment;
        }

        // Return the updated attachments
        return $att;
    }

    public function sendEmailRemarkNotification(Project $project){
        $mail = $project->email_pic;
        if(isset($mail)){
            try{
                Mail::to($mail)->cc(Setting::EMAIL_CC_REMARK)->send(new NoteRemarkEmail($project));
                Log::info('Email send to : '.$mail);
            } catch (Exception $e){
                Log::error($e->getMessage());
            }
        } else {
            Log::warning("No email found for {$mail} in project : {$project->project_name}");
        }
    }

    public function sendEmailSubmitNotification(Project $project){
        if(isset($project->project_name)){
            try{
                Mail::to("elfriani@vale.com")->cc(Setting::EMAIL_CC_REMARK)->send(new SubmissionNotificationEmail($project));
                Log::info('Email send to : elfriani@vale.com');
            } catch (Exception $e){
                Log::error($e->getMessage());
            }
        } else {
            Log::warning("No email found");
        }
    }

}



