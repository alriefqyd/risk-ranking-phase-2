<?php

namespace App\Models;

use App\Class\SubBasketCategories;
use App\Service\MaturityService;
use App\Service\ProjectService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Psy\Util\Json;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    const BC_STATUS = [
        'mature' => 'Mature',
        'not_mature' => 'Not Mature'
    ];

    public function assessment(){
        return $this->hasOne(Assessment::class,'project_id')->withTrashed();
    }

    public function fel1(){
        return $this->hasOne(Fel1::class,'project_id')->withTrashed();
    }

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function fel2(){
        return $this->hasOne(Fel2::class,'project_id')->withTrashed();
    }

    public function fel3(){
        return $this->hasOne(Fel3::class,'project_id')->withTrashed();
    }

    public function business_case(){
        return $this->hasOne(BusinessCaseAssessment::class,'project_id')->withTrashed();
    }

    public function ownersProject(){
        return $this->belongsTo(Department::class,'operation_area');
    }

    public function sponsorsProject(){
        return $this->belongsTo(Department::class,'sponsor_area');
    }

    public function cost_benefits(){
        return $this->hasOne(CostBenefit::class,'project_id')->withTrashed();
    }

    public function baskets(){
        return $this->belongsTo(CapexInvestment::class,'basket');
    }

    public function subBaskets(){
        return $this->belongsTo(CapexInvestment::class,'sub_basket');
    }

    public function features(){
        return $this->belongsTo(CapexInvestment::class,'feature');
    }

    public function categories(){
        return $this->belongsTo(Category::class,'sub_basket_categories');
    }

    public function criterias(){
        return $this->belongsToMany(Criteria::class,'criterias_projects')->withPivot('answer');
    }

    public function isHaveCriterias(){
        $data = DB::table('criterias_categories')->where('sub_basket_id', $this->sub_basket)->where('category_id', $this->categories?->id)->count();
        if($data > 0) return true;
        return false;
    }

    /*
     * Method to auto delete relation
     */
    protected static function boot() {
        parent::boot();
        static::deleted(function ($project) {
            $project->assessment()->delete();
            $project->fel1()->delete();
            $project->fel2()->delete();
            $project->fel3()->delete();
            $project->business_case()->delete();
            $project->cost_benefits()->delete();
        });
    }

    public function scopeFilter($query, array $filters){
        $query->when($filters['operation_area'] ?? false, fn($query, $owner) =>
        $query->where('operation_area', '=', $owner)
        );
        $query->when($filters['owner'] ?? false, fn($query, $owner) =>
            $query->where('owner', '=', $owner)
        );
        $query->when($filters['sponsor_area'] ?? false, fn($query, $sponsor) =>
        $query->where('sponsor_area', '=', $sponsor)
        );
        $query->when($filters['sponsor'] ?? false, fn($query, $owner) =>
        $query->where('sponsor', '=', $owner)
        );

        $query->when($filters['category'] ?? false, fn($query, $category) =>
        $query->where('project_category', '=', $category)
        );

        $query->when($filters['type'] ?? false, fn($query, $type) =>
        $query->where('project_type', '=', $type)
        );
        $query->when($filters['q'] ?? false, fn($query, $q) =>
        $query->where('project_name', 'like', '%'.$q.'%')
            ->orwhere('project_number', 'like', '%'.$q.'%')
        );

    }

    public function getCostBenefit($isExport){
        $data =  CostBenefit::where('project_id',$this->id)->first();
        if(!$data){
            return null;
        }
        $dataCollection = collect([]);
        $dataValue = json_decode($data->value);

        if($isExport){
            $dataLength = sizeof($dataValue);
            if($dataLength >= 28){
                $year = 2019;
                for($i=$dataLength; $i < 31; $i++){
                    $dataCollection->push([
                        'project_id' => $this->id,
                        'year' => $year+1,
                        'initial_and_sustaining_capex' => 0,
                        'additional_revenue' => 0,
                        'increment_operating_cost' => 0,
                        'cost_savings' => 0,
                        'net_incremental_benefits' => 0
                    ]);
                }
            }
        }

        foreach ($dataValue as $datas){
            $dataCollection->push([
                'project_id' => $this->id,
                'year' =>  $datas->year,
                'initial_and_sustaining_capex' => $datas->initial_and_sustaining_capex,
                'additional_revenue' => $datas->additional_revenue,
                'increment_operating_cost' => $datas->increment_operating_cost,
                'cost_savings' => $datas->cost_savings,
                'net_incremental_benefits' => $datas->net_incremental_benefits
            ]);
        }
        return $dataCollection;
    }

    public function getBcStatus(){
        $projectService = new ProjectService();
        return $projectService->getBcStatus($this);
    }

    public function getRelatedDataProjectAssessment(){
        $projectService = new ProjectService();
        return $projectService->getRelatedDataProjectStatus($this, $this->assessment,config('constants.related_data.assessment'));
    }

    public function getRelatedDataProjectFel1(){
        $projectService = new ProjectService();
        return $projectService->getRelatedDataProjectStatus($this, $this->fel1,config('constants.related_data.fel1'));
    }

    public function getRelatedDataProjectFel2(){
        $projectService = new ProjectService();
        return $projectService->getRelatedDataProjectStatus($this, $this->fel2,config('constants.related_data.fel2'));
    }

    public function getRelatedDataProjectFel3(){
        $projectService = new ProjectService();
        return $projectService->getRelatedDataProjectStatus($this, $this->fel3,config('constants.related_data.fel3'));
    }

    public function getRelatedDataProjectBusinessCase(){
        $projectService = new ProjectService();
        return $projectService->getRelatedDataProjectStatus($this, $this->business_case,config('constants.related_data.business-case'));
    }

    public function getProjectCategory(){
        $category = Setting::PROJECT_CATEGORY[$this->project_category] ?? null;
        if(!$category){
            return $this->project_category;
        }
        return $category;
    }

    public function getNoteTemplateForm(){
        $projectService = new ProjectService();
        return $projectService->getNoteTemplateForm($this);
    }

    public function getCheckTemplate($value){
        $projectService = new ProjectService();
        return $projectService->getTemplateCheck($value);
    }

    public function getTemplateExpandChar($value){
        $projectService = new ProjectService();
        return $projectService->getTemplateExpandChar($value);
    }

    public function getPriorityTemplate($value){
        $projectService = new ProjectService();
        return $projectService->getPriorityTemplate($value);
    }

    public function checkPermissionRelatedData($relatedData){
        $projectService = new ProjectService();
        return $projectService->checkPermissionRelatedData($this,$relatedData);
    }

    public function getComplexityAnalysis($key){
        $projectService = new ProjectService();
        return $projectService->getComplexityAnalysis($this, $key);
    }

    public function getAllAttachment($value,$identifier){
        $projectService = new ProjectService();
        return $projectService->getAllAttachment($value,$identifier);
    }

    public function getListAttachmentBusinessCase(){
        $projectService = new ProjectService();
        $value = $this->business_case->attachment;
        return $projectService->getAttachmentListBusinessCase($value);
    }

    public function getCleanProjectName(){
        $name = $this->project_name;
        $name = str_replace('&','and', $name);
        $name = str_replace('#',' ',$name);
        return $name;
    }

    public function getProjectAssessmentComplexity($key){
        try{
            $data = $this?->assessment?->complexity_assessment;
            if(!$data) return '';
            $data = json_decode($data,true);
            return $data[$key];
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }


    public function getMaturityAnalysis($maturityItem, $viewAnswer){
        $maturityService = new MaturityService();
        $data = $maturityService->getMaturityAnalysis($this?->fel3, $this?->fel3?->id);
        $dataValueDecode = json_decode($data?->value);

        if($data){
            foreach ($dataValueDecode as $key => $value){
                foreach ($value as $k => $v){
                    if($maturityItem == $k){
                        if($viewAnswer) return Setting::MATURITY_VALUE[$v];
                        return $v;
                    }
                }
            }
        }

        return '';
    }

    public function getSeverityRiskAssessment($value){
        $impactScore = $value;
        if($impactScore == null) return "";
        return RiskAssessments::SEVERITY[$impactScore];
    }

    public function getProbabilityRiskAssessment($value){
        $probability = $value;
        if($probability == null) return "";
        return RiskAssessments::PROBABILITY[$probability];
    }

    public function getSeverityValue($val){
        if(!$val) return "";
        return RiskAssessments::NEW_SEVERITY[$val];
    }

    public function getInvestmentStrategy(){
//        $data = $this->investment_strategy;
//        if(!$data) return null;
//        $json = json_decode($data);
//        return $json;
        $value = $this->investment_strategy;
        if (!$value) return null;
        else return Setting::INVESTMENT_STRATEGY_CATEGORY[$value->level1];
    }

    public function validateAssessmentBasedOnComplexityScore($isMessage){
        $complexityScore = $this->assessment?->complexity_score_assessment;
        if(!$complexityScore) return null;

        if($complexityScore >=4 && $complexityScore <=10){
            return $isMessage ? 'FEL 3' : isset($this->fel3);
        } else if ($complexityScore >= 11 && $complexityScore <= 16){
            return $isMessage ? 'FEL 2' : isset($this->fel2);
        } else if ($complexityScore >= 17){
            return $isMessage ? 'FEL 1 & 2' : isset($this->fel1) && isset($this->fel2);
        } else {
            return $isMessage ? 'Your complexity score doesnt match any condition of business case' : false;
        }
    }

    public function newValidateAssessmentBasedOnComplexityScore($isMessage){
        $complexityScore = $this->assessment?->level_project_text;
        if(!$complexityScore) return null;
        if($complexityScore === Setting::ASSESSMENT_LEVEL["COMPLEX"]
            || $complexityScore === Setting::ASSESSMENT_LEVEL["PDS"]){
            return $isMessage ? 'FEL 1, FEL 2 & FEL 3 ' :
                (isset($this->fel3) && isset($this->fel2)) && isset($this->fel1);
        } if($complexityScore === Setting::ASSESSMENT_LEVEL["MODERATE"]){
            return $isMessage ? 'FEL 1/2 & FEL 3' : (isset($this->fel1) || isset($this->fel2)) && isset($this->fel3);
        } else if ($complexityScore === Setting::ASSESSMENT_LEVEL['LIGHT']){
            return $isMessage ? 'FEL 1/2/3' : (isset($this->fel3)
                || isset($this->fel2) || isset($this->fel1));
        } else {
            return $isMessage ? 'Your complexity score doesnt match any condition of business case' : false;
        }
    }

    /** Decode Text */

    private function sanitizeTextAttribute($value)
    {
        return preg_replace('/[^\w\s.,?!-]/u', '', html_entity_decode(strip_tags($value)));
    }
    public function getExecutiveSummaryTextAttribute($value){
        // Remove HTML tags and decode HTML entities
        return $this->sanitizeTextAttribute($value);
    }

    public function getProblemStatementTextAttribute($value){
        return $this->sanitizeTextAttribute($value);
    }

    public function getObjectiveTextAttribute($value){
        return $this->sanitizeTextAttribute($value);
    }

    public function getProjectScopeTextAttribute($value){
        return $this->sanitizeTextAttribute($value);
    }

    public function getAlternativesToProposalTextAttribute($value){
        return $this->sanitizeTextAttribute($value);
    }

    public function getProjectScheduleTextAttribute($value){
        return $this->sanitizeTextAttribute($value);
    }

    public function getListEquipmentSpecificationTextAttribute($value){
        return $this->sanitizeTextAttribute($value);
    }

    public function getKeyProjectRiskAndMitigantsTextAttribute($value){
        return $this->sanitizeTextAttribute($value);
    }

    public function getImpactIfNotExecutedTextAttribute($value){
        return $this->sanitizeTextAttribute($value);
    }

    public function getHazopStudyTextAttribute($value){
        return $this->sanitizeTextAttribute($value);
    }

    public function getComplexityScoreAssessmentTextAttribute($value){
        return $this->sanitizeTextAttribute($value);
    }

    public function getLevelProjectTextAttribute($value){
        return $this->sanitizeTextAttribute($value);
    }

    public function getProjectScopeTextFel1Attribute($value){
        return $this->sanitizeTextAttribute($value);
    }

    public function getProjectScopeTextFel2Attribute($value){
        return $this->sanitizeTextAttribute($value);
    }

    public function getIdentifyMainEquipmentTextFel2Attribute($value){
        return $this->sanitizeTextAttribute($value);
    }

    public function getAlternativesAndAnalysisTextFel2Attribute($value){
        return $this->sanitizeTextAttribute($value);
    }

    public function getProjectScopeTextFel3Attribute($value){
        return $this->sanitizeTextAttribute($value);
    }

    public function getAlternativesAndBestOptionTextFel3Attribute($value){
        return $this->sanitizeTextAttribute($value);
    }

    public function getProjectScheduleTextFel3Attribute($value){
        return $this->sanitizeTextAttribute($value);
    }

    public function getListOfEquipmentAndSpecificationTextFel3Attribute($value){
        return $this->sanitizeTextAttribute($value);
    }

    public function getHazopStudyTextFel3Attribute($value){
        return $this->sanitizeTextAttribute($value);
    }

    public function getExecutiveSummaryTextFel3Attribute($value){
        return $this->sanitizeTextAttribute($value);
    }

    public function getProblemStatementTextFel3Attribute($value){
        return $this->sanitizeTextAttribute($value);
    }

    public function getProjectScopeOfWorkTextBusinessCaseAttribute($value){
        return $this->sanitizeTextAttribute($value);
    }

    public function getNoteAttribute($value){
        return $this->sanitizeTextAttribute($value);
    }

    public function getLocationOfAssetCapitalizationAssessmentAttribute($value)
    {
        $data = $value;
        $json = json_decode($data, true);

        if (!$data) return [];

        $list = [];

        foreach ($json as $item) {
            $list[] = [
                'area' => $item['area'] ?? "",
                'cost_center' => $item['cost_center'] ?? "",
            ];
        }

        return $list;
    }

    public function getKeyPerformanceMetricTextAttribute($value){
        if(!$value) return [];

        $data = $value;
        $json = json_decode($data, true);
        $list = [];

        foreach ($json as $item) {
            $list[] = [
                'description' =>  $item['description'] ? '- Description : ' . $item['description'] : '',
                'uom' => $item['uom'] ? '- UOM : ' . $item['uom'] : '',
                'time_benefit' =>  $item['time_benefit'] ? '- Time Benefit : ' . $item['time_benefit'] : '',
                'remarks' => $item['remarks'] ? '- Remarks : ' . $item['remarks'] : '',
            ];
        }

        return $list;
    }

    public function breakdownPrioritizationCriteria(){
        if(!$this->criterias) return null;
        $data = [];
        foreach ($this->criterias as $criteria){
            $temp = [
                'question' => $criteria->title,
                'answer' => $criteria?->pivot?->answer
            ];
            array_push($data, $temp);
        }


        return $data;
    }

    public function getRemark(){
        $nullColumns = [];
        $excludeColumns = ['reputation','people','environment','social_and_human_rights','fel1_attachment','fel2_attachment','fel3_attachment','business_case_attachment', 'change_management_request'];

        $assessment = [];
        $fel1 = [];
        $fel2 = [];
        $fel2 = [];
        $case = [];

        if ($this->level_project_text_assessment == 'MODERATE') {
            if (($this->project_scope_fel1 == null || $this->project_scope_fel1 == '')
                && ($this->project_scope_fel2 == null || $this->project_scope_fel2 == '')) {
                $fel1[] = 'Form FEL 1/2 must be completed';
            }

            if(($this->project_scope_fel3 == '' || $this->project_scope_fel3 == null) ||
            ($this->problem_statement_fel3 == '' || $this->problem_statement_fel3 == null)){
                $fel1[] = 'Form FEL 3 must be completed';
            }
        }
        if ($this->level_project_text_assessment == 'LIGHT') {
            if (($this->project_scope_fel1 == null || $this->project_scope_fel1 == '')
                && ($this->project_scope_fel2 == null || $this->project_scope_fel2 == '')
                && ($this->project_scope_fel3 == null || $this->project_scope_fel3 == '')) {
                $nullColumns[] = 'Form FEL 1/2/3 must be completed';
            }

        }
        if ($this->level_project_text_assessment == 'COMPLEX' || $this->level_project_text_assessment == "PDS") {
            if ($this->project_scope_fel1 == null || $this->project_scope_fel1 == '') {
                $nullColumns[] = 'Form FEL 1 must be completed';
            }


            if (($this->project_scope_fel2 == null || $this->project_scope_fel2 == '') ||
                ($this->identify_main_equipment_fel2 == null || $this->identify_main_equipment_fel2 == '') ||
                ($this->alternatives_and_analysis_fel2 == null || $this->alternatives_and_analysis_fel2 == '')) {
                $nullColumns[] = 'Form FEL 2 must be completed';
            }

            if (($this->project_scope_fel3 == null || $this->project_scope_fel3 == '') ||
                ($this->cost_estimate_fel3 == null || $this->cost_estimate_fel3 == '')) {
                $nullColumns[] = 'Form FEL 3 must be completed';
            }

            if(($this->project_scope_of_work_business_case == null || $this->project_scope_of_work_business_case == '')
            || $this->priority_level == null || $this->priority_level == ''){
                $nullColumns[] = "Form Business Case must be completed";
            }

        }

        /** Checking Attachment Existing */
        if($this->project_scope_fel1 != '' || $this->project_scope_fel1 != null){
            $value = $this->fel1_attachment;
            if(isset($value) && $value != "" && $value != null) {
                $mandatoryFel1tAttachment = Setting::FEL1_ATTACHMENT;
                $json = json_decode($value,true);
                $keys = array_keys($json);
                $notPresentValues = array_diff($mandatoryFel1tAttachment,$keys);

                foreach ($notPresentValues as $diff){
                    $nullColumns[] = "Attachment: FEL1  ".ucwords((str_replace('_',' ',$diff))). " (if applicable for FEL 1)";
                }
            }
        }

        if($this->project_scope_fel2 != '' || $this->project_scope_fel2 != null){
            $value = $this->fel2_attachment;
            if(isset($value) && $value != "" && $value != null) {
                $mandatoryFel2tAttachment = Setting::FEL2_ATTACHMENT;
                $json = json_decode($value,true);
                $keys = array_keys($json);
                $notPresentValues = array_diff($mandatoryFel2tAttachment,$keys);

                foreach ($notPresentValues as $diff){
                    $nullColumns[] = "Attachment: FEL2 ".ucwords((str_replace('_',' ',$diff))). " (if applicable for FEL 2)";
                }
            }
        }

        if($this->project_scope_fel3 != '' || $this->project_scope_fel3 != null){
            $value = $this->fel3_attachment;
            if(isset($value) && $value != "" && $value != null) {
                $mandatoryFel3tAttachment = Setting::FEL3_ATTACHMENT;
                $json = json_decode($value,true);
                $keys = array_keys($json);
                $notPresentValues = array_diff($mandatoryFel3tAttachment,$keys);

                foreach ($notPresentValues as $diff){
                    $nullColumns[] = "Attachment: FEL3 ".ucwords((str_replace('_',' ',$diff))) . " (if applicable for FEL 3)";
                }
            }
        }

        /* Checking Field Assessment, FEL1,2,3, BC */
        foreach ($this->getAttributes() as $column => $value){
            $type = $this->getType($column);
            if(!in_array($column, $excludeColumns)){
                if($value == null || $value == '' || $value == 0){
                    $nullColumns[] =  ucwords(str_replace('_',' ',$column));
                }

                if ($column === 'npv' && $value < 0){
                    $nullColumns[] = "NPV cannot have a negative value";
                }

                if ($column === 'assessment_attachment'){
                    $mandatoryAssessmentAttachment = Setting::ASSESSMENT_ATTACHMENT;
                    if(isset($value) && $value != "" && $value != null) {
                        $json = json_decode($value,true);
                        $keys = array_keys($json);
                        $notPresentValues = array_diff($mandatoryAssessmentAttachment,$keys);

                        foreach ($notPresentValues as $diff){
                            $nullColumns[] = "Level Assessment Attachment: ".ucwords((str_replace('_',' ',$diff)));
                        }
                    }
                }

            }
        }

        return $nullColumns;
    }

    public function getType($str){
        $words = explode("_", $str);
        $lastWord = end($words);
        return $lastWord;
    }

    public function isSubmitAssessment(){
        if($this->assessment){
            if($this->assessment->status === 'PUBLISH'
                && isset($this->assessment->complexity_analysis_type)
                && isset($this->assessment->level_project_text)){
                return 1 ;
            }
        }

        return 0;
    }

    public function isSubmitBusinessCase(){
        if($this->business_case){
            if($this->business_case->status === 'PUBLISH'
                && isset($this->business_case->risk_assessment)
                && isset($this->business_case->npv)
                && isset($this->business_case->irr)
                && isset($this->business_case->payback_period)){
                return 1 ;
            }
        }

        return 0;
    }

    public function getOldDepartment($value){
        return Department::where('id',$value)->first()->name;
    }

    public function getInvestmentStrategyAttribute($value)
    {
        if(!$value) return null;
        // Decode the JSON string to an associative array
        $json = json_decode($value, true);
        // Create an object from the array
        $investmentStrategy = (object)$json;
        // Replace underscores with spaces and convert to sentence case
        return $investmentStrategy;
    }
}
