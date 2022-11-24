<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\ProjectNote;
use App\service\Fel2Service;
use App\Service\ProjectService;
use App\Service\UserService;
use App\service\Fel1Service;
use App\service\Fel3Service;
use App\service\BusinessCaseService;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use App\Service\AssessmentService;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
   public function index(){
       $getProject = new ProjectService();
       $assessmentService = new AssessmentService();
       $fel1Service = new Fel1Service();
       $fel2Service = new Fel2Service();
       $fel3Service = new Fel3Service();
       $bcService = new BusinessCaseService();

       //count all data
       $project = $getProject->getAllProject(false);
       $countAssessment = $assessmentService->countAssessment(null);
       $countAssessmentDraft = $assessmentService->countAssessment(config('constants.status.draft'));
       $countAssessmentPublish = $assessmentService->countAssessment(config('constants.status.publish'));
       $countFel1 = $fel1Service->countFel1(null);
       $countFel1Draft = $fel1Service->countFel1(config('constants.status.draft'));
       $countFel1Publish = $fel1Service->countFel1(config('constants.status.publish'));
       $countFel2 = $fel2Service->countFel2(null);
       $countFel2Draft = $fel2Service->countFel2(config('constants.status.draft'));
       $countFel2Publish = $fel2Service->countFel2(config('constants.status.publish'));
       $countFel3 = $fel3Service->countFel3(null);
       $countFel3Draft = $fel3Service->countFel3(config('constants.status.draft'));
       $countFel3Publish = $fel3Service->countFel3(config('constants.status.publish'));
       $countBC = $bcService->countAllBc(null);
       $countBCDraft = $bcService->countAllBc(config('constants.status.draft'));
       $countBCPublish = $bcService->countAllBc(config('constants.status.publish'));

       return view('page.dashboard',[
           'projectCount' => $project->count(),
           'countAssessment' => $countAssessment,
           'countAssessmentDraft' => $countAssessmentDraft,
           'countAssessmentPublish' => $countAssessmentPublish,
           'countFel1' => $countFel1,
           'countFel1Draft' => $countFel1Draft,
           'countFel1Publish' => $countFel1Publish,
           'countFel2' => $countFel2,
           'countFel2Draft' => $countFel2Draft,
           'countFel2Publish' => $countFel2Publish,
           'countFel3' => $countFel3,
           'countFel3Draft' => $countFel3Draft,
           'countFel3Publish' => $countFel3Publish,
           'countBC' => $countBC,
           'countBCDraft' => $countBCDraft,
           'countBCPublish' => $countBCPublish,
       ]);
   }

   public function getDraft($data){
       return $data->get()->where('status','DRAFT');
   }

   public function getPublish($data){
       return $data->get()->where('status','PUBLISH');
   }

    public function getDataGraph(Request $request){
        $project_category = [Setting::PROJECT_TYPE_BETTERMENT,Setting::PROJECT_TYPE_SUSTAINABILITY_DEVELOPMENT, Setting::REPLACEMENT, Setting::RESEARCH_AND_DEVELOPMENT];
        $label = [Setting::PROJECT_CATEGORY['betterment'],Setting::PROJECT_CATEGORY['sustainability_development'],Setting::PROJECT_CATEGORY['replacement'],Setting::PROJECT_CATEGORY['research_and_development']];
        $productive = array();
        $administrative = array();
        $environment = array();
        $occupational_health_and_safety = array();
        $technology_and_process_development = array();
        $engineering = array();
        $geological_research = array();
        $social_community = array();
        foreach ($project_category as $l){
            array_push($productive,$this->getDataByProjectType(Setting::PRODUCTIVE,$l));
            array_push($administrative,$this->getDataByProjectType(Setting::ADMINISTRATIVE,$l));
            array_push($environment,$this->getDataByProjectType(Setting::ENVIRONMENT,$l));
            array_push($occupational_health_and_safety,$this->getDataByProjectType(Setting::OCCUPATIONAL_HEALTH_AND_SAFETY,$l));
            array_push($technology_and_process_development,$this->getDataByProjectType(Setting::TECHNOLOGY_AND_PROCESS_DEVELOPMENT,$l));
            array_push($engineering,$this->getDataByProjectType(Setting::ENGINEERING,$l));
            array_push($geological_research,$this->getDataByProjectType(Setting::GEOLOGICAL_RESEARCH,$l));
            array_push($social_community,$this->getDataByProjectType(Setting::SOCIAL_COMMUNITY_REPUTATION,$l));
        }

        $result = array(
            'label' => $label,
            'productive' => $productive,
            'administrative' => $administrative,
            'environment' => $environment,
            'occupational_health_and_safety' => $occupational_health_and_safety,
            'technology_and_process_development' => $technology_and_process_development,
            'engineering' => $engineering,
            'geological_research' => $geological_research,
            'social' => $social_community
        );

        return response()->json($result);
    }

    public function getDataByProjectType($pt, $pc){
        $userService = new UserService();
        $data = Project::where('project_type',$pt)->where('project_category',$pc);
        if(!$userService->isAdmin() && !$userService->isViewer()){
            $data = $data->where('owner',auth()->user()->department);
        }
        return $data->count() ?: 0;
    }
}
