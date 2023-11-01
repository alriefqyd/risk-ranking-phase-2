<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function categories(){
        return $this->belongsToMany(Category::class,'criterias_categories')->withPivot('sub_basket_id');
    }

    public function projects() {
        return $this->belongsToMany(Project::class,'criterias_projects')->withPivot('answer');
    }

    public function getOptionQuestion(){
        $jsonString = $this->questions;
        $data = json_decode($jsonString, true);
        if(!$data) return array();
        return $data;
    }

}
