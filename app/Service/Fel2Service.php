<?php

namespace App\Service;

use App\Models\Fel2;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Fel2Service
{
    public function getAllFel2(){
        return $this->getDataFel2(null)->get();
    }

    public function countFel2($status){
        return $this->getDataFel2($status)->count();
    }

    public function getDataFel2($status){
        $userService = new UserService();

        $data = Fel2::with(['project.assessment','user']);
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
