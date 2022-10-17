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
        return $this->getDataFel1(null)->get();
    }

    public function countFel1($status){
        return $this->getDataFel1($status)->count();
    }

    public function getDataFel1($status){
        $userService = new UserService();

        $data = Fel1::with(['project.assessment','user']);
        if($userService->isAdminDept()){
            $data = $data->whereHas('project', function($q){
               return $q->where('owner',Auth::user()->department);
            });
        }
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
