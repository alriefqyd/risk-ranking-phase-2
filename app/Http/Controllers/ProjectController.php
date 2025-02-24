<?php

namespace App\Http\Controllers;

use App\Events\Sending;
use App\Models\Assessment;
use App\Models\CapexInvestment;
use App\Models\Criteria;
use App\Models\Department;
use App\Models\Project;
use App\Models\RevisionLog;
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
use Illuminate\Validation\Rule;

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


        $year = config('constants.project_presented_year');
        if($request->year){
            $year = $request->year;
        }
        $projectList = $projectService->getAllProject(true, $year);
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
        /*if(auth()->user()->role == User::ROLE['admin-dept']){
            abort(401);
        }*/
        $projectService = new ProjectService();
        $department = $projectService->getDepartment(Department::TYPE['department'],null);

        $directorate = $projectService->getDepartment(Department::TYPE['directorate'],null);
        $subDepartment = $projectService->getDepartment(Department::TYPE['sub-department'],null);
        /*$capexCategories =  CapexInvestment::with('basket.subBasket.categories')->where('type','CAPEX_INVESTMENT')->get();*/
        $basketList = CapexInvestment::where('type','INVESTMENT_TYPE')->where('status','ACTIVE')->get();
        $initialProjectNo = $projectService->generateProjectNumber();
        return view('page.project.create',[
            'projectCategory' => $this->projectCategory,
            'projectType' => $this->projectType,
            'department' => $department,
            'directorate' => $directorate,
            'subDepartment' => $subDepartment,
            'userDepartment' => $this->userDepartment,
            'basketList' => $basketList,
            'project' => null,
            'initialProjectNo' => $initialProjectNo,
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

        /*if (auth()->user()->role == User::ROLE['admin-dept']) {
            abort(401);
        }*/

        $projectService = new ProjectService();

        DB::beginTransaction();

        try {
            // Validate the request
            $data = $this->validate($request, [
                'project_name' => 'required',
                'project_number' => [
                    'required',
                    Rule::unique('projects')->where('deleted_at', null)
                ],
                'operation_area' => 'required',
                'sponsor_area' => 'required',
                'owner' => 'required',
                'project_sponsor' => 'required',
                'bc_presenter' => 'required',
                'bc_originator' => 'required',
                'email_pic' => 'required',
                'kpi_description' => 'required|array',
                'kpi_description.*' => 'required|string',
                'kpi_benefit' => 'required|array',
                'kpi_benefit.*' => 'required|string',
            ]);

            // Create the project
            $project = Project::create([
                'project_number' => $request->project_number,
                'project_name' => $request->project_name,
                'operation_area' => $request->operation_area,
                'sponsor_area' => $request->sponsor_area,
                'owner' => $request->owner,
                'sponsor' => $request->project_sponsor,
                'directorate' => $request->directorate,
                'bc_presenter' => $request->bc_presenter,
                'bc_originator' => $request->bc_originator,
                'bc_status' => $request->bc_status,
                'note' => $request->note,
                'finance_analyst' => $request->finance_analyst,
                'email_pic' => $request->email_pic,
                'basket' => $request->basket,
                'sub_basket' => $request->sub_basket,
                'sub_basket_categories' => $request->sub_basket_categories,
                'presented_year' => now()->year,
                'created_by' => auth()->id(),
                'version' => $request->status == 'PUBLISH' ? 1 : 0
            ]);

            $kpiData = [];
            foreach ($request->kpi_description as $index => $description) {
                $kpiData[] = [
                    'description' => $description,
                    'time_to_benefit' => $request->kpi_benefit[$index] ?? null,
                ];
            }

            // Create the business case
            $businessCase = $project->business_case()->create([
                'problem_statement_and_objective_text' => $request->problem_statement,
                'objective' => $request->objective,
                'project_scope_of_work_text' => $request->scope_of_work,
                'npv' => $request->npv,
                'irr' => $request->irr,
                'payback_period' => $request->payback_period,
                'tco' => $request->tco,
                'cost_estimate' => $request->cost_estimate,
                'created_by' => auth()->id(),
                'kpi_summary' => json_encode($kpiData),
            ]);

            // Create the risk assessment
            $businessCase->riskAssessment()->create([
                'risk_level_residual' => $request->risk_level_residual,
                'risk_level_forecast' => $request->risk_level_forecast,
                'risk_level_deduction' => $request->risk_deduction,
            ]);

            $att = $projectService->uploadFilepond($request, $project);

            $businessCase->attachment = json_encode($att);
            $businessCase->status = $request->status ?? 'DRAFT';
            if($businessCase->status == 'PUBLISH'){
                RevisionLog::create([
                    'revision' => 1,
                    'date' => now(),
                    'project_id' => $project->id,
                    'summary_of_changes' => json_encode([
                        ['field' => 'cost_estimate', 'oldValue' => 0, 'newValue' => $request?->cost_estimate],
                        ['field' => 'project_name', 'oldValue' => "-", 'newValue' => $request?->project_name],
                        ['field' => 'directorate', 'oldValue' => "-", 'newValue' => $request?->directorate],
                        ['field' => 'operation_area', 'oldValue' => "-", 'newValue' => $request?->operation_area],
                        ['field' => 'sponsor_area', 'oldValue' => "-", 'newValue' => $request?->sponsor_area],
                        ['field' => 'bc_presenter', 'oldValue' => "-", 'newValue' => $request?->bc_presenter],
                        ['field' => 'bc_originator', 'oldValue' => "-", 'newValue' => $request?->bc_originator],
                        ['field' => 'finance_analyst', 'oldValue' => "-", 'newValue' => $request?->finance_analyst],
                        ['field' => 'email_pic', 'oldValue' => "-", 'newValue' => $request?->email_pic],
                        ['field' => 'checkbox_basket', 'oldValue' => "-", 'newValue' => $request?->checkbox_basket],
                        ['field' => 'checkbox_sub_basket', 'oldValue' => "-", 'newValue' => $request?->checkbox_basket],
                        ['field' => 'problem_statement', 'oldValue' => "-", 'newValue' => $request?->problem_statement],
                        ['field' => 'objective', 'oldValue' => "-", 'newValue' => $request?->objective],
                        ['field' => 'scope_of_work', 'oldValue' => "-", 'newValue' => $request?->scope_of_work],
                        ['field' => 'npv', 'oldValue' => "-", 'newValue' => $request?->npv],
                        ['field' => 'irr', 'oldValue' => "-", 'newValue' => $request?->irr],
                        ['field' => 'payback_period', 'oldValue' => "-", 'newValue' => $request?->payback_period],
                        ['field' => 'tco', 'oldValue' => "-", 'newValue' => $request?->tco],
                        ['field' => 'risk_level_residual', 'oldValue' => "-", 'newValue' => $request?->risk_level_residual],
                        ['field' => 'risk_level_forecast', 'oldValue' => "-", 'newValue' => $request?->risk_level_forecast],
                        ['field' => 'risk_deduction', 'oldValue' => "-", 'newValue' => $request?->risk_deduction],
                        ['field' => 'business_case', 'oldValue' => "-", 'newValue' => $att->get('business_case')],
                        ['field' => 'preliminary_design', 'oldValue' => "-", 'newValue' => $att->get('preliminary_design')],
                        ['field' => 'hazop', 'oldValue' => "-", 'newValue' => $att->get('hazop')],
                        ['field' => 'moc_document', 'oldValue' => "-", 'newValue' => $att->get('moc_document')],
                        ['field' => 'cost_estimate_file', 'oldValue' => "-", 'newValue' => $att->get('cost_estimate_file')],
                        ['field' => 'quotation_of_equipment', 'oldValue' => "-", 'newValue' => $att->get('quotation_of_equipment')],
                        ['field' => 'lcc_report', 'oldValue' => "-", 'newValue' => $att->get('lcc_report')],
                        ['field' => 'financial_evaluation', 'oldValue' => "-", 'newValue' => $att->get('financial_evaluation')],
                        ['field' => 'risk_assessment', 'oldValue' => "-", 'newValue' => $att->get('risk_assessment')],
                        ['field' => 'kpi', 'oldValue' => "-", 'newValue' => json_encode($kpiData)],
                    ]),
                ]);
            }
            $businessCase->save();
            $projectService->sendEmailSubmitNotification($project);
            DB::commit();

            if($request->status == "PUBLISH"){
                return response()->json([
                    'success' => true,
                    'id' => $project->id,
                    'title' => $project->project_name,
                ]);
            }
            $request->session()->flash('alert-success', 'Project was saved');
            return redirect('project/'.$project->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('project/create')->withErrors($e->getMessage());
        }
    }


    public function show(Project $project, Request $request){
        /**temporary disabled**/
        /*if(auth()->user()->role == User::ROLE['admin-dept']){
            abort(401);
        }*/

        $this->authorize('read');
        $projectService = new ProjectService();
        $maturityService = new MaturityService();
        /*if($projectService->projectNotAuthorized($project)){
            abort(404);
        }*/


        $settingService = new SettingService();
        $investmentStrategyList = $settingService->getAllInvestmentStrategy();
        $dataMaturity = $maturityService->getMaturityAnalysis($project?->fel3, $project?->fel3?->id);

        $department = $projectService->getDepartment(Department::TYPE['department'],null);
        $subDepartment = $projectService->getDepartment(Department::TYPE['sub-department'],null);
        $directorate = $projectService->getDepartment(Department::TYPE['directorate'],null);

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

        $kpiData = json_decode($project->business_case->kpi_summary ?? "", true);

        $basketList = CapexInvestment::where('type','INVESTMENT_TYPE')->where('status','ACTIVE')->get();
        $subBasketList = CapexInvestment::where('type','INVESTMENT_SUB_TYPE')->where('status','ACTIVE')->where('parent_id', $project->basket)->get();

        $logs = RevisionLog::where('project_id', $project->id)->get();
        $viewTemplate = 'page.project.detail';
        if($project->presented_year == now()->year) {
            $viewTemplate = 'page.project.new_detail';
        }
        return view($viewTemplate,[
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
            'sessionUpdate' => Session::get('projectUpdate'),
            'isAdmin' => auth()->user()->role == User::ROLE['admin'],
            'isNotCurrentData' => false,
            'dataMaturity' => $dataMaturity,
            'maturityOption' => Setting::MATURITY_VALUE,
            'criterias' => $criteria,
            'basketList' => $basketList,
            'subBasketList' => $subBasketList,
            'investmentStrategyList' => $investmentStrategyList,
            'kpiData' => $kpiData ?? [],
            'directorate' => $directorate,
            'logs' => $logs,
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

//        /**temporary disabled**/
//        if(auth()->user()->role == User::ROLE['admin-dept']){
//            abort(401);
//        }

        if($projectService->projectNotAuthorized($project)){
            abort(404);
        }

        if(!$request->isQuickUpdate){
            $data = $this->validate($request, [
                'project_name' => 'required',
                'project_number' => [
                    'required',
                    Rule::unique('projects')
                        ->ignore($project->id) // Ignore the current record being updated
                        ->whereNull('deleted_at') // Ensure deleted_at is null
                ],
                'operation_area' => 'required',
                'sponsor_area' => 'required',
                'owner' => 'required',
                'directorate' => 'required',
                'project_sponsor' => 'required',
                'bc_presenter' => 'required',
                'bc_originator' => 'required',
                'email_pic' => 'required',
                'kpi_description' => 'required|array',
                'kpi_description.*' => 'required|string',
                'kpi_benefit' => 'required|array',
                'kpi_benefit.*' => 'required|string',
            ]);
        }


        DB::beginTransaction();
        try{
                $projectService = new ProjectService();
                /*$projectService->updateBudgetToolCriteria($project, $request);*/

                if(!$request->isQuickUpdate){
                    $project->project_name = $request->project_name;
                    $project->operation_area = $request->operation_area;
                    $project->sponsor_area = $request->sponsor_area;
                    $project->owner = $request->owner;
                    $project->sponsor = $request->project_sponsor;
                    $project->directorate = $request->directorate;
                    $project->bc_presenter = $request->bc_presenter;
                    $project->bc_originator = $request->bc_originator;
                    $project->bc_status = $request->bc_status;
                    $project->finance_analyst = $request->finance_analyst;
                    $project->email_pic = $request->email_pic;
                    $project->basket = $request->basket;
                    $project->sub_basket = $request->sub_basket;
                    $project->sub_basket_categories = $request->sub_basket_categories;

                    $businessCase = $project?->business_case;
                    $kpiData = [];
                    foreach ($request->kpi_description as $index => $description) {
                        $kpiData[] = [
                            'description' => $description,
                            'time_to_benefit' => $request->kpi_benefit[$index] ?? null,
                        ];
                    }

                    $businessCase->problem_statement_and_objective_text = $request->problem_statement;
                    $businessCase->objective = $request->objective;
                    $businessCase->project_scope_of_work_text = $request->scope_of_work;
                    $businessCase->npv = $request->npv;
                    $businessCase->irr = $request->irr;
                    $businessCase->payback_period = $request->payback_period;
                    $businessCase->tco = $request->tco;
                    $businessCase->cost_estimate = $request->cost_estimate;
                    $businessCase->kpi_summary = json_encode($kpiData);

                    $att = $projectService->uploadFilepond($request, $project);

                    $oldAtt = json_decode($project->business_case?->attachment, true);
                    $riskAssessment = $businessCase->riskAssessment;
                    $riskAssessment->risk_level_residual = $request->risk_level_residual;
                    $riskAssessment->risk_level_forecast = $request->risk_level_forecast;
                    $riskAssessment->risk_level_deduction = $request->risk_deduction;

                    $riskAssessment->save();
                    $currentVersion = $project->version + 1;

                    // Fields to track changes
                    $fieldsToTrack = [
                        'cost_estimate', 'project_name', 'directorate', 'operation_area', 'sponsor_area',
                        'bc_presenter', 'bc_originator', 'finance_analyst', 'email_pic', 'checkbox_basket',
                        'checkbox_sub_basket', 'problem_statement', 'objective', 'scope_of_work', 'npv',
                        'irr', 'payback_period', 'tco', 'risk_level_residual', 'risk_level_forecast','kpi',
                        'risk_deduction','business_case','preliminary_design','hazop','moc_document','cost_estimate_file','quotation_of_equipment','lcc_report','financial_evaluation','risk_assessment'
                    ];

                    $attachments = [
                        'business_case','preliminary_design','hazop','moc_document','cost_estimate_file','quotation_of_equipment','lcc_report','financial_evaluation','risk_assessment'
                    ];

                    if ($request->status == 'PUBLISH') {

                        $logArray = [];
                        $changesArray = [];

                        if ($project->version >= 1) {
                            // Fetch the old version log
                            $oldVersionLog = RevisionLog::where('project_id', $project->id)
                                ->where('revision', $project->version)
                                ->first();

                            // Decode the old version data, if available
                            $oldVersionData = $oldVersionLog ? json_decode($oldVersionLog->summary_of_changes, true) : [];
                            // Decode business_case_attachment to get the array
                            $businessCaseAttachment = json_decode($project->business_case->attachment, true);

                            foreach ($fieldsToTrack as $field) {
                                foreach ($oldVersionData as $oldLog) {
                                    if($oldLog['field'] == $field) {
                                        $newValue = $request->$field;
                                        if(in_array($field, $attachments)) {
                                            $newValue = $att->get($field);
                                        }

                                        if($field == 'kpi'){
                                            $newValue = json_encode($kpiData);
                                        }

                                        if ($oldLog['newValue'] != $newValue) {
                                            $changesArray[] = [
                                                'field' => $field,
                                                'newValue' => $newValue,
                                                'oldValue' => $oldLog['newValue'],
                                            ];
                                        }
                                        $logArray[] = [
                                            'field' => $field,
                                            'newValue' => $newValue,
                                            'oldValue' => $oldLog['newValue'],
                                        ];
                                    }
                                }
                            }
                        } else {
                            foreach ($fieldsToTrack as $field) {
                                $newValue = $request->input($field, null);
                                if(array_key_exists($field, $attachments)) {
                                    $newValue = $att->get($field);
                                }
                                $logArray[] = [
                                    'field' => $field,
                                    'oldValue' => null,
                                    'newValue' => $newValue,
                                ];
                            }
                        }

                        if (!empty($logArray)) {
                            // Create a new revision log
                            $changes = json_encode($changesArray);
                            if(empty($changesArray)) $changes = null;
                            RevisionLog::create([
                                'revision' => $currentVersion,
                                'date' => now(),
                                'project_id' => $project->id,
                                'summary_of_changes' => json_encode($logArray),
                                'changes' => $changes,
                            ]);

                            // Update the project version
                            $project->version = $currentVersion;
                            $project->save();
                        }
                    }
                }

                $businessCase->attachment = json_encode($att);
                $businessCase->save();
                $project->save();
                DB::commit();

                if(Storage::exists($path)){
                    rename(Storage::path($path),Storage::path('documents/'.$project->project_name));
                }

        } catch(Exception $e){
            DB::rollback();
            if($request->ajax()) return response()->json($e->getMessage());
            return redirect('project/'.$project->id)->withErrors($e->getMessage());
        }

        if($request->ajax()){
            return response()->json([
                'status' => 200,
                'message' => 'Data Successfully Updated',
                'title' => $project->project_name,
                'id' => $project->id
            ]);
        }

        $request->session()->flash('alert-success', 'Data was successful updated!');
        return redirect('/project/'.$project->id);

    }

    public function updateNoteStatus(Project $project, Request $request){
        try {
            $ps = new ProjectService();
            DB::beginTransaction();
            if ($request->has('note')) {
                $pn = new ProjectNote(null);
                $project->note = $request->note;
                DB::table('notifications')->where('project_id', $project->id)
                    ->where('notifiable_id', $project->created_by)
                    ->where('type', get_class($pn))
                    ->whereNull('read_at')->delete();
                event(new Sending($project));

                $ps->sendEmailRemarkNotification($project);
            }

            if($request->has('bc_status')) $project->bc_status = $request->bc_status;
            $project->save();
            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => 'Data Successfully Updated',
                'title' => $project->project_name,
                'id' => $project->id
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            if($request->ajax()) return response()->json($e->getMessage());
        }
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
    public function getProjectNote(Request $request){
        $project = Project::where('id', $request->id)->select('id', 'note')->first();
        return response()->json([
            'status' => 200,
            'project' => $project
        ]);
    }

    public function getDepartmentByDirectorate(Request $request){
        $type = Department::where('type','=', Department::TYPE['department'])->where('parent',$request->directorate)->get();
        $response = array();
        foreach($type as $t){
            $response[] = array(
                "id"=>$t->id,
                "text"=>$t->name
            );
        }
        return response()->json($response);
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

    public function getProjectByOperation()
    {
        $projects = Project::where('presented_year', config('constants.project_presented_year'))
            ->with(['ownersProject', 'business_case'])
            ->get()
            ->groupBy('ownersProject.name');

        $labels = [];
        $submittedBC = [];
        $remaining = [];

        $groupedCounts = $projects->map(function ($group) use (&$labels, &$submittedBC, &$remaining) {
            $label = $group->first()->ownersProject->name;
            $total = $group->count();

            $submittedBc = $group->filter(function ($d) {
                return $d->business_case?->status == "PUBLISH";
            })->count();

            $remainingBc = $total - $submittedBc;

            $labels[] = $label;
            $submittedBC[] = $submittedBc;
            $remaining[] = $remainingBc;

        });

        $result = [
            'label' => $labels,
            'submittedBC' => $submittedBC,
            'remaining' => $remaining
        ];

        return $result;
    }


    public function getProjectByOperationSubmitted()
    {
        $projects = Project::where('presented_year', config('constants.project_presented_year'))
            ->with(['ownersProject', 'business_case'])
            ->get()
            ->groupBy('ownersProject.name');

        $labels = [];
        $totalPerDepartmentArr = [];
        $submittedBCArr = [];
        $submittedAssessmentArr = [];

        $projects->each(function ($group, $label) use (&$labels, &$totalPerDepartmentArr, &$submittedBCArr, &$submittedAssessmentArr) {
            $labels[] = $label;

            $totalPerDepartment = $group->count(); // Total projects for the department

            $submittedBC = $group->filter(function ($d) {
                return $d->isSubmitBusinessCase() === 1;
            })->count();

            $submittedAssessment = $group->filter(function ($d) {
                return $d->isSubmitAssessment() === 1;
            })->count();

            $totalPerDepartmentArr[] = $totalPerDepartment;
            $submittedBCArr[] = $submittedBC;
            $submittedAssessmentArr[] = $submittedAssessment;
        });

        $result = [
            'label' => $labels,
            'totalPerDepartment' => $totalPerDepartmentArr,
            'submittedBC' => $submittedBCArr,
            'submittedAssessment' => $submittedAssessmentArr
        ];

        return $result;
    }

}
