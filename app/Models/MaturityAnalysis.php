<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaturityAnalysis extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $table = 'maturity_analysis';
    protected $dates = ['deleted_at'];


    public function fel3(){
        return $this->belongsTo(Fel3::class,'fels_id');
    }
}
