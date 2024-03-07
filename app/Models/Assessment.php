<?php

namespace App\Models;

use App\Service\AssessmentService;
use App\Service\ProjectService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assessment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * cost_estimate will bi save in custom format #######,##
     * (.) will remove and comma will replace into (.)
     **/

    public const COMPLEXITY_SCORE = [
        'pds' => 'PDS',
        'complex' => 'COMPLEX',
        'moderate' => 'MODERATE',
        'light' => 'LIGHT'
    ];

    protected $guarded = ['id'];

    public function project(){
     return $this->belongsTo(Project::class,'project_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function fel1(){
        return $this->belongsTo(Fel1::class,'assessment_id');
    }

    public function checkInputValue($value){
        if(isset($value) && $value == 1) return 'checked';
        return '';
    }

    public function getAllAreaAssetCapitalization(){
        $json = json_decode($this->location_of_asset_capitalization);
        if(!$json) return null;
        return $json;
    }

    public function getKpiList(){
        $data = $this->key_performance_metric_text;
        if(!$data) return '';
        $json = json_decode($data);
        if($this->isKpiJson()){
            return $json;
        }

        return $data;

    }

    public function isKpiJson(){
        $data = $this->key_performance_metric_text;
        if(!$data) return false;
        json_decode($data);
        if(json_last_error() == JSON_ERROR_NONE){
            return true;
        }

        return false;
    }




}
