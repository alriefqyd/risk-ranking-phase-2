<?php

namespace App\Service;

use App\Models\Setting;

class SettingService
{
    public function getProjectType(){
        return Setting::where('setting_type',Setting::PROJECT_TYPE)->where('status','ACTIVE')->get();
    }

    public function getAllInvestmentStrategy(){
        $data = Setting::where('setting_type', Setting::INVESTMENT_STRATEGY)->first();
        $json = json_decode($data->setting_value);
        return $json;
    }
}
