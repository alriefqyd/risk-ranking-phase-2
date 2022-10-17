<?php

namespace App\Exports;

use App\Models\Project;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CostBenefitExport implements FromView, WithHeadingRow, ShouldAutoSize, WithStyles,
    WithTitle
{
    public function __construct()
    {
        $worksheet = new Worksheet();
        $this->worksheet = $worksheet;
        $this->size = Project::all()->count();
    }


    public function view(): View
    {
        $cb = Project::with('cost_benefits')->get();
        return view('project.export', [
            'project' => $cb
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $columnSize = $this->size * 5 + 2;
        $sheet->getStyle('1')->applyFromArray([
            'font' => [
                'bold' => true,
                'italic' => false,
            ],
            'alignment' => [
                'horizontal' =>Alignment::VERTICAL_CENTER,
                'vertical' => Alignment::HORIZONTAL_CENTER
            ],
        ]);

        $column = "A1:AI".($columnSize) ;
        $sheet->getStyle($column)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'background' => [
                'color'=> '#000000'
            ]
        ]);
        for($i=3;$i<=$columnSize;$i++){
            $sheet->setCellValue('AI'.$i,'=SUM(D'.$i.':AG'.$i.')');
        }
    }

    public function title(): string
    {
       return 'Cost Benefit';
    }
}
