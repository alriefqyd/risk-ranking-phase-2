<?php

namespace App\Http\Controllers;

use App\Models\CapexInvestment;
use App\Models\Project;
use App\Models\Setting;
use App\service\Fel2Service;
use App\Service\ProjectService;
use App\Service\UserService;
use App\service\Fel1Service;
use App\service\Fel3Service;
use App\service\BusinessCaseService;
use Illuminate\Http\Request;
use App\Service\AssessmentService;

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
       $project = $getProject->getAllProject(false, config('constants.project_presented_year'), true);
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
           'countBasketCategory' => $this->getDataBasket()
       ]);
   }

   public function getDraft($data){
       return $data->get()->where('status','DRAFT');
   }

   public function getPublish($data){
       return $data->get()->where('status','PUBLISH');
   }

    public function getDataGraph(Request $request){
        $project_category = [Setting::sustaining,Setting::r_and_d, Setting::growth];
        $label = [Setting::sustaining,Setting::r_and_d,Setting::growth];
        $margin = array();
        $maintain = array();
        $hsor = array();
        $sustainability = array();
        $administrative = array();
        $engineering = array();
        $exploration = array();
        $innovation_technology = array();
        $volume_growth = array();
        $volume_replacement = array();

        foreach ($project_category as $l){
            array_push($margin,$this->getDataByProjectType(Setting::MARGIN,$l));
            array_push($maintain,$this->getDataByProjectType(Setting::MAINTAIN_CAPACITY,$l));
            array_push($hsor,$this->getDataByProjectType(Setting::HEALTH_AND_SAFETY,$l));
            array_push($sustainability,$this->getDataByProjectType(Setting::SUSTAINABILITY,$l));
            array_push($administrative,$this->getDataByProjectType(Setting::ADMINISTRATIVE_IMPROVEMENTS,$l));
            array_push($engineering,$this->getDataByProjectType(Setting::ENGINEERING,$l));
            array_push($exploration,$this->getDataByProjectType(Setting::EXPLORATION,$l));
            array_push($innovation_technology,$this->getDataByProjectType(Setting::INNOVATION_AND_TECHNOLOGY,$l));
            array_push($volume_growth,$this->getDataByProjectType(Setting::VOLUME_GROWTH,$l));
            array_push($volume_replacement,$this->getDataByProjectType(Setting::VOLUME_REPLACEMENT,$l));
        }

        $result = array(
            'label' => $label,
            'margin' => $margin,
            'administrative' => $administrative,
            'maintain' => $maintain,
            'hsor' => $hsor,
            'sustainability' => $sustainability,
            'engineering' => $engineering,
            'exploration' => $exploration,
            'innovation_technology' => $innovation_technology,
            'volume_growth' => $volume_growth,
            'volume_replacement' => $volume_replacement,
        );

        return response()->json($result);
    }

    public function getDataByProjectType($pt,$pc){
        $userService = new UserService();
        $presented_year = config('constants.project_presented_year');
        $capexInvestmentCategory = CapexInvestment::where('code',$pc)->first();
        $data = Project::with('baskets')->whereHas('baskets',function ($q) use ($capexInvestmentCategory,$pt) {
            return $q->where('category',$capexInvestmentCategory->id)->where('type','BASKET')
                ->where('code',$pt);
        })->where('presented_year', $presented_year);

        if(!$userService->isAdmin() && !$userService->isViewer()){
            $data = $data->where('owner',auth()->user()->department);
        }
        return $data->count() ?: 0;
    }

    public function getDataBasket(){
       $capexCollection = collect();
       $capexInvestment = CapexInvestment::CAPEX_INVESTMENT;
       $userService = new UserService();
       $presented_year = config('constants.project_presented_year');

       foreach ($capexInvestment as $ciKey => $ciValue){
           $basketCollection = collect();
           $parent = CapexInvestment::where('code',$ciKey)->first();
           $basketList = CapexInvestment::where('type',CapexInvestment::type['basket'])
               ->where('parent_id',$parent?->id)->get();
           foreach ($basketList as $s){
               $ci = CapexInvestment::where('code',$s->code)
                   ->where('parent_id',$parent->id)
                   ->first();
               $count = Project::where('presented_year', $presented_year)
                    ->where('basket',$ci?->id)
                   ->when($userService->isAdminDept(),function ($q) use ($userService){
                       $q->where('owner',auth()->user()->department);
                   })->count();
               $basketCollection->put(
                   $s->name,$count
               );
           }
           $capexCollection->put($ciValue,$basketCollection);
       }
       return $capexCollection;
    }
}
