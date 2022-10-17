<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SettingController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }

    /**
     * Get Project Type in setting table
     */
    public function getProjectType(Request $request){
        $type = Setting::where('setting_name','=',$request->category)->get();
        $response = array();
        foreach($type as $t){
            $response[] = array(
                "id"=>$t->setting_value,
                "text"=>$t->setting_value
            );
        }

        return response()->json($response);
    }

    public function download(Request $request){
        $file=storage_path('app\\documents\\') . $request->document_name;
        return Response::download($file);
    }
}
