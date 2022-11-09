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

    public const ASSESSMENT_ATTACHMENT = [
        '0' => 'initial_cost_estimate',
        '1' => 'complexity_matrix'
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

}
