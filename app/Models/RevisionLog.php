<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevisionLog extends Model
{
    use HasFactory;
    protected $fillable = ['project_id', 'revision', 'date', 'summary_of_changes'];

    public function project(){
        return $this->belongsTo(Project::class);
    }

}
