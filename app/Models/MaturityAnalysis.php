<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaturityAnalysis extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'maturity_analysis';

    public function fel3(){
        return $this->belongsTo(Fel3::class,'fels_id');
    }
}
