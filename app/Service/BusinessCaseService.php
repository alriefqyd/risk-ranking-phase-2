<?php

namespace App\Service;

use App\Models\BusinessCaseAssessment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BusinessCaseService
{
    public function getAllBc(){
        return $this->getDataBc(null)->get();
    }

    public function countAllBc($status){
        return $this->getDataBc($status)->count();
    }

    public function getDataBc($status){
        $userService = new UserService();

        $data = BusinessCaseAssessment::with(['project.assessment','user']);
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
    public function isBusinessCaseExist($project_id){
        $business_case = BusinessCaseAssessment::with(['project'])->where('project_id', $project_id)->first();
        return $business_case;
    }

    public function getUrlRedirection($business_case){
        $url = '';
        if(Auth::user()->role != User::ROLE['admin']){
            $url = $business_case->id;
        }

        return $url;
    }
}
