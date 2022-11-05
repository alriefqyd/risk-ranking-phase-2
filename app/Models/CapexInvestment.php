<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapexInvestment extends Model
{
    protected $table = 'capex_investment_categories';
    use HasFactory;

    public const type = [
        'capex_investment' => 'CAPEX_INVESTMENT',
        'basket' => 'BASKET',
        'sub_basket' => 'SUB_BASKET',
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
    ];

    public function projectSubBasket(){
        return $this->hasOne(Project::class,'sub_basket');
    }

    public function projectBasket(){
        return $this->hasOne(Project::class,'basket');
    }

    public function projectFeature(){
        return $this->hasOne(Project::class,'feature');
    }




}
