<?php

namespace App\Service;

use App\Models\Fel3;
use App\Models\MaturityAnalysis;
use App\Models\Setting;
use Illuminate\Http\Request;


class MaturityService
{
    public function __construct(){
        $this->fel3 = new Fel3();
    }

    /**
     * Save Maturity Analysis Based on FEL
     * @param Request $request
     * @param $fels
     * @return void
     */
    public function saveMaturity(Request $request, $fels){
        $maturityRequest = Setting::MATURITY_ANALYSIS_ITEM;
        $maturityCollection = collect([]);


        foreach ($maturityRequest as $mr) {
            $request->whenHas($mr, function ($input) use ($maturityCollection,$mr) {
                $maturityCollection->push([
                    $mr => $input
                ]);
            });
        }

        $maturityAnalysis = new MaturityAnalysis();
        $maturityAnalysis->value = $maturityCollection;
        $maturityAnalysis->fels_id = $fels->id;
        $maturityAnalysis->maturity_type = $request->maturity_type;
        $maturityAnalysis->summary = Setting::MATURITY_ANALYSIS_SUMMARY[$request->summary];
        $maturityAnalysis->fels_type = class_basename($fels);
        $maturityAnalysis->save();
    }
}
