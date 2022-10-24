<?php

namespace App\Http\Controllers;

use App\Models\Fel2;
use App\Models\Project;
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
                'department' => auth()->user()->department,
                'created_by' => auth()->user()->id
            ]);

            if($request->status == 'publish'){
                $fel2->status = 'PUBLISH';
            }
            if($request->status == 'draft'){
                $fel2->status = 'DRAFT';
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
