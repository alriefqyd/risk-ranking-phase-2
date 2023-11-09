<?php

namespace App\Http\Controllers;

use App\Models\CapexInvestment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CapexInvestmentController extends Controller
{
    public function getSubBasketByBasket(Request $request){
        $key = 'sub_basket_'.$request->basket;
        $cacheBasket = Cache::get($key);

        if($cacheBasket !== null) return $cacheBasket;

        $data = CapexInvestment::where('type',CapexInvestment::type['sub_basket'])->where('parent_id',$request->basket)->get();

        if(!$data) return null;
        Cache::put($key, $data, 43200);

        return $data;
    }

    public function getCategoriesBySubBasket(Request $request){
        $key = 'categories_'.$request->sub_basket;
        $cacheCategories = Cache::get($key);

        if($cacheCategories !== null) return $cacheCategories;

        $data = CapexInvestment::with('categories')->whereHas('categories',function($q) use ($request){
            return $q->where('capex_investment_sub_basket_id', $request->sub_basket);
        })->where('type',CapexInvestment::type['sub_basket'])->first();

        if(!$data) return null;

        Cache::put($key, $data->categories, 43200);
        return $data->categories;
    }
}
