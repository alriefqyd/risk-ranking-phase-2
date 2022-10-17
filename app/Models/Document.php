<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = ['document_name','upload_by','description','owner','set_home'];

    public function user(){
        return $this->belongsTo(User::class,'upload_by');
    }
    public function owners(){
        return $this->belongsTo(Department::class,'owner');
    }
}
