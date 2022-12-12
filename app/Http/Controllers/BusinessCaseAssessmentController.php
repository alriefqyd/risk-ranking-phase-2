<?php

namespace App\Http\Controllers;

use App\Models\BusinessCaseAssessment;
use App\Models\Project;
use App\Models\RiskAssessments;
use App\Models\Setting;
use App\Models\User;
use App\Service\BusinessCaseService;
use App\Service\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BusinessCaseAssessmentController extends Controller
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
        $business_case = BusinessCaseAssessment::with(['project','user'])->whereHas('project',function($q){
            $q->filter(request(['q','owner','sponsor','category','type']));
        });

        if($project_id){
            $business_case = $business_case->orwhere('id',$project_id);
            if(!$business_case->first()){
                abort(404);
            }
        }
        if(Auth::user()->role == User::ROLE['admin-dept']){
            $business_case = $business_case->whereHas('project',function($q){
                return $q->where('owner', Auth::user()->department);
            });
        }
        return view('page.business_case.business_case_list',[
            'business_cases' => $business_case->paginate(10)->withQueryString()
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
        $business_case = new BusinessCaseService();
        $isBusinessCaseExist = $business_case->isBusinessCaseExist($request->project_id);
        $project = Project::with(['createdBy','fel1','fel2','fel3','assessment'])->where('id',$request->project_id)->first();

        if(!$project){
            abort(404);
        }

        if($isBusinessCaseExist){
            abort('403');
        }
        if(!$project->fel1 && !$project->fel2 && !$project->fel3){
            abort('403');
        }

        $riskMatrix = RiskAssessments::PROBABILITY;
        $collection = collect($riskMatrix);
        $sorted = $collection->sortDesc()->reverse();
        $sorted->values()->all();

        $risk_level = RiskAssessments::SEVERITY;

        return view('business_case.create',[
            'project' => $project,
            'riskMatrix' => $sorted,
            'riskLevel' => $risk_level
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
        $businessCaseService = new BusinessCaseService();
        $projectService = new ProjectService();

        DB::beginTransaction();
        $data = $this->validate($request,[
            'project_id' =>'required',
        ]);

        try{
            $business_case = new BusinessCaseAssessment([
                'project_id' => $request->project_id,
                'problem_statement_and_objective' => $request->problem_statement_and_objective,
                'project_alternatives' => $request->project_alternatives,
                'project_scope_of_work' => $request->project_scope_of_work,
                'major_equipment' => $request->major_equipment,
                'utility_requirements' => $request->utility_requirements,
                'permitting' => $request->permitting,
                'social_community_and_government' => $request->social_community_and_government,
                'cost_estimate' => $request->cost_estimate,
                'financial_evaluation' => $request->financial_evaluation,
                'risk_assessment' => $request->risk_assessment,
                'additional_information' => $request->additional_information,
                'problem_statement_and_objective_text' => $request->problem_statement_and_objective_text,
                'project_alternatives_text' => $request->project_alternatives_text,
                'project_scope_of_work_text' => $request->project_scope_of_work_text,
                'major_equipment_text' => $request->major_equipment_text,
                'utility_requirements_text' => $request->utility_requirements_text,
                'permitting_text' => $request->permitting_text,
                'social_community_and_government_text' => $request->social_community_and_government_text,
                'financial_evaluation_text' => $request->financial_evaluation_text,
                'additional_information_text' => $request->additional_information_text,
                'npv' => $request->npv,
                'irr' => $request->irr,
                'payback_period' => $request->payback_period,
                'department' => auth()->user()->department,
                'created_by' => auth()->user()->id
            ]);

            $riskAssessment = array(
                'people' => $request->people ?: 0,
                'environment' => $request->environment ?: 0,
                'social_and_human_rights' => $request->social_and_human_rights ?: 0,
                'reputation' => $request->reputation,
                'finance' => $request->finance,
                'final_impact_score' => $this->getFinalImpactScore($request),
                'probability' => $request->probability,
                'priority_level' => $request->priority_level,
            );

            if($request->status == 'publish'){
                $business_case->status = 'PUBLISH';
            }
            if($request->status == 'draft'){
                $business_case->status = 'DRAFT';
            }

            $documentRequest = collect([]);
            if(isset($request->attachment)) $documentRequest->put('business_case',$request->attachment);

            $extension = array_merge(Setting::DOCUMENT_EXTENSION,Setting::ARCHIVE_EXTENSION);
            if(sizeof($documentRequest) > 0){
                $documents = $documentController->multipleUploadDocument($request, $documentRequest,null,$request->project_name,Setting::DOCUMENT_EXTENSION);
                if(sizeof($documents) > 0){
                    $business_case->attachment = $documents;
                }
            }

            $business_case->saveOrFail();
            if($riskAssessment){
                $business_case->riskAssessment()->save(
                    new RiskAssessments($riskAssessment)
                );
            }

            DB::commit();
            $request->session()->flash('page-tab', 'business-case');
            $request->session()->flash('alert-success', 'Business Case 3 was saved');
            return response()->json([
                'status' => 200,
                'req' => $request->people,
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
     * @param  \App\Models\BusinessCaseAssessment  $businessCaseAssessment
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessCaseAssessment $businessCaseAssessment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BusinessCaseAssessment  $businessCaseAssessment
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessCaseAssessment $businessCaseAssessment, Request $request)
    {
        $this->authorize('update');
        $validId = BusinessCaseAssessment::find($request->id);

        if(!$validId){
            abort(404);
        }

        $businessCase = BusinessCaseAssessment::with(['project','user'])->where('id',$request->id)->first();
        $riskMatrix = RiskAssessments::PROBABILITY;
        $collection = collect($riskMatrix);
        $sorted = $collection->sortDesc()->reverse();
        $sorted->values()->all();

        $risk_level = RiskAssessments::SEVERITY;

        return view('business_case.edit',[
            'business_case' => $businessCase,
            'riskMatrix' => $riskMatrix,
            'riskLevel' => $risk_level
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BusinessCaseAssessment  $businessCaseAssessment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $documentController = new DocumentController();
        $this->authorize('update');
        $businessCaseService = new BusinessCaseService();
        $projectService = new ProjectService();
        /*if($businessCaseAssessment->status == 'PUBLISH'){;
            abort(403);
        }*/
        DB::beginTransaction();
        try{
            $businessCaseAssessment = BusinessCaseAssessment::find($project?->business_case?->id);
            $businessCaseAssessment->problem_statement_and_objective = $request->problem_statement_and_objective;
            $businessCaseAssessment->project_alternatives = $request->project_alternatives;
            $businessCaseAssessment->project_scope_of_work = $request->project_scope_of_work;
            $businessCaseAssessment->major_equipment = $request->major_equipment;
            $businessCaseAssessment->utility_requirements = $request->utility_requirements;
            $businessCaseAssessment->permitting = $request->permitting;
            $businessCaseAssessment->social_community_and_government = $request->social_community_and_government;
            $businessCaseAssessment->cost_estimate = $request->cost_estimate;
            $businessCaseAssessment->financial_evaluation = $request->financial_evaluation;
            $businessCaseAssessment->risk_assessment = $request->risk_assessment;
            $businessCaseAssessment->additional_information = $request->additional_information;
            $businessCaseAssessment->problem_statement_and_objective_text = $request->problem_statement_and_objective_text;
            $businessCaseAssessment->project_alternatives_text = $request->project_alternatives_text;
            $businessCaseAssessment->project_scope_of_work_text = $request->project_scope_of_work_text;
            $businessCaseAssessment->major_equipment_text = $request->major_equipment_text;
            $businessCaseAssessment->utility_requirements_text = $request->utility_requirements_text;
            $businessCaseAssessment->permitting_text = $request->permitting_text;
            $businessCaseAssessment->social_community_and_government_text = $request->social_community_and_government_text;
            $businessCaseAssessment->financial_evaluation_text = $request->financial_evaluation_text;
            $businessCaseAssessment->additional_information_text = $request->additional_information_text;
            $businessCaseAssessment->project_id = $request->project_id;
            $businessCaseAssessment->npv = $request->npv;
            $businessCaseAssessment->irr = $request->irr;
            $businessCaseAssessment->payback_period = $request->payback_period;

            $businessCaseAssessment->riskAssessment()->update([
                'people' => $request->people ?: 0,
                'environment' => $request->environment ?: 0,
                'social_and_human_rights' => $request->social_and_human_rights ?: 0,
                'reputation' => $request->reputation,
                'finance' => $request->finance,
                'final_impact_score' => $this->getFinalImpactScore($request),
                'probability' => $request->probability,
                'priority_level' => $request->priority_level,
            ]);

            if($request->status == 'publish'){
                $businessCaseAssessment->status = 'PUBLISH';
            }
            if($request->status == 'draft'){
                $businessCaseAssessment->status = 'DRAFT';
            }

            $documentRequest = collect([]);
            $existingDocument = collect([]);

            if(isset($request->attachment)) $documentRequest->put('business_case',$request->attachment);

            if($businessCaseAssessment?->attachment){
                $existingDocuments = json_decode($businessCaseAssessment?->attachment,true);
                foreach ($existingDocuments as $key => $value){
                    $existingDocument->put($key,$value);
                }
            }

            $extension = array_merge(Setting::DOCUMENT_EXTENSION,Setting::ARCHIVE_EXTENSION);
            $documents = $documentController->multipleUploadDocument($request, $documentRequest,$existingDocument,$request->project_name,$extension);
            if(sizeof($documents) > 0){
                $businessCaseAssessment->attachment = $documents;
            }

            $businessCaseAssessment->saveOrFail();
            DB::commit();
            $request->session()->flash('page-tab', 'business-case');
            $request->session()->flash('alert-success', 'Business Case was saved');
            return response()->json([
                'status' => 200,
                'url' => '/project/' . $request->project_id,
            ]);
        } catch (\Exception $e){
            DB::rollBack();
            return response()->json($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BusinessCaseAssessment  $businessCaseAssessment
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessCaseAssessment $businessCaseAssessment)
    {
        //
    }

    /**
     * function for get final impact score
     * @param Request $request
     * @return void
     */
    public function getFinalImpactScore(Request $request){

        $data = array(
            $request->people,
            $request->environment,
            $request->social_and_human_rights,
            $request->reputation,
            $request->finance,
        );

        return max($data);
    }
}
