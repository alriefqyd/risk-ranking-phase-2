<?php

namespace App\Service;

use App\Models\Fel2;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Fel2Service
{
    public function getAllFel2(){
        return $this->getDataFel2(null,false)->get();
    }

    public function countFel2($status){
        return $this->getDataFel2($status,true)->count();
    }

    public function getDataFel2($status, $newData){
        $userService = new UserService();
        $presented_year = config('constants.project_presented_year');

        $data = Fel2::with(['project.assessment','user'])->whereHas('project',function($q) use ($presented_year){
            return $q->where('presented_year', $presented_year);
        });

        if($userService->isAdminDept()){
            $data = $data->whereHas('project', function($q) use ($newData,$userService, $presented_year){
                $subQuery = $q->where('presented_year', $presented_year)->whereNull('deleted_at');
                if($userService->isAdminDept()) $q->where('owner',Auth::user()->department);
                return $subQuery;
            });
        }

        if($status){
            $data = $data->where('status',$status);
        }

        return $data;

    }
    public function isFel2ProjectExist($project_id){
        $fel2 = Fel2::with(['project'])->where('project_id', $project_id)->first();
        return $fel2;
    }

    public function getUrlRedirection($fel2){
        $url = '';
        if(Auth::user()->role != User::ROLE['admin']){
            $url = $fel2->id;
        }

        return $url;
    }
}
