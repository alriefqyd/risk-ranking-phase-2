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
        return $this->hasMany(Project::class,'operation_area');
    }

    public function projectOwner(){
        return $this->hasMany(Project::class,'sponsor_area');
    }

    public function owners(){
        return $this->hasOne(Department::class, 'parent');
    }

    public function sponsors(){
        return $this->belongsTo(Department::class, 'parent');
    }
}
