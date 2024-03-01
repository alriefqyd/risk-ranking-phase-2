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

       $project = $this->getDataByProjectType();
       $investmentStrategy = $this->getInvestmentStrategy($project);
       $basket = $this->getBasketChart($project);
       if($request->type == 'investment_strategy') return $investmentStrategy;
       if($request->type == 'basket') return $basket;

       return null;
    }

    public function getBasketChart($project){
        $countSubBasket = [];

        foreach ($project as $p) {

            $subBasket = $p->sub_basket;
            $basket = $p->baskets->code;
            if (!isset($countSubBasket[$basket][$subBasket])) {
                $countSubBasket[$basket][$subBasket] = 1;
            } else {
                $countSubBasket[$basket][$subBasket]++;
            }

            // Check and count occurrences for level1
        }


        return (object) $countSubBasket;
    }

    public function getInvestmentStrategy($project){
        $countLevels = [];

        foreach ($project as $p) {
            $investment = $p->investment_strategy;
            $json = json_decode($investment, true);

            // Check and count occurrences for level1
            if (isset($json['level1'])) {
                $level1Key = $json['level1'];
                if (!isset($countLevels['level1'][$level1Key])) {
                    $countLevels['level1'][$level1Key] = 1;
                } else {
                    $countLevels['level1'][$level1Key]++;
                }
            }

            // Check and count occurrences for level2
            if (isset($json['level2'])) {
                $level2Key = $json['level2'];
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
        $data = Project::with('baskets')->whereHas('baskets',function ($q) {
            return $q->where('type','BASKET');
        })->where('presented_year', $presented_year)->get();

        if(!$userService->isAdmin() && !$userService->isViewer()){
            $data = $data->where('owner',auth()->user()->department);
        }

        return $data;
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
