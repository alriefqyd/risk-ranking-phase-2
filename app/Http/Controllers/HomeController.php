<?php

namespace App\Http\Controllers;

use App\Models\CapexInvestment;
use App\Models\Project;
use App\Models\RiskAssessments;
use App\Models\Setting;
use App\Service\Fel2Service;
use App\Service\ProjectService;
use App\Service\UserService;
use App\Service\Fel1Service;
use App\Service\Fel3Service;
use App\Service\BusinessCaseService;
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

       $userService = new UserService();

       //count all data
       $project = $getProject->getAllProject(false, config('constants.project_presented_year'), true);
       /*$countAssessment = $assessmentService->countAssessment(null);
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
       $countBCPublish = $bcService->countAllBc(config('constants.status.publish'));*/

       $budgetRiskLevelResidual = [];
       $budgetRiskLevelForecast = [];
       foreach (range(1,25) as $riskLevel) {
           $budgetRiskLevelResidual[] = $this->getBudgetRiskValue($riskLevel, 'risk_level_residual');
           $budgetRiskLevelForecast[] = $this->getBudgetRiskValue($riskLevel, 'risk_level_forecast');
       }


       return view('page.dashboard',[
           'projectCount' => $project->count(),
           'countBasketCategory' => $this->getDataBasket(),
           'isAdmin'=> $userService->isAdmin() || $userService->isViewer(),
           'budgetRiskLevelResidual' => $budgetRiskLevelResidual,
           'budgetRiskLevelForecast' => $budgetRiskLevelForecast,
       ]);
   }

   public function getDraft($data){
       return $data->get()->where('status','DRAFT');
   }

   public function getPublish($data){
       return $data->get()->where('status','PUBLISH');
   }

    public function getDataGraph(Request $request){
        $ps = new ProjectService();
        $project = Project::with(['business_case','ownersProject'])->where('presented_year',config('constants.project_presented_year'))->where('version','>=','1');
        if(auth()->user()->role == 'Admin Department'){
            $project = $project->where('operation_area', auth()->user()->department);
        }
        /*$investmentStrategy = $this->getInvestmentStrategy($project);
        $basket = $this->getBasketChart($project);
        if($request->type == 'investment_strategy') return $investmentStrategy;
        if($request->type == 'basket') return $basket;

        return $investmentStrategy;*/

        $projectByArea = $project->with('ownersProject')->get()->groupBy('ownersProject.name');
        $projectByType = $project->with(['ownersProject','baskets'])->get()->groupBy('baskets.name');

        $data = $projectByArea->map(function ($items, $area) {
            $projectCount = $items->count();
            $totalBudget = $items->sum(function ($item) {
                $intCost = str_replace('.', '', $item->business_case->cost_estimate);
                $intCost = (float)$intCost ?? 0;
                $intCost = $intCost / 1000000;
                return $intCost;
            });

            return [
                'projects' => $projectCount,
                'budget' => number_format($totalBudget,2,'.')
            ];
        });

        $dataByType = $projectByType->map(function ($items, $area) {
            $projectCount = $items->count();
            $totalBudget = $items->sum(function ($item) {
                $intCost = str_replace('.', '', $item->business_case->cost_estimate);
                $intCost = (float)$intCost ?? 0;
                $intCost = $intCost / 1000000;
                return $intCost;
            });

            return [
                'projects' => $projectCount,
                'budget' => number_format($totalBudget,2,'.')
            ];
        });


        return response()->json([
            'status' => 200,
            'data' => $data,
            'dataType' => $dataByType,
        ]);
    }

    public function getBasketChart($project){
        $countSubBasket = [];

        foreach ($project as $p) {
            $subBasket = $p->subBaskets?->code;
            $basket = $p->baskets?->code;
            if (!isset($countSubBasket[$basket][$subBasket])) {
                $countSubBasket[$basket][$subBasket] = 1;
            } else {
                $countSubBasket[$basket][$subBasket]++;
            }

            // Check and count occurrences for level1
        }
        return (object) $countSubBasket;
    }

