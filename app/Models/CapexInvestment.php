<?php

namespace App\Models;

use App\Class\ObjectClass;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapexInvestment extends Model
{
    protected $table = 'capex_investment_categories';
    use HasFactory;

    public const STATUS_ACTIVE = 'ACTIVE';
    public const STATUS_NONACTIVE = 'NONACTIVE';

    public const type = [
        'capex_investment' => 'CAPEX_INVESTMENT',
        'basket' => 'BASKET',
        'sub_basket' => 'SUB_BASKET',
        'category' => 'CATEGORY'
    ];

    public const CAPEX_INVESTMENT = [
        'sustaining' => 'Sustaining',
        'r_and_d' => 'R & D',
        'growth' => 'Growth',
    ];

    public const BASKET = [
        'margin' => 'Margin',
        'maintain_capacity' => 'Maintain Capacity',
        'health_safety' => 'Health and Safety',
        'Sustainability' => 'Sustainability',
        'administrative_improvements' => 'Administrative / Improvements',
        'engineering' => 'Engineering',
        'exploration' => 'Exploration',
        'innovation_and_technology' => 'Innovation & Technology',
        'volume_growth' => 'Volume Growth',
        'volume_replacement' => 'Volume Replacement',
    ];

    public const SUB_BASKET = [
        'cost_reduction' => 'Cost Reduction',
        'quality' => 'Quality',
        'revenue' => 'Revenue',
        'volume' => 'Volume',
        'acquisition_replacement_construction_of_new_assets' => 'Acquisition/ Replacement / Construction of New Assets',
        'refurbishment_rebuild' => 'Refurbishment / Rebuild',
        'geotechnical_tailing_dams_dykes_ecj' => 'Geotechnical - Tailing Dams / Dykes / ECJ ',
        'geotechnical_waste_pile' => 'Geotechnical -  Waste Pile',
        'geotechnical_tailings_and_waste_pile' => 'Geotechnical - Tailings and Waste Pile',
        'geotechnical_tailings_pile' => 'Geotechnical - Tailings Pile',
        'geotechnical_product_stockpile' => 'Geotechnical - Product Stockpile',
        'geotechnical_pit_slopes' => 'Geotechnical - Pit Slopes',
        'geotechnical_underground_mines' => 'Geotechnical - Underground Mines',
        'geotechnical_hydrogeology' => 'Geotechnical - Hydrogeology',
        'safety' => 'Safety',
        'emergency_service' => 'Emergency Service',
        'health' => 'health',
        'environment' => 'Environment',
        'social' => 'Social',
        'construction' => 'Construction',
        'equipment_furniture' => 'Equipment / Furnitue',
        'it' => 'IT',
        'property_security' => 'Property Security',
        'geotechnical_power_dams' => 'Geotechnical - Power Dams',
        'geotechnical_tailing_dams_dykes_downstream_containment_structure' => 'Geothecnical - Tailing Dams / Dykes / Downstream Containment Structures (ECJ or Back-up dam)',
    ];


    public const subBasketCategories = [
        'tools' => 'Tools',
        'volume_growth_one_off_masterplan' => 'Volume Growth (One - Off Master Plan)',
        'volume_replacement_one_off_masterplan' => 'Volume Replacement (One - Off Master Plan)',
        'properties_lands' => 'Properties / Lands',
        'mobile_equipment' => 'Mobile Equipment',
        'equipment' => 'Equipment',
        'fel3' => 'Fel 3',
        'rotational_material' => 'Rotational / Capital Spare',
        'operational_infrastructure' => 'Operational Infrastructure',
        'special_infrastructure_works' => 'Special Infrastructure Works',
        'tech_equipment_hardware' => 'Tech - Equipment / Hardware',
        'tech_system_software' => 'Tech - System / Software',
        'tech_automation_instrumentation' => 'Tech - Automation / Instrumentation',
        'tech_infrastructure' => 'Tech Infrastructure',
        'structural_integrity' => 'Structural Integrity',
        'structural_reinforcement_and_or_refurbishment' => 'Structural Reinforcement and/or Refurbishment',
        'tailings_management_and_water_balance' => 'Tailings Management and Water Balance',
        'expansion' => 'Expansion',
        'piezometric_level_and_water_level' => 'Piezometric Level and Water Level',
        'water_table_lowering' => 'Water Table Lowering',
        'infrastructure_refurbishment' => 'Infrastructure Refurbishment / Revitalization',
        'acquisition_of_properties_lands' => 'Acquisition of Properties Lands',
        'acquisition_replacement_modification_mobile_equipment' => 'Acquisition / Replacement / Modification of Mobile Equipment (S & D)',
        'acquisition_replacement_modification_equipment' => 'Acquisition / Replacement / Modification of Equipment',
        'acquisition_replacement_modification_rotational_material' => 'Acquisition / Replacement / Modification of Rotational Material',
        'construction_new_assets' => 'Construction of New Assets',
        'geotechnical_structures' => 'Geotechnical Structures',
        'process_change_revitalization' => 'Process Change / Revitalization',
        'tools_acquisition_replacement' => 'Tools Acquisition / Replacement',
        'emergency_plan_mitigation_scenario' => 'Emergency Plan - Mitigation of Scenario',
        'legal_requirements_not_covered_rac' => 'Legal Requirements Not Covered By RAC',
        'more_than_one_rac' => 'More Than One Rac',
        'rac_01' => 'RAC 01',
        'rac_02' => 'RAC 02',
        'rac_03' => 'RAC 03',
        'rac_04' => 'RAC 04',
        'rac_05' => 'RAC 05',
        'rac_06' => 'RAC 06',
        'rac_07' => 'RAC 07',
        'rac_08' => 'RAC 08',
        'rac_09' => 'RAC 09',
        'rac_10' => 'RAC 10',
        'rac_11' => 'RAC 11',
        'compliance_with_legal_requirements_on_other' => 'Compliance With Legal Requirements and Other Requirements',
        'atmospheric_emissions' => 'Atmospheric Emmissions',
        'waste_generation_destination_except_tailings_sediment_sterile' => 'Waste Generation and Destination, Except For Tailings,Sediments, and Sterile',
        'remediation_contingency_soil' => 'Remediation / Contingency / Soil',
        'reuse_recirculation_water_collection_focus_on_environmental_issues' => 'Reuse, Recirculation and Water Collection, Effluents, Scarcity of Resources With A Focus on Environmental Issues',
        'noise_and_vibration' => 'Noise and Vibration',
        'climate_changes' => 'Climate Changes',
        'biodiversity' => 'Biodiversity',
        'environmental_education' => 'Environmental Education',
        'human_rights' => 'Human Rights',
        'mobility' => 'Mobility',
        'legacy_projects' => 'Legacy Projects',
        'acquisition_replacement' => 'Acquisition / Replacement',
        'physical_safety' => 'Physical Safety'
    ];

    public function basket()
    {
        return $this->hasMany(CapexInvestment::class, 'parent_id');
    }

    public function subBasket()
    {
        return $this->hasMany(CapexInvestment::class, 'parent_id');
    }

    public function categories(){
        return $this->belongsToMany(Category::class,'capex_investment_sub_basket_categories','capex_investment_sub_basket_id','categories_id');
    }




}
