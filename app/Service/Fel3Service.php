<?php

namespace App\Service;

use App\Models\Fel2;
use App\Models\Fel3;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Fel3Service
{
    public function getAllFel3(){
        return $this->getDataFel3(null,false)->get();
    }

    public function countFel3($status){
        return $this->getDataFel3($status,true)->count();
    }

    public function getDataFel3($status,$newData){
        $userService = new UserService();
        $data = Fel3::with(['project.assessment','user']);

        $data = $data->whereHas('project', function($q) use ($newData,$userService){
            $subQuery = $q->where('presented_year','2024')->whereNull('deleted_at');
            if($userService->isAdminDept()) return $subQuery->where('owner',Auth::user()->department);
            return $subQuery;
        });

        if($status){
            $data = $data->where('status',$status);
        }

        return $data;

    }
    public function isFel3ProjectExist($project_id){
        $fel3 = Fel3::with(['project'])->where('project_id', $project_id)->first();
        return $fel3;
    }

    public function getUrlRedirection($fel3){
        $url = '';
        if(Auth::user()->role != User::ROLE['admin']){
            $url = $fel3->id;
        }

        return $url;
    }
}
