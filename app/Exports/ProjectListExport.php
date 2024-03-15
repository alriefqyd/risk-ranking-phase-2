<?php

namespace App\Exports;

use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
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
        $this->size = 210;
    }


    public function view(): View
    {

        $projects = Project::select('projects.id', 'projects.project_name', 'basket.name as basket', 'subBasket.name as subBasket', 'categories.name as categoriesName','operation.name as operation','sponsor.name as sponsor',
            'bc_presenter','finance_analyst','projects.created_at','assessments.level_project_text as level_project_text_assessment','assessments.executive_summary as executive_summary_assessment','assessments.problems_statement as problem_statement_assessment','assessments.objective as objective_assessment','assessments.project_scope as project_scope_assessment'
            ,'assessments.alternative_to_proposal as alternative_to_proposal_assessment','assessments.project_schedule as project_schedule_assessment','assessments.list_equipment_specification as list_equipment_specification_assessment','assessments.key_performance_metric as key_performance_metric_assessment','assessments.key_project_risk_mitigants as key_project_risk_mitigants_assessment','assessments.impact_if_not_executed as impact_if_not_executed_assessment',
            'assessments.hazop_study as hazop_study_assessment','assessments.complexity_score_assessment as complexity_score_assessment','assessments.level_project as level_project_assessment','assessments.attachment as assessment_attachment','assessments.cost_estimate_text as cost_estimate_text_assessment'
//            ,'projects.note','assessments.impact_if_not_executed_text', 'assessments.executive_summary_text','assessments.problem_statement_text','assessments.objective_text','assessments.hazop_study_text','assessments.project_scope_text','assessments.alternatives_to_proposal_text','assessments.project_schedule_text','assessments.list_equipment_specification_text','assessments.key_performance_metric_text', 'assessments.key_project_risk_and_mitigants_text'
            ,'assessments.location_of_asset_capitalization as location_of_asset_capitalization_assessment', 'assessments.cost_estimate as cost_estimate_assessment','fel1.project_scope as project_scope_fel1','fel1.attachment as fel1_attachment','fel2.project_scope as project_scope_fel2','fel2.identify_main_equipment as identify_main_equipment_fel2','fel2.alternatives_and_analysis as alternatives_and_analysis_fel2','fel2.attachment as fel2_attachment','fel3.executive_summary as executive_summary_fel3','fel3.problem_statement as problem_statement_fel3'
            ,'fel3.project_scope as project_scope_fel3','fel3.alternatives_and_best_option as alternatives_and_best_option_fel3','fel3.project_schedule as project_schedule_fel3','fel3.list_of_equipment_and_specification as list_of_equipment_and_specification_fel3','fel3.hazop_study as hazop_study_fel3','fel3.cost_estimate as cost_estimate_fel3','fel3.attachment as fel3_attachment','business_case.project_scope_of_work as project_scope_of_work_business_case'
            ,'business_case.financial_evaluation as financial_evaluation_business_case','business_case.risk_assessment as risk_assessment_business_case','business_case.cost_estimate as cost_estimate_business_case','risk_assessment.people','risk_assessment.environment','risk_assessment.social_and_human_rights'
            ,'risk_assessment.reputation','risk_assessment.finance','risk_assessment.final_impact_score','business_case.npv as npv_business_case','business_case.irr as irr_business_case','business_case.payback_period as payback_period_business_case','business_case.attachment as business_case_attachment','priority_level'

        )
            ->leftJoin('capex_investment_categories as basket', 'basket.id', '=', 'projects.basket')
            ->leftJoin('capex_investment_categories as subBasket', 'subBasket.id', '=', 'projects.sub_basket')
            ->leftJoin('categories', 'projects.sub_basket_categories', '=', 'categories.id')
            ->leftJoin('departments as operation','operation.id', '=','projects.operation_area')
            ->leftJoin('departments as sponsor','sponsor.id', '=','projects.sponsor_area')
            ->leftJoin('assessments','assessments.project_id', '=','projects.id')
            ->leftJoin('fel1s as fel1','fel1.project_id', '=','projects.id')
            ->leftJoin('fel2s as fel2','fel2.project_id', '=','projects.id')
            ->leftJoin('fel3s as fel3','fel3.project_id', '=','projects.id')
            ->leftJoin('business_case_assessments as business_case','business_case.project_id', '=','projects.id')
            ->leftJoin('risk_assessments as risk_assessment','risk_assessment.business_case_assessment_id', '=','business_case.id')
            ->with('criterias')
            ->where('presented_year', $this->presented_year)->get();


        return view('page.project.export_project', [
            'project' => $projects
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $columnSize = $this->size + 5;
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

        $sheet->getStyle('A1:BM3')
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $sheet->getStyle('A1:BM3')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('3fa7fd');
        //$sheet->getColumnDimension('A')->setWidth('30'); work if shouldAutoSize is disable


        $column = "A1:BM3".($columnSize) ;
        $sheet->getStyle($column)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'background' => [
                'color'=> '#2978ff'
            ],
        ]);
    }

    public function title(): string
    {
       return 'Risk Ranking 2023';
    }

    public function columnFormats(): array
    {
        return [
            'AA' => NumberFormat::FORMAT_ACCOUNTING_USD_2,
            'AV' => NumberFormat::FORMAT_ACCOUNTING_USD_2,
            'BG' => NumberFormat::FORMAT_ACCOUNTING_USD_2,
            'BR' => NumberFormat::FORMAT_ACCOUNTING_USD_2,
            'BH' => NumberFormat::FORMAT_PERCENTAGE
        ];
    }
}
