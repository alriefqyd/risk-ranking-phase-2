<?php

namespace App\Exports;

use App\Models\Project;
use App\Models\Setting;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProjectExport implements WithColumnFormatting, WithHeadingRow,
    FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithTitle
{

    use Exportable;

    public function __construct()
    {
        $worksheet = new Worksheet();
        $this->worksheet = $worksheet;
        $this->size = sizeof(Project::all());
    }


    /* set heading excel */
    public function headings(): array
    {
        return [
            [
            'Project Number',
            'Project Name',
            'Project Category',
            'Project Type',
            'Owner',
            'Project Sponsor',
            'BC Presenter',
            'Finance Analyst',
            'Assessment of Level Project',
            'Assessment',
            '','', '', '', '', '', '', '', '', '','', '', '', '', '', '', '', '', '','',
            'Form Project Level Complexity',
            '','',
            'Form Fel 1 Engineering Report',
            '', '', '', '', '', '','',
            'Form FEL 2 Engineering Report',
            '','','','','','','','','A','4. Project FEL 3 or Business Case form','W'
            ],
            ['','','','','','','','','','','','','','','','','','','','',
                '','','','','','','','','','','','','','','','','5. Form FEL 3',
                '','','','','','','','','','Form FEL 3','','','','','','','','','','Business Case','',
                '','','','','','','','','','Business Case Risk Assessment','','','','','','','','','Change Management Request',
                '',''
            ],
            [
                '','','','','','','','','',
                '1 Problem Statement','2 Objective',
                '3 Project Scope',
                '4 Key Performance Metric',
                '5 Key Project Risk And Mitigants',
                '6 Impact if not Executed',
                '7 Alternatives to Proposal',
                '8 Cost Estimate',
                '9 Complexity Score',
                '10 Assessment of Level Project',
                'Problem Statement',
                'Objective',
                'Project Scope',
                'Key Performance Metric',
                'Key Project Risk And Mitigants',
                'Impact if not Executed',
                'Alternatives to Proposal',
                'Cost Estimate',
                'Complexity Score',
                '10 Assessment of Level Project',
                '1. Cost Estimate',
                '2. Complexity Score',
                'Project Scope',
                'Identified Parameter,Requirement & Regulation',
                'Alternatives',
                'List of Stakeholder',
                'Schedule Project',
                'Attachment List',
                'Approval',
                'Project Scope',
                'Identify Main Equipment',
                'Boundary & Assumption',
                'Analysis of Option',
                'Permit List',
                'Schedule Project',
                'Cost Estimate',
                'Attachment List',
                'Approval',
                'Executive Summary',
                'Problem Statement',
                'Project Scope',
                'Alternatives & Best Option',
                'Project Schedule',
                'List of Equipment And Specification',
                'HAZOP Study',
                'Cost Estimate',
                'Attachment List',
                'Approval',
                'Project Title',
                'Problem Statement & Objective',
                'Project Alternatives',
                'Project Scope of Work',
                'Major Equipment',
                'Utility Requirements',
                'Permitting',
                '8 Social, Community and Government',
                'Cost Estimate',
                'Financial Evaluation',
                'Risk Assessment','People','Environment','Social and Human Rights',
                'Reputational','Finance','Final Impact Score',
                'Probability','Priority Level','',
                'NPV','IR(%)','PP',
                'BC Status',
                'Note',
            ],
        ];
    }


    /*get data from query*/
    public function map($project): array
    {
        $this->worksheet->fromArray(array(
            $project
        ),  null, 'A4', false, false);

        return [
            $project->project_number,
            $project->project_name,
            Setting::PROJECT_CATEGORY[$project->project_category],
            $project->project_type,
            $project->owners->name,
            $project->sponsors->name,
            $project->bc_presenter,
            $project->finance_analyst,
            $project->assessment ? $project->assessment->complexity_score_assessment ?? '' : '',
            $project->assessment ? $project->assessment->problems_statement ?? '0' : '0',
            $project->assessment ? $project->assessment->objective ?? '0' : '0',
            $project->assessment ? $project->assessment->project_scope ?? '0' : '0',
            $project->assessment ? $project->assessment->key_performance_metric ?? '0' : '0',
            $project->assessment ? $project->assessment->key_project_risk_mitigants ?? '0' : '0',
            $project->assessment ? $project->assessment->impact_if_not_executed ?? '0' : '0',
            $project->assessment ? $project->assessment->alternative_to_proposal ?? '0' : '0',
            $project->assessment ? $project->assessment->cost_estimate ?? '0' : '0',
            $project->assessment ? $project->assessment->complexity_score_assessment ?? '0' : '0',
            $project->assessment ? $project->assessment->level_project ?? '0' : '0',
            $project->assessment ? html_entity_decode(strip_tags($project->assessment->problem_statement_text)) : '-',
            $project->assessment ? html_entity_decode(strip_tags($project->assessment->objective_text)) : '-',
            $project->assessment ? html_entity_decode(strip_tags($project->assessment->project_scope_text)) : '-',
            $project->assessment ? html_entity_decode(strip_tags($project->assessment->key_performance_metric_text)) : '-',
            $project->assessment ? html_entity_decode(strip_tags($project->assessment->key_project_risk_and_mitigants_text)) : '-',
            $project->assessment ? html_entity_decode(strip_tags($project->assessment->impact_if_not_executed_text)) : '-',
            $project->assessment ? html_entity_decode(strip_tags($project->assessment->alternatives_to_proposal_text)) : '-',
            $project->assessment ? html_entity_decode(strip_tags($project->assessment->cost_estimate_text)) : '-',
            $project->assessment ? html_entity_decode(strip_tags($project->assessment->complexity_score_assessment)) : '-',
            $project->assessment ? html_entity_decode(strip_tags($project->assessment->level_project_text)) : '-',
            $project->assessment ? $project->assessment->cost_estimate ?? '0' : '0',
            $project->assessment ? $project->assessment->complexity_score_assessment ?? '0' : '0',
            $project->fel1 ? $project->fel1->project_scope ?? '0' : '0',
            $project->fel1 ? $project->fel1->identified_parameter_requirement_regulation ?? '0' : '0',
            $project->fel1 ? $project->fel1->alternatives ?? '0' : '0',
            $project->fel1 ? $project->fel1->list_of_stakeholder ?? '0' : '0',
            $project->fel1 ? $project->fel1->schedule_project ?? '0' : '0',
            '0',
            '0',
            $project->fel2 ? $project->fel2->project_scope ?? '0' : '0',
            $project->fel2 ? $project->fel2->identify_main_equipment ?? '0' : '0',
            $project->fel2 ? $project->fel2->boundary_and_assumption ?? '0' : '0',
            $project->fel2 ? $project->fel2->analysis_of_option ?? '0' : '0',
            $project->fel2 ? $project->fel2->permit_list ?? '0' : '0',
            $project->fel2 ? $project->fel2->schedule_project ?? '0' : '0',
            $project->fel2 ? $project->fel2->cost_estimate ?? '0' : '0',
            '0',
            '0',
            $project->fel3 ? $project->fel3->executive_summary ?? '0' : '0',
            $project->fel3 ? $project->fel3->problem_statement ?? '0' : '0',
            $project->fel3 ? $project->fel3->project_scope ?? '0' : '0',
            $project->fel3 ? $project->fel3->alternatives_and_best_option ?? '0' : '0',
            $project->fel3 ? $project->fel3->project_schedule ?? '0' : '0',
            $project->fel3 ? $project->fel3->list_of_equipment_and_specification ?? '0' : '0',
            $project->fel3 ? $project->fel3->hazop_study ?? '0' : '0',
            $project->fel3 ? $project->fel3->cost_estimate ?? '0' : '0',
            '0',
            '0',
            $project->business_case ? $project->project_name ? '1' : '0' : '0',
            $project->business_case ? $project->business_case->problem_statement_and_objective ?? '0' : '0',
            $project->business_case ? $project->business_case->project_alternatives ?? '0' : '0',
            $project->business_case ? $project->business_case->project_scope_of_work ?? '0' : '0',
            $project->business_case ? $project->business_case->major_equipment ?? '0' : '0',
            $project->business_case ? $project->business_case->utility_requirements ?? '0' : '0',
            $project->business_case ? $project->business_case->permitting ?? '0' : '0',
            $project->business_case ? $project->business_case->social_community_and_government ?? '0' : '0',
            $project->business_case ? $project->business_case->cost_estimate : '0',
            $project->business_case ? $project->business_case->financial_evaluation ?? '0' : '0',
            $project->business_case ? $project->business_case->risk_assessment ?? '0' : '0',
            $project->business_case ? $project->business_case->riskAssessment->people : '-',
            $project->business_case ? $project->business_case->riskAssessment->environment : '-',
            $project->business_case ? $project->business_case->riskAssessment->social_and_human_rights : '-',
            $project->business_case ? $project->business_case->riskAssessment->reputation : '-',
            $project->business_case ? $project->business_case->riskAssessment->finance : '-',
            $project->business_case ? $project->business_case->riskAssessment->final_impact_score : '-',
            $project->business_case ? $project->business_case->riskAssessment->probability : '-',
            $project->business_case ? $project->business_case->riskAssessment->priority_level : '-',
            '-',
            $project->business_case ? $project->business_case->npv ??  '' : '',
            $project->business_case ? (string) $project->business_case->irr ?? '' : '',
            $project->business_case ? $project->business_case->payback_period ?? '' : '',
            $project->bc_status ? Project::BC_STATUS[$project->bc_status] : '-',
            $project->note ? html_entity_decode(strip_tags($project->note)): '-'
        ];
    }

    /* for querying data */
    public function query()
    {
        // query will return callback to map method
        return Project::query()->with(['owners','sponsors','assessment']);
    }

    /* for template using blade. implements FromView */
    /*
    public function view(): View
    {
        return view('project.template', [
            'project' => Project::all()
        ]);
    } */

    /* for formatting cell */
    public function columnFormats(): array
    {
        return [
            'BZ' => NumberFormat::FORMAT_CURRENCY_USD,
        ];
    }

    public function styles(Worksheet $sheet)
    {
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
        $sheet->getStyle('2')->applyFromArray([
            'font' => [
                'bold' => true,
                'italic' => false,
            ],
            'alignment' => [
                'horizontal' =>Alignment::VERTICAL_CENTER,
                'vertical' => Alignment::HORIZONTAL_CENTER
            ],
        ]);
        $sheet->getStyle('3')->applyFromArray([
            'font' => [
                'bold' => true,
                'italic' => false,
            ],
            'alignment' => [
                'horizontal' =>Alignment::VERTICAL_CENTER,
                'vertical' => Alignment::HORIZONTAL_CENTER
            ],
        ]);

        $column = "A1:CD".($this->size + 3);
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

        $sheet->getStyle('A1:CD3')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => '0492C2'],]);
        $sheet->getStyle('A2:CD3')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => '0492C2'],]);

        $sheet->mergeCellsByColumnAndRow(1,1,1,3);
        $sheet->mergeCellsByColumnAndRow(2,1,2,3);
        $sheet->mergeCellsByColumnAndRow(3,1,3,3);
        $sheet->mergeCellsByColumnAndRow(4,1,4,3);
        $sheet->mergeCellsByColumnAndRow(5,1,5,3);
        $sheet->mergeCellsByColumnAndRow(6,1,6,3);
        $sheet->mergeCellsByColumnAndRow(7,1,7,3);
        $sheet->mergeCellsByColumnAndRow(8,1,8,3);
        $sheet->mergeCellsByColumnAndRow(9,1,9,3);
        $sheet->mergeCellsByColumnAndRow(10,1,29,2);
        $sheet->mergeCellsByColumnAndRow(30,1,31,2);
        $sheet->mergeCellsByColumnAndRow(32,1,38,2);
        $sheet->mergeCellsByColumnAndRow(39,1,47,2);
        // start from AU
        $sheet->mergeCellsByColumnAndRow(48,1,82,1);
        $sheet->mergeCellsByColumnAndRow(48,2,57,2);
        $sheet->mergeCellsByColumnAndRow(58,2,68,2);
        $sheet->mergeCellsByColumnAndRow(69,2,76,2);
        $sheet->mergeCellsByColumnAndRow(77,2,77,3);
    }

    /*
    public function drawings()
    {
        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo');
        $drawing->setPath(public_path('/image/vale.png'));
        $drawing->setHeight(20);
        $drawing->setCoordinates('B10');

        return $drawing;
    }*/

    public function title(): string
    {
        return 'Projects';
    }
}
