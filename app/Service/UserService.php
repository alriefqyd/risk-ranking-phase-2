<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public $create = [
        User::ROLE['admin'],
        User::ROLE['admin-dept']
    ];
    public $read = [
        User::ROLE['sponsor'],
        User::ROLE['admin-dept'],
        User::ROLE['admin'],
        User::ROLE['viewer']
    ];
    public $update = [
        User::ROLE['sponsor'],
        User::ROLE['admin-dept'],
        User::ROLE['admin'],
    ];

    public $delete = [
        User::ROLE['admin'],
    ];

    public $export = [
        User::ROLE['admin'],
        User::ROLE['viewer']
    ];


    public function isUserHaveAccess(Array $role){
        $userRole = Auth::user()->role;
        return in_array($userRole,$role);
    }

    public function isAdmin(){
        return Auth::user()->role == User::ROLE['admin'];
    }

    public function isViewer(){
        return Auth::user()->role == User::ROLE['viewer'];
    }

    public function isAdminDept(){
        return Auth::user()->role == User::ROLE['admin-dept'];
    }

    public function getCurrentUser(){
        $user = User::where('id', auth()->user()->id);
        return $user;
    }
}
