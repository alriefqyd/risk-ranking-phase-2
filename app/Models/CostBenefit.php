<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostBenefit extends Model
{
    use HasFactory;
    protected $fillable = ['value','project_id'];

    public function projects(){
        return $this->belongsTo(Project::class,'project_id');
    }
}
