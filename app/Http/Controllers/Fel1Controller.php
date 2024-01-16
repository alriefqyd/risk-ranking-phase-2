<?php

namespace App\Http\Controllers;

use App\Models\Fel1;
use App\Models\Project;
use App\Models\Setting;
use App\Service\Fel1Service;
use App\Service\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class Fel1Controller extends Controller
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
        $fel1 = Fel1::with(['project.assessment','user'])->whereHas('project',function ($q){
            return $q->filter(request(['q','owner','sponsor','category','type']))->where('presented_year', config('constants.project_presented_year'));
        });
        if($project_id){
            $fel1 = $fel1->orwhere('id',$project_id);
            $fel1ByProjectId = $fel1->first();
            if(!$fel1ByProjectId){
                abort(404);
            }
        }
        if(Auth::user()->role == User::ROLE['admin-dept']){
            $fel1 = $fel1->whereHas('project',function($q){
                return $q->where('owner',Auth::user()->department);
            });
        }
        return view('page.fel1.fel1_list',[
           'fels1' => $fel1->paginate(10)->withQueryString()
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
        $fel1Service = new Fel1Service();
        $projectService = new ProjectService();
        $isFel1Exist = $fel1Service->isFel1ProjectExist($request->project_id);
        $project = Project::with(['createdBy','fel1','assessment'])->where('id',$request->project_id)->first();
        $validProjectId = $fel1Service->isValidProject($request);
        if(!$validProjectId){
            abort(404);
        }
        if($isFel1Exist){
            abort('403');
        }
        if(!$project->assessment){
            abort(403,'Please Input Assessment First');
        }
        if($project && $projectService->projectNotAuthorized($project)){
            abort(404);
        }

        return view('fel1.create',[
            'project' => $project
        ]);
    }

    /*
     * Temporary Not Used
     */
    public function createByAssessment(Request $request)
    {
        $project = Project::with('createdBy')->where('id',$request->project_id)->first();
        return view('fel1.create',[
            'project' => $project
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

        $fel1Service = new Fel1Service();
        DB::beginTransaction();
        $data = $this->validate($request,[
            'project_id' =>'required',
        ]);

        try{
            $fel1 = new Fel1([
                'project_id' => $request->project_id,
                'project_scope' => $request->project_scope,
                'identified_parameter_requirement_regulation' => $request->identified_parameter_requirement_regulation,
                'alternatives' => $request->alternatives,
                'list_of_stakeholder' => $request->list_of_stakeholder,
                'schedule_project' => $request->schedule_project,
                'project_scope_text' => $request->project_scope_text,
                'identified_parameter_requirement_regulation_text' => $request->identified_parameter_requirement_regulation_text,
                'alternatives_text' => $request->alternatives_text,
                'list_of_stakeholder_text' => $request->list_of_stakeholder_text,
                'schedule_project_text' => $request->schedule_project_text,
                'department' => auth()->user()->department,
                'created_by' => auth()->user()->id
            ]);

            if($request?->status == 'publish'){
                $fel1->status = 'PUBLISH';
            }
            if($request?->status == 'draft'){
                $fel1->status = 'DRAFT';
            }

            $documentRequest = $this->setDocumentRequest($request);

            if(sizeof($documentRequest) > 0){
                $documents = $documentController->multipleUploadDocument($request, $documentRequest,null,$request->project_name,Setting::DOCUMENT_EXTENSION);
                if(sizeof($documents) > 0){
                    $fel1->attachment = $documents;
                }
            }


            $fel1->saveOrFail();
            DB::commit();
            $request->session()->flash('page-tab', 'fel1');
            $request->session()->flash('alert-success', 'FEL 1 was saved');
            return response()->json([
                'status' => 200,
                'url' => '/project/' . $request->project_id,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fel1  $fel1
     * @return \Illuminate\Http\Response
     */
    public function show(Fel1 $fel1)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fel1  $fel1
     * @return \Illuminate\Http\Response
     */
    public function edit(Fel1 $fel1, Request $request)
    {
        $this->authorize('update');
        $projectService = new ProjectService();
        $validId = Fel1::find($request->id);

        if(!$validId){
            abort(404);
        }

        $fel1 = Fel1::with(['project','user'])->where('id',$request->id)->first();
        if($fel1->project && $projectService->projectNotAuthorized($fel1->project)){
            abort(404);
        }
        return view('fel1.edit',[
            'fel1' => $fel1
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fel1  $fel1
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $documentController = new DocumentController();
        $this->authorize('update');
        $fel1Service = new Fel1Service();
        /*if($fel1->status == 'PUBLISH'){;
            abort(403);
        }*/

        DB::beginTransaction();

        try{
            $fel1 = Fel1::find($project?->fel1?->id);
            $fel1->project_scope = $request->project_scope;
            $fel1->identified_parameter_requirement_regulation = $request->identified_parameter_requirement_regulation;
            $fel1->alternatives = $request->alternatives;
            $fel1->list_of_stakeholder = $request->list_of_stakeholder;
            $fel1->schedule_project = $request->schedule_project;
            $fel1->project_scope_text = $request->project_scope_text;
            $fel1->identified_parameter_requirement_regulation_text = $request->identified_parameter_requirement_regulation_text;
            $fel1->alternatives_text = $request->alternatives_text;
            $fel1->list_of_stakeholder_text = $request->list_of_stakeholder_text;
            $fel1->schedule_project_text = $request->schedule_project_text;
            if($request->status == 'publish'){
                $fel1->status = 'PUBLISH';
            }
            if($request->status == 'draft'){
                $fel1->status = 'DRAFT';
            }

            $documentRequest = $this->setDocumentRequest($request);;
            $existingDocument = collect([]);

            if($fel1?->attachment){
                $existingDocuments = json_decode($fel1?->attachment,true);
                foreach ($existingDocuments as $key => $value){
                    $existingDocument->put($key,$value);
                }
            }

            $documents = $documentController->multipleUploadDocument($request, $documentRequest,$existingDocument,$request->project_name,Setting::DOCUMENT_EXTENSION);
            if(sizeof($documents) > 0){
                $fel1->attachment = $documents;
            }
            $fel1->saveOrFail();
            DB::commit();
            $request->session()->flash('page-tab', 'fel1');
            $request->session()->flash('alert-success', 'FEL 1 was successful updated!');
            return response()->json([
                'status' => 200,
                'url' => '/project/' . $project->id
            ]);
        } catch (\Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fel1  $fel1
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fel1 $fel1)
    {
        //
    }

    public function setDocumentRequest(Request $request){
        $documentRequest = collect([]);

        if(isset($request->parameter_regulation)) $documentRequest->put(Setting::FEL1_ATTACHMENT['parameter_regulation_requirement'],$request->parameter_regulation);
        if(isset($request->initial_process_diagram)) $documentRequest->put(Setting::FEL1_ATTACHMENT['initial_process_diagram'],$request->initial_process_diagram);
        if(isset($request->data_of_alternatives)) $documentRequest->put(Setting::FEL1_ATTACHMENT['data_of_alternatives'],$request->data_of_alternatives);
        if(isset($request->initial_schedule)) $documentRequest->put(Setting::FEL1_ATTACHMENT['initial_schedule'],$request->initial_schedule);
        if(isset($request->project_level_assessment)) $documentRequest->put(Setting::FEL1_ATTACHMENT['project_level_assessment'],$request->project_level_assessment);
        if(isset($request->stakeholder_list)) $documentRequest->put(Setting::FEL1_ATTACHMENT['stakeholder_list'],$request->stakeholder_list);
        if(isset($request->fel1_approve)) $documentRequest->put(Setting::FEL1_ATTACHMENT['fel1_approve'],$request->fel1_approve);

        return $documentRequest;
    }
}
