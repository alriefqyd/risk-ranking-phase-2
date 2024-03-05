<?php

namespace App\Exports;

use App\Models\Project;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProjectListExport extends AfterSheet implements FromView, WithHeadingRow, ShouldAutoSize, WithStyles,
    WithTitle, WithColumnFormatting
{
    public function __construct()
    {
        $worksheet = new Worksheet();
        $this->worksheet = $worksheet;
        $this->presented_year = config('constants.project_presented_year');
        $this->size = 200;
    }


    public function view(): View
    {
        $cb = Project::with(['ownersProject', 'sponsorsProject', 'assessment', 'baskets', 'subBaskets'])
            ->where('presented_year', $this->presented_year)
            ->get();

        return view('page.project.export_project', [
            'project' => $cb
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $columnSize = $this->size * 5 + 2;
        $sheet->getStyle('A1:CC3')->applyFromArray([
            'font' => [
                'bold' => true,
                'italic' => false,
            ],
            'alignment' => [
                'horizontal' =>Alignment::VERTICAL_CENTER,
                'vertical' => Alignment::HORIZONTAL_CENTER
            ],
        ]);



        $column = "A1:BU3".($columnSize) ;
    }

    public function title(): string
    {
       return 'Risk Ranking 2023';
    }

    public function columnFormats(): array
    {
        return [
            'X' => NumberFormat::FORMAT_ACCOUNTING_USD_2,
            'AL' => NumberFormat::FORMAT_ACCOUNTING_USD_2,
            'BG' => NumberFormat::FORMAT_ACCOUNTING_USD_2,
            'BR' => NumberFormat::FORMAT_ACCOUNTING_USD_2,
            'BS' => NumberFormat::FORMAT_PERCENTAGE
        ];
    }
}
