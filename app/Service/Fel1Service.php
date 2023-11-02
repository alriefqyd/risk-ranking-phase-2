<?php

namespace App\Service;

use App\Models\Fel1;
use App\Models\Project;
use App\Models\User;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Fel1Service
{
    public function getAllFel1(){
        return $this->getDataFel1(null, false)->get();
    }

    public function countFel1($status){
        return $this->getDataFel1($status,true)->count();
    }

    public function getDataFel1($status, $newData){
        $userService = new UserService();
        $data = Fel1::with(['project.assessment','user']);
        $presented_year = config('constants.project_presented_year');

        $data = $data->whereHas('project', function($q) use ($newData,$userService, $presented_year){
            $subQuery = $q->where('presented_year',$presented_year)->whereNull('deleted_at');
            if($userService->isAdminDept()) return $subQuery->where('owner',Auth::user()->department);
            return $subQuery;
        });

        if($status){
            $data = $data->where('status',$status);
        }

        return $data;

    }

    public function isFel1ProjectExist($project_id){
        $fel1 = Fel1::with(['project'])->where('project_id', $project_id)->first();
        return $fel1;
    }

    public function getUrlRedirection($fel1){
        $url = '';
        if(Auth::user()->role != User::ROLE['admin']){
            $url = $fel1->id;
        }

        return $url;
    }

    public function isValidProject(Request $request){
        $valid = Project::with(['assessment','createdBy'])->where('id',$request->project_id)->first();
        return $valid;
    }
}
