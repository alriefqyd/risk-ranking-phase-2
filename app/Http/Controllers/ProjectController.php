<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\CapexInvestment;
use App\Models\Department;
use App\Models\Project;
use App\Models\RiskAssessments;
use App\Models\Setting;
use App\Service\ProjectService;
use App\Service\SettingService;
use App\Service\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProjectController extends Controller
{
    public function __construct(){
        $this->isAdmin = false;
        $this->userDepartment = '';
        /*
         * This code to handle auth user
         * because constractor is calling before session created
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
    public function index(){
        //set gate authorization
        $this->authorize('read');
        $department = $this->department;
        $subDepartment = $this->subDepartment;

        $projectService = new ProjectService();

        $projectCategory = $this->projectCategory;
        $bcStatus = $this->bcStatus;

        $projectType = $this->projectType;
        $isAdmin = $this->isAdmin;

        $projectList = $projectService->getAllProject(true);
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
        $capexCategory = $projectService->getCapexCategory(CapexInvestment::type['capex_investment'],null);
        $sustaining = $projectService->getCapexCategory(CapexInvestment::type['basket'],1);
        $randd = $projectService->getCapexCategory(CapexInvestment::type['basket'], 2);
        $growth = $projectService->getCapexCategory(CapexInvestment::type['basket'], 3);
         return view('page.project.create',[
            'projectCategory' => $this->projectCategory,
            'projectType' => $this->projectType,
            'department' => $department,
            'subDepartment' => $subDepartment,
            'userDepartment' => $this->userDepartment,
            'capexCategory' => $capexCategory,
            'sustainingList' => $sustaining,
            'randdList' => $randd,
            'growthList' => $growth,
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
            'project_number' => 'nullable|unique:projects',
            'category' => 'required',
            'project_name' => 'required',
            'owner' => 'required',
            'project_type' => 'required',
            'sponsor' => 'required',
            'bc_presenter' => 'required'
        ]);

        try{
            $project = new Project([
                'project_number' => $request->project_number,
                'project_name' => $request->project_name,
                'project_type' => $request->project_type,
                'owner' => $request->owner,
                'operating_area' => $request->operating_area,
                'sponsor' => $request->sponsor,
                'project_category' => $request->category,
                'bc_presenter' => $request->bc_presenter,
                'bc_status' => $request->bc_status,
                'note' => $request->note,
                'finance_analyst' => $request->finance_analyst,
                'basket' => $request->basket,
                'sub_basket' => $request->sub_basket,
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

    public function edit(Project $project){
        $this->authorize('read');

        $projectService = new ProjectService();

        $department = $projectService->getDepartment(Department::TYPE['department'],null);
        $subDepartment = $projectService->getDepartment(Department::TYPE['sub-department'],null);

        $complexityScore = Assessment::COMPLEXITY_SCORE;
        $riskLevel = RiskAssessments::SEVERITY;
        $riskMatrix = RiskAssessments::RISK_MATRIX;
        $probability = RiskAssessments::PROBABILITY;

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
            'sessionUpdate' => Session::get('projectUpdate')
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

        if($projectService->projectNotAuthorized($project)){
            abort(404);
        }

        if(!$request->isQuickUpdate){
            $data = $this->validate($request,[
                'project_number' => 'nullable|unique:projects,project_number,'.$project->id,
                'category' => 'required',
                'project_name' => 'required',
                'owner' => 'required',
                'project_type' => 'required',
                'sponsor' => 'required',
                'bc_presenter' => 'required'
            ]);
        }

        DB::beginTransaction();
        try{
            if($request->has('note')) $project->note = $request->note;
            if($request->has('bc_status')) $project->bc_status = $request->bc_status;

            if(!$request->isQuickUpdate){
                $project->project_number = $request->project_number;
                $project->project_name = $request->project_name;
                $project->project_type = $request->project_type;
                $project->owner = $request->owner;
                $project->sponsor = $request->sponsor;
                $project->bc_presenter = $request->bc_presenter;
                $project->project_category = $request->category;
                $project->finance_analyst = $request->finance_analyst;
            }

            $project->save();
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
            if($request->ajax()) return response()->json($e);
            return redirect('project/create')->withErrors($e->getMessage());
        }

        if($request->ajax()){
            return response()->json([
                'status' => 200,
                'message' => 'Data Successfully Updated'
            ]);
        }

        $request->session()->flash('alert-success', 'Data was successful deleted!');
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
}
