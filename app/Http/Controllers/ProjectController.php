<?php

namespace App\Http\Controllers;

use App\Events\Sending;
use App\Models\Assessment;
use App\Models\CapexInvestment;
use App\Models\Criteria;
use App\Models\CriteriasProjects;
use App\Models\Department;
use App\Models\Project;
use App\Models\RiskAssessments;
use App\Models\Setting;
use App\Notifications\ProjectNote;
use App\Service\MaturityService;
use App\Service\ProjectService;
use App\Service\SettingService;
use App\Service\UserService;
use Exception;
use \App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function __construct(){
        $this->isAdmin = false;
        $this->userDepartment = '';
        /*
         * This code to handle auth user
         * because constructor is calling before session created
         */
        $this->middleware(function ($request, $next) {
            $userService = new UserService();
            $this->isAdmin = $userService->isAdmin();
            $this->userDepartment = Auth::user()->department;
            return $next($request);
        });

        $settingService = new SettingService();

        $this->projectCategory = Setting::PROJECT_CATEGORY;
        $this->bcStatus = Project::BC_STATUS;
        $this->projectType = $settingService->getProjectType();
        $this->department = Department::TYPE['department'];
        $this->subDepartment = Department::TYPE['sub-department'];

    }

    /**
     * Get All Project
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request){
        //set gate authorization
        $this->authorize('read');
        $department = $this->department;
        $subDepartment = $this->subDepartment;

        $projectService = new ProjectService();

        $projectCategory = $this->projectCategory;
        $bcStatus = $this->bcStatus;

        $projectType = $this->projectType;
        $isAdmin = $this->isAdmin;

        $projectList = $projectService->getAllProject(true, config('constants.project_presented_year'));
        $year = null;
        if($request->year){
            $year = config('constants.project_presented_year');
            $projectList = $projectService->getAllProject(true, $request->year);
        }
        $department = $projectService->getDepartment($department, null);
        $subDepartment = $projectService->getDepartment($subDepartment, null);

        return view('page.project.index',[
            'projectList' => $projectList,
            'projectCategory' => $projectCategory,
            'projectType' => $projectType,
            'isAdmin' => $isAdmin,
            'department' => $department,
            'subDepartment' => $subDepartment,
            'bcStatus' => $bcStatus,
            'year' => $year
        ]);
    }

    /**
     * Create Project Form
     * @return /View
     */
    public function create(){
        $projectService = new ProjectService();
        $department = $projectService->getDepartment(Department::TYPE['department'],null);
        $subDepartment = $projectService->getDepartment(Department::TYPE['sub-department'],null);
        /*$capexCategories =  CapexInvestment::with('basket.subBasket.categories')->where('type','CAPEX_INVESTMENT')->get();*/
        $basketList = CapexInvestment::where('type','basket')->get();

        return view('page.project.create',[
            'projectCategory' => $this->projectCategory,
            'projectType' => $this->projectType,
            'department' => $department,
            'subDepartment' => $subDepartment,
            'userDepartment' => $this->userDepartment,
            'basketList' => $basketList,
            'project' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return
     */
    public function store(Request $request)
    {
        $this->authorize('create');
        DB::beginTransaction();
        $data = $this->validate($request,[
            'project_name' => 'required',
            'operation_area' => 'required',
            'sponsor_area' => 'required',
            'owner' => 'required',
            'project_sponsor' => 'required',
            'maintenance_reps' => 'required',
            'operation_reps' => 'required',
            'bc_presenter' => 'required',
            'fel_123_project_ref' => 'required',
        ]);

        try{
            $currentDate = new \DateTime();
            $october1st = new \DateTime(date('Y') . '-10-01');

            if ($currentDate > $october1st) {
                $presented_year = $currentDate->format('Y') + 1;
            } else {
                $presented_year = $currentDate->format('Y');
            }

            $project = new Project([
                'project_name' => $request->project_name,
                'operation_area' => $request->operation_area,
                'sponsor_area' => $request->sponsor_area,
                'owner' => $request->owner,
                'sponsor' => $request->project_sponsor,
                'maintenance_reps' => $request->maintenance_reps,
                'operation_reps' => $request->operation_reps,
                'bc_presenter' => $request->bc_presenter,
                'bc_status' => $request->bc_status,
                'fel_123_project_ref' => $request->fel_123_project_ref,
                'note' => $request->note,
                'finance_analyst' => $request->finance_analyst,
                'basket' => $request->basket,
                'sub_basket' => $request->sub_basket,
                'sub_basket_categories' => $request->sub_basket_categories,
                'presented_year' => $presented_year,
                'created_by' => Auth::user()->id
            ]);


            $project->saveOrFail();
            DB::commit();
            $request->session()->flash('alert-success', 'Project was saved');
            return redirect('project/'.$project->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('project/create')->withErrors($e->getMessage());
        }
    }

    public function edit(Project $project, Request $request){
        $this->authorize('read');
        $projectService = new ProjectService();
        $maturityService = new MaturityService();
//        if($projectService->projectNotAuthorized($project)){
//            abort(404);
//        }


        $settingService = new SettingService();
        $investmentStrategyList = $settingService->getAllInvestmentStrategy();
        $dataMaturity = $maturityService->getMaturityAnalysis($project?->fel3, $project?->fel3?->id);

        $capexCategories =  CapexInvestment::with('basket.subBasket')->where('type','CAPEX_INVESTMENT')->get();
        $department = $projectService->getDepartment(Department::TYPE['department'],null);
        $subDepartment = $projectService->getDepartment(Department::TYPE['sub-department'],null);

        $complexityScore = Assessment::COMPLEXITY_SCORE;
        $riskLevel = RiskAssessments::NEW_SEVERITY;
        $riskMatrix = RiskAssessments::RISK_MATRIX;
        $probability = RiskAssessments::PROBABILITY;


        $categoryId = $project->sub_basket_categories;
        $subBasketId = $project->sub_basket;

        $criteria = $project->criterias;

        if(sizeof($criteria) < 1) {
            $criteria = Criteria::whereHas('categories', function ($query) use ($categoryId, $subBasketId) {
                $query->where('categories.id', $categoryId)
                    ->where('criterias_categories.sub_basket_id', $subBasketId);
            })->get();
        }


        $basketList = CapexInvestment::where('type','basket')->get();

        return view('page.project.detail',[
            'project' => $project,
            'projectCategory' => $this->projectCategory,
            'projectType' => $this->projectType,
            'department' => $department,
            'subDepartment' => $subDepartment,
            'userDepartment' => $this->userDepartment,
            'complexityScore' => $complexityScore,
            'riskLevel' => $riskLevel,
            'riskMatrix' => $riskMatrix,
            'probability' => $probability,
            'capexCategories' => $capexCategories,
            'sessionUpdate' => Session::get('projectUpdate'),
            'isAdmin' => auth()->user()->role == User::ROLE['admin'],
            'isNotCurrentData' => false,
            'dataMaturity' => $dataMaturity,
            'maturityOption' => Setting::MATURITY_VALUE,
            'criterias' => $criteria,
            'basketList' => $basketList,
            'investmentStrategyList' => $investmentStrategyList
        ]);
    }
    /**
     * Update Project Note in Modal Project List
     * @param Request $request
     * @param Project $project
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Project $project){
        $this->authorize('update');
        $projectService = new ProjectService();
        $path = 'documents/'.$project->project_name;
        $userService = new UserService();
        $user = $userService->getCurrentUser();

        if($projectService->projectNotAuthorized($project)){
            abort(404);
        }

        if(!$request->isQuickUpdate){
            $data = $this->validate($request,[
                'project_name' => 'required',
                'operation_area' => 'required',
                'sponsor_area' => 'required',
                'owner' => 'required',
                'project_sponsor' => 'required',
                'maintenance_reps' => 'required',
                'operation_reps' => 'required',
                'bc_presenter' => 'required',
                'fel_123_project_ref' => 'required',
            ]);
        }


        DB::beginTransaction();
        try{
            if($request->has('note')) {
                $pn = new ProjectNote(null);
                $project->note = $request->note;
                DB::table('notifications')->where('project_id',$project->id)
                    ->where('notifiable_id',$project->created_by)
                    ->where('type',get_class($pn))
                    ->whereNull('read_at')->delete();
                event(new Sending($project));
            }
            if($request->has('bc_status')) $project->bc_status = $request->bc_status;

            $projectService = new ProjectService();
            $projectService->updateBudgetToolCriteria($project, $request);

            if(!$request->isQuickUpdate){
                $project->project_name = $request->project_name;
                $project->operation_area = $request->operation_area;
                $project->sponsor_area = $request->sponsor_area;
                $project->owner = $request->owner;
                $project->sponsor = $request->project_sponsor;
                $project->maintenance_reps = $request->maintenance_reps;
                $project->operation_reps = $request->operation_reps;
                $project->bc_presenter = $request->bc_presenter;
                $project->fel_123_project_ref = $request->fel_123_project_ref;
                $project->basket = $request->basket;
                $project->sub_basket = $request->sub_basket;
                $project->sub_basket_categories = $request->sub_basket_categories;
                $project->project_category = $request->project_category;
                $project->finance_analyst = $request->finance_analyst;
            }

            $project->save();
            DB::commit();

            if(Storage::exists($path)){
                rename(Storage::path($path),Storage::path('documents/'.$project->project_name));
            }

        } catch(Exception $e){
            DB::rollback();
            if($request->ajax()) return response()->json($e->getMessage());
            return redirect('project/create')->withErrors($e->getMessage());
        }

        if($request->ajax()){
            return response()->json([
                'status' => 200,
                'message' => 'Data Successfully Updated'
            ]);
        }

        $request->session()->flash('alert-success', 'Data was successful updated!');
        return redirect('/project/'.$project->id);

    }


    /**
     * Delete Project using Ajax
     * @param Project $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Project $project){
        DB::beginTransaction();
        try{
            $project->delete();
            DB::commit();
        }catch (Exception $e){
            DB::rollBack();
            return response()->json($e);
        }

        return response()->json([
            'status' => 200
        ]);
    }

    /**
     * Get Project Note Based on Open Modal in Project List
     * @param Project $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProjectNote(Project $project){
        return response()->json([
            'status' => 200,
            'project' => $project
        ]);
    }

    /**
     * Get Sponsor By Owner
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSponsorByOwner(Request $request){
        $type = Department::where('type','=', Department::TYPE['sub-department'])->where('parent',$request->owner)->get();
        $response = array();
        foreach($type as $t){
            $response[] = array(
                "id"=>$t->id,
                "text"=>$t->name
            );
        }
        return response()->json($response);
    }

    public function sendNotification(Request $request){
        $user = User::first();
        $details = [
            'greeting' => 'Hi Artisan',
            'body' => 'This is my first notification from ItSolutionStuff.com',
            'thanks' => 'Thank you for using ItSolutionStuff.com tuto!',
            'actionText' => 'View My Site',
            'actionURL' => url('/'),
            'order_id' => 101
        ];

        Notification::send($user, new ProjectNote($details));

    }

    /**
     * Unread Notification
     */
    public function markNotification(Request $request){
        auth()->user()->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request){
                return $query->where('id',$request->input('id'));
            })->markAsRead();
        return response()->noContent();
    }

    /**
     * Preview Export Table Excel
     * @return void
     */
    public function previewExport(){
        return view('page.project.export_project');
    }

    public function storeBudgetTool(Request $request){
        $criteriaIds = $request->input('criteria_id');
        $answers = $request->input('answer');

        foreach ($criteriaIds as $key => $criteriaId){
            $answer = $answers[$key] ?? '';
            $syncData[$criteriaId] = [
                'answer' => $answer,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $project = Project::find($request->projectId);
            $project->criterias()->sync($syncData);
        }

        $request->session()->flash('alert-success', 'Data was successful updated!');
        return redirect('/project/' . $project->id);
    }

    public function updateInvestmentStrategy(Request $request){
        try{

            $data = [
                'level1' => $request->level1,
                'level2' => $request->level2,
                'level3' => $request->level3
            ];

            $value = json_encode($data);


            $project = Project::find($request->project_id);

            $project->investment_strategy = $value;
            $project->save();

            return response()->json([
                'status' => 200
            ]);
        } catch (Exception $e){
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }

    }

    public function getSubDepartment(Request $request){
        $dept = $request->owner;
        $projectService = new ProjectService();
        $data = $projectService->getDepartment(Department::TYPE['sub-department'], $dept);
        $response = array();

        foreach ($data as $d){
            $response[] = array(
                "id"=>$d->id,
                "text" =>$d->name,
                "data" => [
                    "owner" => $d->supervisor,
                    "sponsor" => $d->sponsors->supervisor
                ]
            );
        }

        return $response;
    }

    public function duplicate(Request $request){
        try{
            DB::beginTransaction();
            $projects = Project::with(['assessment'])->where('id',$request->id)->first();
            $projectService = new ProjectService();
            $projectService->duplicate($projects);
            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => 'Duplicate Success'
            ]);
        } catch (Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

}
