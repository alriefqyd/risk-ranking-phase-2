<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public const TYPE = [
        "department" => "DEPARTMENT",
        "sub-department" => "SUB-DEPARTMENT"
    ];

    public function user(){
        return $this->hasMany(User::class,'department');
    }

    public function projects(){
        return $this->hasMany(Project::class,'owner');
    }

    public function projectSponsor(){
        return $this->hasMany(Project::class,'sponsor');
    }
}
