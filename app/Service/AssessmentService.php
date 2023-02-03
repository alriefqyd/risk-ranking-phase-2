<?php

namespace App\Service;

use App\Models\Assessment;
use App\Models\Project;
use App\Models\Setting;
use App\Models\User;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssessmentService
{
    public function getAllAssessment(){
        $data = $this->getDataAssessment(null,false);
        return $data->get();
    }

    public function countAssessment($status){
        return $this->getDataAssessment($status,true)->count();
    }

    public function getDataAssessment($status, $newData) {
        $userService = new UserService();
        $assessment = Assessment::with(['user','project']);

        $assessment = $assessment->whereHas('project', function($q) use ($newData,$userService){
            $subQuery = $q->whereNull('deleted_at');
            if($newData) return $subQuery;
            if($userService->isAdminDept()) return $subQuery->where('owner',Auth::user()->department);
        });

        if($status){
            $assessment = $assessment->where('status',$status);
        }

        return $assessment;
    }

    public function getStatus($request){
        $fillableStatus = array(
            $request->problems_statement,
            $request->objective,
            $request->project_scope,
            $request->key_performance_metric,
            $request->key_project_risk_mitigants,
            $request->impact_if_not_executed,
            $request->cost_estimate,
            $request->complexity_score,
        );

        $status = 'PUBLISH';
        if(in_array(null, $fillableStatus)){
            $status = 'DRAFT';
        }
        return $status;
    }

    public function isAssessmentProjectExist($project_id){
        $assessment = Assessment::with(['project'])->where('project_id', $project_id)->first();
        return $assessment;
    }

    public function isValidProject(Request $request){
        $valid = Project::with(['assessment','createdBy'])->where('id',$request->project_id)->first();
        return $valid;
    }
}
