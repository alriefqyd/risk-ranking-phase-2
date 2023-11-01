<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function capexInvestments() {
        return $this->belongsToMany(CapexInvestment::class, 'capex_investment_sub_basket_categories', 'categories_id', 'capex_investment_sub_basket_id');
    }

    public function projects(){
        return $this->hasMany(Project::class,'sub_basket_categories');
    }

    public function criterias(){
        return $this->belongsToMany(Criteria::class,'criterias_categories')->withPivot('sub_basket_id');
    }
}