//    public function getInvestmentStrategy($project){
//        $margin = array();
//        $maintain = array();
//        $hsor = array();
//        $sustainability = array();
//        $administrative = array();
//        $engineering = array();
//        $exploration = array();
//        $innovation_technology = array();
//        $volume_growth = array();
//        $volume_replacement = array();
//
//        $health_safety = array();
//        $environment = array();
//        $complience = array();
//        $others_hse = array();
//
//        $rebuild = array();
//        $replacement = array();
//        others
//
//        foreach ($project_category as $l){
//            array_push($margin,$this->getDataByProjectType(Setting::MARGIN,$l));
//            array_push($maintain,$this->getDataByProjectType(Setting::MAINTAIN_CAPACITY,$l));
//            array_push($hsor,$this->getDataByProjectType(Setting::HEALTH_AND_SAFETY,$l));
//            array_push($sustainability,$this->getDataByProjectType(Setting::SUSTAINABILITY,$l));
//            array_push($administrative,$this->getDataByProjectType(Setting::ADMINISTRATIVE_IMPROVEMENTS,$l));
//            array_push($engineering,$this->getDataByProjectType(Setting::ENGINEERING,$l));
//            array_push($exploration,$this->getDataByProjectType(Setting::EXPLORATION,$l));
//            array_push($innovation_technology,$this->getDataByProjectType(Setting::INNOVATION_AND_TECHNOLOGY,$l));
//            array_push($volume_growth,$this->getDataByProjectType(Setting::VOLUME_GROWTH,$l));
//            array_push($volume_replacement,$this->getDataByProjectType(Setting::VOLUME_REPLACEMENT,$l));
//        }
//
//        $result = array(
//            'label' => $label,
//            'margin' => $margin,
//            'administrative' => $administrative,
//            'maintain' => $maintain,
//            'hsor' => $hsor,
//            'sustainability' => $sustainability,
//            'engineering' => $engineering,
//            'exploration' => $exploration,
//            'innovation_technology' => $innovation_technology,
//            'volume_growth' => $volume_growth,
//            'volume_replacement' => $volume_replacement,
//        );
//
//        return response()->json($result);
//    }
    public function getInvestmentStrategy($project){
        $countLevels = [];

        foreach ($project as $p) {

            // Check and count occurrences for level1
            if (isset($json->level1)) {
                $level1Key = $json->level1;
                if (!isset($countLevels['level1'][$level1Key])) {
                    $countLevels['level1'][$level1Key] = 1;
                } else {
                    $countLevels['level1'][$level1Key]++;
                }
            }

            // Check and count occurrences for level2
            if (isset($json->level2)) {
                $level2Key = $json->level2;
                if (!isset($countLevels['level2'][$level2Key])) {
                    $countLevels['level2'][$level2Key] = 1;
                } else {
                    $countLevels['level2'][$level2Key]++;
                }
            }
        }

        // Now $countLevels contains the counts for each level
        // You can use these counts as needed.

        return (object) $countLevels;
    }

    public function getDataByProjectType(){
        $userService = new UserService();
        $presented_year = config('constants.project_presented_year');
        $data = Project::with('baskets')->where('presented_year', $presented_year)->whereNull('deleted_at');
        if(!$userService->isAdmin() && !$userService->isViewer()){
            $data = $data->where('operation_area',auth()->user()->department);
        }

        return $data->get();
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

    public function getBudgetRiskValue($value, $type){
        $ra = RiskAssessments::with(['businessCase.project'])->where($type,$value)->whereHas('businessCase.project',function ($query){
            return $query->where('version','>=','1');
        })->get();

        if(!isset($ra)) return 0;

        $ce = $ra->sum(function($item){
            if(isset($item->businessCase->cost_estimate)){
                $cost = str_replace('.','',$item->businessCase->cost_estimate);
                $cost = (float)$cost ?? 0;
                $cost = $cost / 1000000;
                return $cost;
            }

            return 0;

        });

        return $ce;
    }
}
