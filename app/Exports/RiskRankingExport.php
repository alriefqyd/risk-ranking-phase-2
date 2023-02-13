<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class RiskRankingExport implements FromCollection, WithMultipleSheets
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
    }

    public function sheets(): array
    {
        $sheets = [
            'Project' => new ProjectListExport(),
            'Cost Benefit' => new CostBenefitExport(),
        ];

        return $sheets;
    }
}
