<?php

namespace App\Service;

use App\Models\Setting;

class SettingService
{
    public function getProjectType(){
        return Setting::where('setting_type',Setting::PROJECT_TYPE)->where('status','ACTIVE')->get();
    }
}
