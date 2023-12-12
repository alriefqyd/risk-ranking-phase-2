<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fel3 extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function user(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function project(){
        return $this->belongsTo(Project::class,'project_id');
    }

    public function maturityAnalysis(){
        return $this->hasOne(MaturityAnalysis::class, 'fels_id');
    }

    protected static function boot() {
        parent::boot();
        static::deleted(function ($fel3) {
            $fel3->maturityAnalysis()->delete();
        });
    }

    public function getScheduleList(){
        if($this->project_schedule_text == "") return "";
        $data = json_decode($this->project_schedule_text);
        $isMileStone = false;
            // Check if the decoding was successful
        if ($data !== null && json_last_error() === JSON_ERROR_NONE) {
            $isMileStone = true;
        }

        return [
            "isMilestone" => $isMileStone,
            "data" => $isMileStone ? $data : $this->project_schedule_text
        ];

    }
}
