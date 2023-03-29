<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskAssessments extends Model
{
    use HasFactory;
    protected $guarded = ['id','business_case_assessment_id'];

    /*
     * since risk level change to severity this const not used anymore
     */
    const RISK_MATRIX = [
            64,96,160,256,416,32,
            48,80,128,208,16,24,
            40,104,8,12,20,
            52,4,6,10,26
    ];

    /*
     * since risk level change to severity this const not used anymore
     */
    const RISK_LEVEL = [
        0,1,2,3,4,5
    ];

    const SEVERITY = [
        0 => 'N/A',
        1 => 'Very Low',
        2 => 'Low',
        3 => 'Moderate',
        4 => 'Significant',
        5 => 'Critical',
        6 => 'Very Critical'
    ];

    const PROBABILITY = [
        1 => 'Very Remote',
        2 => 'Remote',
        3 => 'Possible',
        4 => 'Likely',
        5 => 'Very Likely'
    ];

    public function businessCase(){
        return $this->belongsTo(BusinessCaseAssessment::class,'business_case_assessment_id');
    }
}
