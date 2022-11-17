<?php

namespace App\Http\Controllers;

use App\Models\Fel3;
use App\Models\Project;
use App\Models\Setting;
use App\Models\User;
use App\Service\Fel3Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Fel3Controller extends Controller
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
        $fel3 = Fel3::with(['project','user'])->whereHas('project',function($q){
            $q->filter(request(['q','owner','sponsor','category','type']));
        });

        if($project_id){
            $fel3 = $fel3->orwhere('id',$project_id);
            if(!$fel3->first()){
                abort(404);
            }
        }
        if(Auth::user()->role == User::ROLE['admin-dept']){
            $fel3 = $fel3->whereHas('project',function($q){
                return $q->where('owner', Auth::user()->department);
            });
        }
        return view('page.fel3.fel3_list',[
            'fels3' => $fel3->paginate(10)->withQueryString()
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
        $fel3Service = new Fel3Service();
        $isFel3Exist = $fel3Service->isFel3ProjectExist($request->project_id);
        $project = Project::with(['createdBy','fel1','fel2','assessment'])->where('id',$request->project_id)->first();
        if($isFel3Exist){
            abort('403');
        }
        if(!$project->assessment){
            abort(403);
        }
        return view('fel3.create',[
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
        DB::beginTransaction();
        $data = $this->validate($request,[
            'project_id' =>'required',
        ]);

        try{
            $fel3 = new Fel3([
                'project_id' => $request->project_id,
                'executive_summary' => $request->executive_summary,
                'problem_statement' => $request->problem_statement,
                'project_scope' => $request->project_scope,
                'alternatives_and_best_option' => $request->alternatives_and_best_option,
                'project_schedule' => $request->project_schedule,
                'list_of_equipment_and_specification' => $request->list_of_equipment_and_specification,
                'hazop_study' => $request->hazop_study,
                'cost_estimate' => $request->cost_estimate,
                'executive_summary_text' => $request->executive_summary_text,
                'problem_statement_text' => $request->problem_statement_text,
                'project_scope_text' => $request->project_scope_text,
                'alternatives_and_best_option_text' => $request->alternatives_and_best_option_text,
                'project_schedule_text' => $request->project_schedule_text,
                'list_of_equipment_and_specification_text' => $request->list_of_equipment_and_specification_text,
                'hazop_study_text' => $request->hazop_study_text,
                'cost_estimate_text' => $request->cost_estimate_text,
                'department' => auth()->user()->department,
                'created_by' => auth()->user()->id
            ]);

            $documentRequest = collect([]);
            if(isset($request->preliminary_design)) $documentRequest->put(Setting::FEL3_ATTACHMENT['preliminary_design'],$request->preliminary_design);
            if(isset($request->utility_infrastructure_facilities_diagram)) $documentRequest->put(Setting::FEL3_ATTACHMENT['utility_infrastructure_facilities_diagram'],$request->utility_infrastructure_facilities_diagram);
            if(isset($request->hazop)) $documentRequest->put(Setting::FEL3_ATTACHMENT['hazop'],$request->hazop);
            if(isset($request->moc_document)) $documentRequest->put(Setting::FEL3_ATTACHMENT['moc_document'],$request->moc_document);
            if(isset($request->cost_estimate_file)) $documentRequest->put(Setting::FEL3_ATTACHMENT['cost_estimate'],$request->cost_estimate_file);
            if(isset($request->quotation_of_equipment)) $documentRequest->put(Setting::FEL3_ATTACHMENT['quotation_of_equipment'],$request->quotation_of_equipment);
            if(isset($request->project_level_assessment)) $documentRequest->put(Setting::FEL3_ATTACHMENT['project_level_assessment'],$request->project_level_assessment);
            if(isset($request->fel1)) $documentRequest->put(Setting::FEL3_ATTACHMENT['fel1'],$request->fel1);
            if(isset($request->fel2)) $documentRequest->put(Setting::FEL3_ATTACHMENT['fel2'],$request->fel2);

            if(sizeof($documentRequest) > 0){
                $documents = $documentController->multipleUploadDocument($request, $documentRequest,null,$request->project_name);
                if(sizeof($documents) > 0){
                    $fel3->attachment = $documents;
                }
            }

            if($request->status == 'publish'){
                $fel3->status = 'PUBLISH';
            }
            if($request->status == 'draft'){
                $fel3->status = 'DRAFT';
            }

            $fel3->saveOrFail();
            DB::commit();
            $request->session()->flash('page-tab', 'fel3');
            $request->session()->flash('alert-success', 'FEL 3 was saved');
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
     * @param  \App\Models\Fel3  $fel3
     * @return \Illuminate\Http\Response
     */
    public function show(Fel3 $fel3)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fel3  $fel3
     * @return \Illuminate\Http\Response
     */
    public function edit(Fel3 $fel3, Request $request)
    {
        $this->authorize('update');
        $validId = Fel3::find($request->id);

        if(!$validId){
            abort(404);
        }

        $fel3 = Fel3::with(['project','user'])->where('id',$request->id)->first();

        return view('fel3.edit',[
            'fel3' => $fel3
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fel3  $fel3
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $documentController = new DocumentController();
        $this->authorize('update');
        /*if($fel3->status == 'PUBLISH'){;
            abort(403);
        }*/

        DB::beginTransaction();

        try{
            $fel3 = Fel3::find($project?->fel3?->id);
            $fel3->executive_summary = $request->executive_summary;
            $fel3->problem_statement = $request->problem_statement;
            $fel3->project_scope = $request->project_scope;
            $fel3->alternatives_and_best_option = $request->alternatives_and_best_option;
            $fel3->project_schedule = $request->project_schedule;
            $fel3->list_of_equipment_and_specification = $request->list_of_equipment_and_specification;
            $fel3->hazop_study = $request->hazop_study;
            $fel3->cost_estimate = $request->cost_estimate;
            $fel3->project_id = $request->project_id;
            $fel3->executive_summary_text = $request->executive_summary_text;
            $fel3->problem_statement_text = $request->problem_statement_text;
            $fel3->project_scope_text = $request->project_scope_text;
            $fel3->alternatives_and_best_option_text = $request->alternatives_and_best_option_text;
            $fel3->project_schedule_text = $request->project_schedule_text;
            $fel3->list_of_equipment_and_specification_text = $request->list_of_equipment_and_specification_text;
            $fel3->hazop_study_text = $request->hazop_study_text;
            $fel3->cost_estimate_text = $request->cost_estimate_text;

            $documentRequest = collect([]);
            $existingDocument = collect([]);

            if(isset($request->preliminary_design)) $documentRequest->put(Setting::FEL3_ATTACHMENT['preliminary_design'],$request->preliminary_design);
            if(isset($request->utility_infrastructure_facilities_diagram)) $documentRequest->put(Setting::FEL3_ATTACHMENT['utility_infrastructure_facilities_diagram'],$request->utility_infrastructure_facilities_diagram);
            if(isset($request->hazop)) $documentRequest->put(Setting::FEL3_ATTACHMENT['hazop'],$request->hazop);
            if(isset($request->moc_document)) $documentRequest->put(Setting::FEL3_ATTACHMENT['moc_document'],$request->moc_document);
            if(isset($request->cost_estimate_file)) $documentRequest->put(Setting::FEL3_ATTACHMENT['cost_estimate'],$request->cost_estimate_file);
            if(isset($request->quotation_of_equipment)) $documentRequest->put(Setting::FEL3_ATTACHMENT['quotation_of_equipment'],$request->quotation_of_equipment);
            if(isset($request->project_level_assessment)) $documentRequest->put(Setting::FEL3_ATTACHMENT['project_level_assessment'],$request->project_level_assessment);
            if(isset($request->fel1)) $documentRequest->put(Setting::FEL3_ATTACHMENT['fel1'],$request->fel1);
            if(isset($request->fel2)) $documentRequest->put(Setting::FEL3_ATTACHMENT['fel2'],$request->fel2);

            if($fel3?->attachment){
                $existingDocuments = json_decode($fel3?->attachment,true);
                foreach ($existingDocuments as $key => $value){
                    $existingDocument->put($key,$value);
                }
            }

            $documents = $documentController->multipleUploadDocument($request, $documentRequest,$existingDocument,$request->project_name);
            if(sizeof($documents) > 0){
                $fel3->attachment = $documents;
            }

            if($request->status == 'publish'){
                $fel3->status = 'PUBLISH';
            }
            if($request->status == 'draft'){
                $fel3->status = 'DRAFT';
            }

            $fel3->saveOrFail();
            DB::commit();
            $request->session()->flash('page-tab', 'fel3');
            $request->session()->flash('alert-success', 'FEL 3 was saved');
            return response()->json([
                'status' => 200,
                'url' => '/project/' . $request->project_id,
            ]);
        } catch (\Exception $e){
            DB::rollBack();
            return redirect('fel3/create/'.$request->project_id)->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fel3  $fel3
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fel3 $fel3)
    {
        //
    }
}
