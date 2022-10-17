<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fel1 extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function assessment(){
        return $this->belongsTo(Assessment::class,'assessment_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function project(){
        return $this->belongsTo(Project::class,'project_id')->withTrashed();
    }
}
