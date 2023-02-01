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


    public function getMaturityAnalysis($fels, $felsId){
        $data = MaturityAnalysis::where('fels_type',class_basename($fels))
            ->where('fels_id',$felsId)->first();

        return $data;
    }

    /**
     * Save Maturity Analysis Based on FEL
     * @param Request $request
     * @param $fels
     * @return void
     */
    public function saveMaturity(Request $request, $fels, $maturityAnalysis){
        $maturityRequest = Setting::MATURITY_ANALYSIS_ITEM;
        $maturityCollection = collect([]);


        foreach ($maturityRequest as $mr) {
            $request->whenHas($mr, function ($input) use ($maturityCollection,$mr) {
                $maturityCollection->push([
                    $mr => $input
                ]);
            });
        }

        $maturityAnalysis->value = $maturityCollection;
        $maturityAnalysis->fels_id = $fels->id;
        $maturityAnalysis->maturity_type = $request->maturity_type;
        $maturityAnalysis->summary = Setting::MATURITY_ANALYSIS_SUMMARY[$request->summary];
        $maturityAnalysis->fels_type = class_basename($fels);
        $maturityAnalysis->save();
    }
}
