<?php

namespace App\Http\Controllers;

use App\Models\Department;
use \App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public function index(){

       $this->authorize('isAdmin');
       $user = User::with(['departments'])->orderBy('created_at','DESC')->paginate(10);
       return view('user.index',[
            'users' => $user
       ]);
   }

   public function create(){
        $this->authorize('isAdmin');
        $department = Department::where('type',Department::TYPE['department'])->get();
        $subDepartment = Department::where('type',Department::TYPE['sub-department'])->get();

        return view('user.create',[
           'department' => $department,
           'subDepartment' => $subDepartment
        ]);
   }
}
