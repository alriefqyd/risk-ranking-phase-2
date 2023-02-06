<?php

namespace App\Service;

use App\Models\BusinessCaseAssessment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BusinessCaseService
{
    public function getAllBc(){
        return $this->getDataBc(null,false)->get();
    }

    public function countAllBc($status){
        return $this->getDataBc($status,true)->count();
    }

    public function getDataBc($status,$newData){
        $userService = new UserService();
        $data = BusinessCaseAssessment::with(['project.assessment','user']);

        $data = $data->whereHas('project', function($q) use ($newData,$userService){
            $subQuery = $q->whereNull('deleted_at');
            if($userService->isAdminDept()) return $subQuery->where('owner',Auth::user()->department);
            return $subQuery;
        });

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
