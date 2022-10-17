<?php

namespace App\Service;

use App\Models\Fel2;
use App\Models\Fel3;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Fel3Service
{
    public function getAllFel3(){
        return $this->getDataFel1(null)->get();
    }

    public function countFel3($status){
        return $this->getDataFel1($status)->count();
    }

    public function getDataFel1($status){
        $userService = new UserService();

        $data = Fel3::with(['project.assessment','user']);
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
