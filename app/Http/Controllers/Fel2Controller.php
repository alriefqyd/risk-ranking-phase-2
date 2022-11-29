<?php

namespace App\Http\Controllers;

use App\Models\Fel2;
use App\Models\Project;
use App\Models\Setting;
use App\Models\User;
use App\Service\Fel2Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Fel2Controller extends Controller
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
        $fel2 = Fel2::with(['project','user'])->whereHas('project',function($q){
            $q->filter(request(['q','owner','sponsor','category','type']));
        });

        if(Auth::user()->role == User::ROLE['admin-dept']){
            $fel2 = $fel2->whereHas('project',function($q){
                return $q->where('owner', Auth::user()->department);
            });
        }
        return view('page.fel2.fel2_list',[
            'fels2' => $fel2->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

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
        $fel2Service = new Fel2Service();
        DB::beginTransaction();
        $data = $this->validate($request,[
            'project_id' =>'required',
        ]);

        try{
            $fel2 = new Fel2([
                'project_id' => $request->project_id,
                'project_scope' => $request->project_scope,
                'identify_main_equipment' => $request->identify_main_equipment,
                'boundary_and_assumption' => $request->boundary_and_assumption,
                'analysis_of_option' => $request->analysis_of_option,
                'permit_list' => $request->permit_list,
                'schedule_project' => $request->schedule_project,
                'cost_estimate' => $request->cost_estimate,
                'project_scope_text' => $request->project_scope_text,
                'identify_main_equipment_text' => $request->identify_main_equipment_text,
                'boundary_and_assumption_text' => $request->boundary_and_assumption_text,
                'analysis_of_option_text' => $request->analysis_of_option_text,
                'permit_list_text' => $request->permit_list_text,
                'schedule_project_text' => $request->schedule_project_text,
                'cost_estimate_text' => $request->cost_estimate_text,
                'department' => auth()->user()->department,
                'created_by' => auth()->user()->id
            ]);

            if($request->status == 'publish'){
                $fel2->status = 'PUBLISH';
            }
            if($request->status == 'draft'){
                $fel2->status = 'DRAFT';
            }

            $documentRequest = collect([]);
            if(isset($request->reference_of_capacity)) $documentRequest->put(Setting::FEL2_ATTACHMENT['reference_of_capacity'],$request->reference_of_capacity);
            if(isset($request->data_of_survey_parameter)) $documentRequest->put(Setting::FEL2_ATTACHMENT['data_of_survey_parameter'],$request->data_of_survey_parameter);
            if(isset($request->diagram_process)) $documentRequest->put(Setting::FEL2_ATTACHMENT['diagram_process'],$request->diagram_process);
            if(isset($request->initial_risk_assessment)) $documentRequest->put(Setting::FEL2_ATTACHMENT['initial_risk_assessment'],$request->initial_risk_assessment);
            if(isset($request->initial_utility_diagram)) $documentRequest->put(Setting::FEL2_ATTACHMENT['initial_utility_diagram'],$request->initial_utility_diagram);
            if(isset($request->quotation_main_equipment)) $documentRequest->put(Setting::FEL2_ATTACHMENT['quotation_main_equipment'],$request->quotation_main_equipment);
            if(isset($request->project_level_assessment)) $documentRequest->put(Setting::FEL2_ATTACHMENT['project_level_assessment'],$request->project_level_assessment);
            if(isset($request->fel1)) $documentRequest->put(Setting::FEL2_ATTACHMENT['fel1'],$request->fel1);
            if(isset($request->technical_evaluation)) $documentRequest->put(Setting::FEL2_ATTACHMENT['technical_evaluation'],$request->technical_evaluation);
            if(isset($request->financial_evaluation)) $documentRequest->put(Setting::FEL2_ATTACHMENT['financial_evaluation'],$request->financial_evaluation);
            if(isset($request->schedule_level_2)) $documentRequest->put(Setting::FEL2_ATTACHMENT['schedule_level_2'],$request->schedule_level_2);
            if(isset($request->file_cost_estimate)) $documentRequest->put(Setting::FEL2_ATTACHMENT['cost_estimate'],$request->file_cost_estimate);

            if(sizeof($documentRequest) > 0){
                $documents = $documentController->multipleUploadDocument($request, $documentRequest,null,$request->project_name);
                if(sizeof($documents) > 0){
                    $fel2->attachment = $documents;
                }
            }

            $fel2->saveOrFail();
            DB::commit();
            $request->session()->flash('page-tab', 'fel2');
            $request->session()->flash('alert-success', 'FEL 2 was saved');
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
     * @param  \App\Models\Fel2  $fel2
     * @return \Illuminate\Http\Response
     */
    public function show(Fel2 $fel2)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fel2  $fel2
     * @return \Illuminate\Http\Response
     */
    public function edit(Fel2 $fel2, Request $request)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fel2  $fel2
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $documentController = new DocumentController();
        $this->authorize('update');
        $fel2Service = new Fel2Service();
        /*if($fel2->status == 'PUBLISH'){;
            abort(403);
        }*/

        DB::beginTransaction();

        try{
            $fel2 = Fel2::find($project?->fel2?->id);
            $fel2->project_scope = $request->project_scope;
            $fel2->identify_main_equipment = $request->identify_main_equipment;
            $fel2->boundary_and_assumption = $request->boundary_and_assumption;
            $fel2->analysis_of_option = $request->analysis_of_option;
            $fel2->schedule_project = $request->schedule_project;
            $fel2->cost_estimate = $request->cost_estimate;
            $fel2->permit_list = $request->permit_list;
            $fel2->project_scope_text = $request->project_scope_text;
            $fel2->identify_main_equipment_text = $request->identify_main_equipment_text;
            $fel2->boundary_and_assumption_text = $request->boundary_and_assumption_text;
            $fel2->analysis_of_option_text = $request->analysis_of_option_text;
            $fel2->schedule_project_text = $request->schedule_project_text;
            $fel2->cost_estimate_text = $request->cost_estimate_text;
            $fel2->permit_list_text = $request->permit_list_text;

            $documentRequest = collect([]);
            $existingDocument = collect([]);

            if(isset($request->reference_of_capacity)) $documentRequest->put(Setting::FEL2_ATTACHMENT['reference_of_capacity'],$request->reference_of_capacity);
            if(isset($request->data_of_survey_parameter)) $documentRequest->put(Setting::FEL2_ATTACHMENT['data_of_survey_parameter'],$request->data_of_survey_parameter);
            if(isset($request->diagram_process)) $documentRequest->put(Setting::FEL2_ATTACHMENT['diagram_process'],$request->diagram_process);
            if(isset($request->initial_risk_assessment)) $documentRequest->put(Setting::FEL2_ATTACHMENT['initial_risk_assessment'],$request->initial_risk_assessment);
            if(isset($request->initial_utility_diagram)) $documentRequest->put(Setting::FEL2_ATTACHMENT['initial_utility_diagram'],$request->initial_utility_diagram);
            if(isset($request->quotation_main_equipment)) $documentRequest->put(Setting::FEL2_ATTACHMENT['quotation_main_equipment'],$request->quotation_main_equipment);
            if(isset($request->project_level_assessment)) $documentRequest->put(Setting::FEL2_ATTACHMENT['project_level_assessment'],$request->project_level_assessment);
            if(isset($request->fel1)) $documentRequest->put(Setting::FEL2_ATTACHMENT['fel1'],$request->fel1);
            if(isset($request->technical_evaluation)) $documentRequest->put(Setting::FEL2_ATTACHMENT['technical_evaluation'],$request->technical_evaluation);
            if(isset($request->financial_evaluation)) $documentRequest->put(Setting::FEL2_ATTACHMENT['financial_evaluation'],$request->financial_evaluation);
            if(isset($request->schedule_level_2)) $documentRequest->put(Setting::FEL2_ATTACHMENT['schedule_level_2'],$request->schedule_level_2);
            if(isset($request->file_cost_estimate)) $documentRequest->put(Setting::FEL2_ATTACHMENT['cost_estimate'],$request->file_cost_estimate);

            if($fel2?->attachment){
                $existingDocuments = json_decode($fel2?->attachment,true);
                foreach ($existingDocuments as $key => $value){
                    $existingDocument->put($key,$value);
                }
            }

            $documents = $documentController->multipleUploadDocument($request, $documentRequest,$existingDocument,$request->project_name);
            if(sizeof($documents) > 0){
                $fel2->attachment = $documents;
            }

            if($request->status == 'publish'){
                $fel2->status = 'PUBLISH';
            }
            if($request->status == 'draft'){
                $fel2->status = 'DRAFT';
            }

            $fel2->saveOrFail();
            DB::commit();
            $request->session()->flash('page-tab', 'fel2');
            $request->session()->flash('alert-success', 'FEL 2 was successful updated!');
            return response()->json([
                'status' => 200,
                'url' => '/project/' . $project->id
            ]);
        } catch (\Exception $e){
            DB::rollBack();
            return response()->json($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fel2  $fel2
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fel2 $fel2)
    {
        //
    }
}
