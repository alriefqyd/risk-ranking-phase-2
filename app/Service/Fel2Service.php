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

        $data = Fel2::with(['project.assessment','user']);
        if($userService->isAdminDept()){
            $data = $data->whereHas('project', function($q) use ($newData,$userService){
                $subQuery = $q->whereNull('deleted_at');
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
