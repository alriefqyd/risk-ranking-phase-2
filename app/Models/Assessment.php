<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assessment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public const COMPLEXITY_SCORE = [
        'pds' => 'PDS',
        'complex' => 'COMPLEX',
        'moderate' => 'MODERATE',
        'light' => 'LIGHT'
    ];

    protected $guarded = ['id'];

    public function project(){
     return $this->belongsTo(Project::class,'project_id')->withTrashed();
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function fel1(){
        return $this->belongsTo(Fel1::class,'assessment_id');
    }
}
