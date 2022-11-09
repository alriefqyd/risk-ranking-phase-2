<?php

namespace App\Http\Controllers;

//use App\Exports\AssessmentExport;
use App\Models\Assessment;
use App\Models\Project;
use App\Models\Setting;
use App\Models\User;
use App\Rules\summernoteRequired;
use App\service\AssessmentService;
use App\service\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('read');
        $project_id = $request->id;
        $assessment = Assessment::with(['user','project'])->whereHas('project',function ($q){
            return $q->filter(request(['q','owner','sponsor','category','type']));
        });

        if($project_id){
            $assessment = $assessment->orwhere('id',$project_id);
            $assessmentGetByProject = $assessment->first();
            if(!$assessmentGetByProject->first()){
                abort(404);
            }

        }
        if(Auth::user()->role == User::ROLE['admin-dept']){
            $assessment = $assessment->whereHas('project',function($q){
                return $q->where('owner',Auth::user()->department);
            });
        }


        return view('page.assessment.assessment_list',[
            'assessments' => $assessment->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create');
        $assessmentService = new AssessmentService();
        $projectService = new ProjectService();
        $project = Project::where('id',$request->project_id)->first();
        if($project && $projectService->projectNotAuthorized($project)){
            abort(404);
        }

        $validProjectId = $assessmentService->isValidProject($request);
        $complexityScore = Assessment::COMPLEXITY_SCORE;
        if(!$validProjectId){
            abort(404,'Not Valid');
        }

        $isAssessmentExist = $assessmentService->isAssessmentProjectExist($request->project_id);
        if($isAssessmentExist){
            abort('403');
        }
        return view('assessment.create',[
            'project' => $project,
            'request' => $request,
            'complexity_score' => $complexityScore,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $documentController = new DocumentController();
        $this->authorize('create');
        $projectService = new ProjectService();
        DB::beginTransaction();
        //$this->validation($request);
        try{
            $assessment = new Assessment([
                'project_id' => $request->project_id,
                'problems_statement' => $request->problems_statement,
                'objective' => $request->objective,
                'project_scope' => $request->project_scope,
                'key_performance_metric' => $request->key_performance_metric,
                'key_project_risk_mitigants' => $request->key_project_risk_mitigants,
                'impact_if_not_executed' => $request->impact_if_not_executed,
                'cost_estimate' => $request->cost_estimate,
                'level_project' => $request->level_project,
                'alternative_to_proposal' => $request->alternative_to_proposal,
                'note'  => $request->note,
                'detail_estimate_cost' => $request->detail_estimate_cost,
                'complexity_score_assessment' => $request->complexity_score_assessment,
                'user_id' => Auth::user()->id,
                'problem_statement_text' => $request->problem_statement_text,
                'objective_text' => $request->objective_text,
                'project_scope_text' => $request->project_scope_text,
                'key_performance_metric_text' => $request->key_performance_metric_text,
                'key_project_risk_and_mitigants_text' => $request->key_project_risk_mitigants_text,
                'impact_if_not_executed_text' => $request->impact_if_not_executed_text,
                'alternatives_to_proposal_text' => $request->alternatives_to_proposal_text,
                'cost_estimate_text' => $request->cost_estimate_text,
                //'cost_estimate_text' => $projectService->priceToText($request->cost_estimate_text), //temporary not used until phase 2 start
                'level_project_text' => $request->level_project_text,
                'detail_estimate_cost_text' => $request->detail_estimate_cost_text,
            ]);

            if($request?->status == 'publish'){
                $assessment->status = 'PUBLISH';
            }
            if($request?->status == 'draft'){
                $assessment->status = 'DRAFT';
            }

            $documentsRequest = collect([]);
            if(isset($request->document_initial_cost_estimate)) $documentsRequest->put(Setting::ASSESSMENT_ATTACHMENT['initial_cost_estimate'],$request->document_initial_cost_estimate);
            if(isset($request->document_complexity_matrix)) $documentsRequest->put(Setting::ASSESSMENT_ATTACHMENT['complexity_matrix'],$request->document_complexity_matrix);

            if(sizeof($documentsRequest) > 0){
                $documents = $documentController->multipleUploadDocument($request, $documentsRequest, null, $request->project_name);
                if(sizeof($documents) > 0){
                    $assessment->attachment = $documents;
                }
            }

            $complexityAnalysis = $this->saveComplexityAnalysis($request);

            $assessment->complexity_analysis_type = $request->complexity_analysis_type;
            $assessment->complexity_analysis = $complexityAnalysis;

            $assessment->saveOrFail();
            DB::commit();
            $request->session()->flash('page-tab', 'assessment');
            $request->session()->flash('alert-success', 'Assessment was saved');
            return response()->json([
                'status' => 200,
                'url' => '/project/' . $request->project_id,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assessment  $assessment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $this->authorize('read');
        $assessment = Assessment::with(['user','project'])->where('id',$request->id)->first();
        if(!$assessment){
            abort(404);
        }
        return view('assessment.detail',[
            'asmnt' => $assessment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assessment  $assessment
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $this->authorize('update');
        $projectService = new ProjectService();
        $validId = Assessment::find($request->id);

        if(!$validId){
            abort(404);
        }

        $assessment = Assessment::with(['project','user'])->where('id',$request->id)->first();
        if($assessment->project &&
            $projectService->projectNotAuthorized($assessment->project)){
            abort(404);
        }
        $complexityScore = Assessment::COMPLEXITY_SCORE;
        return view('assessment.edit',[
            'assessment' => $assessment,
            'complexity_score' => $complexityScore
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assessment  $assessment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {

        $documentController = new DocumentController();
        $this->authorize('update');
        $assessmentService = new AssessmentService();
        $projectService = new ProjectService();

        DB::beginTransaction();
        $this->validation($request);
        try{
            $assessment = Assessment::find($project?->assessment?->id);
            $assessment->problems_statement = $request->problems_statement;
            $assessment->objective = $request->objective;
            $assessment->project_scope = $request->project_scope;
            $assessment->key_performance_metric = $request->key_performance_metric;
            $assessment->key_project_risk_mitigants = $request->key_project_risk_mitigants;
            $assessment->impact_if_not_executed = $request->impact_if_not_executed;
            $assessment->cost_estimate = $request->cost_estimate;
            $assessment->level_project = $request->level_project;
            $assessment->note = $request->note;
            $assessment->status = $assessmentService->getStatus($request);
            $assessment->alternative_to_proposal = $request->alternative_to_proposal;
            $assessment->user_id = Auth::user()->id;
            $assessment->detail_estimate_cost = $request->detail_estimate_cost;
            $assessment->complexity_score_assessment = $request->complexity_score_assessment;
            $assessment->problem_statement_text = $request->problem_statement_text;
            $assessment->objective_text = $request->objective_text;
            $assessment->level_project_text = $request->level_project_text;
            $assessment->detail_estimate_cost_text =$request->detail_estimate_cost_text;
            $assessment->project_scope_text = $request->project_scope_text;
            $assessment->key_performance_metric_text = $request->key_performance_metric_text;
            $assessment->key_project_risk_and_mitigants_text = $request->key_project_risk_mitigants_text;
            $assessment->impact_if_not_executed_text = $request->impact_if_not_executed_text;
            $assessment->alternatives_to_proposal_text = $request->alternatives_to_proposal_text;
            $assessment->cost_estimate_text = $request->cost_estimate_text;
            if($request?->status == 'publish'){
                $assessment->status = 'PUBLISH';
            }
            if($request?->status == 'draft'){
                $assessment->status = 'DRAFT';
            }

            $documentsRequest = collect([]);
            $existingDocument = collect([]);
            $existingDocuments = json_decode($assessment?->attachment,true);
            foreach ($existingDocuments as $key => $value){
                $existingDocument->put($key,$value);
            }

            if($request->document_initial_cost_estimate) $documentsRequest->put(Setting::ASSESSMENT_ATTACHMENT['initial_cost_estimate'],$request->document_initial_cost_estimate);
            if($request->document_complexity_matrix) $documentsRequest->put(Setting::ASSESSMENT_ATTACHMENT['complexity_matrix'],$request->document_complexity_matrix);

            $documents = $documentController->multipleUploadDocument($request, $documentsRequest, $existingDocument, $request->project_name);

            if(sizeof($documents) > 0){
                $assessment->attachment = $documents;
            }

            $complexityAnalysis = $this->saveComplexityAnalysis($request);

            $assessment->complexity_analysis_type = $request->complexity_analysis_type;
            $assessment->complexity_analysis = $complexityAnalysis;

            $assessment->saveOrFail();
            DB::commit();
            $request->session()->flash('page-tab', 'assessment');
            $request->session()->flash('alert-success', 'Assessment was successful updated!');
            return response()->json([
                'status' => 200,
                'url' => '/project/' . $project->id,
            ]);
        } catch (\Exception $e){
            DB::rollBack();
            return response()->json($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assessment  $assessment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assessment $assessment)
    {
        //
    }

    public function validation(Request $request){
        $data = $this->validate($request,[
            'problem_statement_text' => new summernoteRequired($request->problems_statement, 'Problem Statement'),
            'objective_text' => new summernoteRequired($request->objective, 'Objective'),
            'project_scope_text' => new summernoteRequired($request->project_scope, 'Project Scope'),
            'key_performance_metric_text' => new summernoteRequired($request->key_performance_metric, 'Key Performance Metric'),
            'key_project_risk_mitigants_text' => new summernoteRequired($request->key_project_risk_mitigants, 'Key Project Risk Mitigants'),
            'impact_if_not_executed_text' => new summernoteRequired($request->impact_if_not_executed, 'Impact if not Executed'),
            'alternatives_to_proposal_text' => new summernoteRequired($request->alternative_to_proposal, 'Alternatives to Proposal'),
            'cost_estimate_text' => new summernoteRequired($request->cost_estimate, 'Cost Estimate'),
            'level_project_text' => new summernoteRequired($request->level_project, 'Level Project'),
            'detail_estimate_cost_text' => new summernoteRequired($request->detail_estimate_cost, 'Detail Estimate Cost')
        ]);
    }

    /**
     * Save Complexity Analysis
     * @return \Illuminate\Support\Collection
     */
    public function saveComplexityAnalysis(Request $request){
        $complexityAnalysis = collect([]);

        if(isset($request->investment_just_purchase)) $complexityAnalysis->put('investment_just_purchase' , $request->investment_just_purchase);
        if(isset($request->needs_engineering_development)) $complexityAnalysis->put('needs_engineering_development' , $request->needs_engineering_development);
        if(isset($request->require_more_two)) $complexityAnalysis->put('require_more_two' , $request->require_more_two);
        if(isset($request->require_more_two_simultant)) $complexityAnalysis->put('require_more_two_simultant' , $request->require_more_two_simultant);
        if(isset($request->num_work_one_hundred)) $complexityAnalysis->put('num_work_one_hundred' , $request->num_work_one_hundred);
        if(isset($request->transportation_under_vale)) $complexityAnalysis->put('transportation_under_vale' , $request->transportation_under_vale);
        if(isset($request->require_shutdown)) $complexityAnalysis->put('require_shutdown' , $request->require_shutdown);
        if(isset($request->interferences_delay)) $complexityAnalysis->put('interferences_delay' , $request->interferences_delay);
        if(isset($request->require_environmental_license)) $complexityAnalysis->put('require_environmental_license' , $request->require_environmental_license);
        if(isset($request->require_community_involvement)) $complexityAnalysis->put('require_community_involvement' , $request->require_community_involvement);
        if(isset($request->require_purchase)) $complexityAnalysis->put('require_purchase' , $request->require_purchase);
        if(isset($request->score)) $complexityAnalysis->put('score' , $request->score);

        return $complexityAnalysis;
    }

}
