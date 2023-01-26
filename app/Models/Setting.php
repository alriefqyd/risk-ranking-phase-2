<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public const PROJECT_CATEGORY = [
        'betterment' => 'BETTERMENT',
        'sustainability_development' => 'SUSTAINABILITY DEVELOPMENT',
        'replacement' => 'REPLACEMENT',
        'research_and_development' => 'RESEARCH AND DEVELOPMENT',
    ];

    public const STATUS = [
        'draft' => 'DRAFT',
        'publish' => 'PUBLISH'
    ];

    public const RELATED_DATA = [
        'assessment' => 'assessment',
        'felData' => 'felData',
        'fel1' => 'fel1',
        'fel2' => 'fel2',
        'fel3' => 'fel3',
        'business_case' => 'business_case',
        'cost_benefit' => 'cost_benefit'
    ];

    public const COMPLEXITY_ANALYSIS = [
        '1' => 'investment_just_purchase',
        '2' => 'needs_engineering_development',
        '3' => 'require_more_two',
        '4' => 'require_more_two_simultant',
        '5' => 'num_work_one_hundred',
        '6' => 'transportation_under_vale',
        '7' => 'require_shutdown',
        '8' => 'interferences_delay',
        '9' => 'require_environmental_license',
        '10' => 'require_community_involvement',
        '11' => 'require_purchase'
    ];

    public const FOLDER_TYPE = [
        'assessment' => 'Project Level Assessment',
        'fel1' => 'FEL 1',
        'fel2' => 'FEL 2',
        'fel3' => 'FEL 3',
        'bc' => 'Business Case',
    ];

    public const ASSESSMENT_ATTACHMENT = [
        'initial_cost_estimate' => 'initial_cost_estimate',
        'complexity_matrix' => 'complexity_matrix'
    ];

    public const FEL1_ATTACHMENT = [
        'parameter_regulation_requirement' => 'parameter_regulation_requirement',
        'initial_process_diagram' => 'initial_process_diagram',
        'data_of_alternatives' => 'data_of_alternatives',
        'initial_schedule' => 'initial_schedule',
        'project_level_assessment' => 'project_level_assessment',
        'stakeholder_list' => 'stakeholder_list'
    ];

    public const FEL2_ATTACHMENT = [
        'reference_of_capacity' => 'reference_of_capacity',
        'data_of_survey_parameter' => 'data_survey_parameter',
        'diagram_process' => 'diagram_process',
        'initial_risk_assessment' => 'initial_risk_assessment',
        'initial_utility_diagram' => 'initial_utility_diagram',
        'project_level_assessment' => 'project_level_assessment',
        'quotation_main_equipment' => 'quotation_main_equipment',
        'fel1' => 'fel1',
        'technical_evaluation' => 'technical_evaluation',
        'financial_evaluation' => 'financial_evaluation',
        'schedule_level_2' => 'schedule_level_2',
        'cost_estimate' => 'cost_estimate'
    ];

    public const FEL3_ATTACHMENT = [
        'preliminary_design' => 'preliminary_design',
        'utility_infrastructure_facilities_diagram' => 'utility_infrastructure_facilities_diagram',
        'hazop' => 'hazop',
        'moc_document' => 'moc_document',
        'cost_estimate' => 'cost_estimate',
        'quotation_of_equipment' => 'quotation_of_equipment',
        'project_level_assessment' => 'project_level_assessment',
        'fel1' => 'fel1',
        'fel2' => 'fel2'
    ];

    public const CAPITAL_VALUE = [
        'THIRTY_MILLION' => 30000000,
        'FIVE_MILLION' => 5000000,
        'ONE_MILLION' => 1000000,
        'THREE_HUNDRED_THOUSAND' => 300000,
    ];

    public const COMPLEXITY_ASSESSMENT_CATEGORY = [
        'technology_characteristic' => 'Technology Characteristic',
        'engineering_characteristic' => 'Engineering Characteristic',
        'owner_business_impact_characteristic' => 'Owner Business Impact Characteristic',
        'external_approval_characteristic' => 'External Approval Characteristic',
    ];

    public const PROJECT_TYPE = 'PROJECT TYPE';

    public const PROJECT_TYPE_BETTERMENT = 'betterment';
    public const PROJECT_TYPE_SUSTAINABILITY_DEVELOPMENT = 'sustainability_development';
    public const REPLACEMENT = 'replacement';
    public const RESEARCH_AND_DEVELOPMENT = 'research_and_development';

    public const ENGINEERING = 'Engineering';
    public const PRODUCTIVE = 'Productive';
    public const ADMINISTRATIVE = 'Administrative';
    public const ENVIRONMENT = 'Environment';
    public const OCCUPATIONAL_HEALTH_AND_SAFETY = 'Occupational Health and Safety';
    public const SOCIAL_COMMUNITY_REPUTATION = 'Social / Community / Reputation';
    public const TECHNOLOGY_AND_PROCESS_DEVELOPMENT = 'Technology And Process Development';
    public const GEOLOGICAL_RESEARCH = 'Geological Research';

    public const MODERATE = 'Moderate';
    public const HIGH = 'High';
    public const LOW = 'Low';
    public const SIMPLE_PURCHASE = 'Simple Purchase';

    public const DOCUMENT_EXTENSION = ['docx','doc','pdf','xlsx','xls','csv','xlx','ppt','pptx'];
    public const ARCHIVE_EXTENSION = ['zip','rar'];

    public const MATURITY_ANALYSIS_ITEM = [
        'investment_estimate' => 'investment_estimate',
        'scope' => 'scope',
        'integrated_project_timeline' => 'integrated_project_timeline',
        'supply_plan' => 'supply_plan',
        'physical_and_financial' => 'physical_and_financial',
        'scope_statement' => 'scope_statement',
        'project_opening_term' => 'project_opening_term',
        'save_baseline' => 'save_baseline',
        'definition_of_physical' => 'definition_of_physical',
        'develop_basic_engineering' => 'develop_basic_engineering',
        'identification_all_licenses' => 'identification_all_licenses',
        'on_site_conditions' => 'on_site_conditions',
        'rental_plants' => 'rental_plants',
        'health_and_safety' => 'health_and_safety',
        'detailed_schedule_of_project' => 'detailed_schedule_of_project',
        'list_document_engineer' => 'list_document_engineer',
        'involve_environment' => 'involve_environment',
        'alignment_of_interface' => 'alignment_of_interface',
        'change_management_plan' => 'change_management_plan',
        'risk_plan' => 'risk_plan',
        'preliminary_risk_analysis' => 'preliminary_risk_analysis',
        'stakeholder_matrix' => 'stakeholder_matrix',
        'land_management_report' => 'land_management_report',
        'definition_of_interlocutor' => 'definition_of_interlocutor',
        'constructive_methodology' => 'constructive_methodology',
        'interference_and_tie_ins' => 'interference_and_tie_ins',
        'capex_management' => 'capex_management',
        'engineering_development' => 'engineering_development',
        'survey_local_conditions' => 'survey_local_conditions',
        'logistic_studies' => 'logistic_studies',
        'executive_report' => 'executive_report',
        'environmental_licensing' => 'environmental_licensing',
        'work_breakdown_structure' => 'work_breakdown_structure',
        'integrated_project_schedule' => 'integrated_project_schedule',
        'detailed_fte_schedule' => 'detailed_fte_schedule',
        'operational_readiness' => 'operational_readiness',
        'quality_plan' => 'quality_plan',
        'risk_analysis_report' => 'risk_analysis_report',
        'integrated_management_system' => 'integrated_management_system',
        'pae' => 'pae',
        'apr' => 'apr',
        'construction_sites' => 'construction_sites',
        'procurement_tracking_map' => 'procurement_tracking_map'
    ];

    public const MATURITY_ANALYSIS_SUMMARY = [
        'Ready' => 'Ready',
        'Not Ready' => 'Not Ready'
    ];

}
