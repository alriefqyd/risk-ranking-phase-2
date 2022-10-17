<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fel2 extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function user(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function project(){
        return $this->belongsTo(Project::class,'project_id')->withTrashed();
    }
}
