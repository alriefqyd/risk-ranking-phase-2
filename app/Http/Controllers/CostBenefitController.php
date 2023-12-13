<?php

namespace App\Http\Controllers;

use App\Models\CostBenefit;
use App\Models\Project;
use App\Models\Setting;
use Illuminate\Http\Request;

class CostBenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project_id = $request->project_id;
        $project = Project::findOrFail($project_id);
        $cost = CostBenefit::where('project_id',$project_id)->first();
        $isUpdate = $request->isEdit;
        $documentController = new DocumentController();

        if($cost && $isUpdate){
            $cost->forceDelete();
        }

        $costBenefitCollection = collect([]);
        foreach ( $request->year as $index => $value ) {
           $costBenefitCollection->push([
              'year' => $request->year[$index],
               'initial_and_sustaining_capex' => $request->initial_and_sustaining_capex[$index],
               'additional_revenue' => $request->additional_revenue[$index],
               'increment_operating_cost' => $request->increment_operating_cost[$index],
               'cost_savings' => $request->cost_savings[$index],
               'net_incremental_benefits' => $request->net_incremental_benefits[$index]
           ]);
        }

        $attachment = $documentController->uploadDocument($request, $request->attachment, $cost->attachment ?? null, $project->project_name,Setting::DOCUMENT_EXTENSION);

        $cb = new CostBenefit([
            'project_id' => $project_id,
            'value' => $costBenefitCollection,
            'attachment' => $attachment
        ]);

        $cb->saveOrFail();
        $request->session()->flash('alert-success', 'Cost Benefit was successful added!');
        $request->session()->flash('page-tab', 'cost-benefit');
        return redirect('project/'. $project_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CostBenefit  $costBenefit
     * @return \Illuminate\Http\Response
     */
    public function show(CostBenefit $costBenefit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CostBenefit  $costBenefit
     * @return \Illuminate\Http\Response
     */
    public function edit(CostBenefit $costBenefit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CostBenefit  $costBenefit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CostBenefit $costBenefit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CostBenefit  $costBenefit
     * @return \Illuminate\Http\Response
     */
    public function destroy(CostBenefit $costBenefit)
    {
        //
    }

}
