@inject('setting',App\Models\Setting::class)
<table class="tg">
    <thead>
        <tr>
            <th rowspan="3">Project Number</th>
            <th rowspan="3">Project Name</th>
            <th rowspan="3">Basket</th>
            <th rowspan="3">Sub Basket</th>
            <th rowspan="3">Project Category</th>
            <th rowspan="3">Project Type</th>
            <th rowspan="3">Owner</th>
            <th rowspan="3">Project Sponsor</th>
            <th rowspan="3">BC Presenter</th>
            <th rowspan="3">Finance Analyst</th>
            <th rowspan="3">Narrative</th>
            <th rowspan="3">Project Submit Date</th>
            <th rowspan="3">Assessment of Level Project</th>
            <th rowspan="1" colspan="20">1. Form Assessment of Project Level</th>
            <th rowspan="1" colspan="2">2. Form Project Level Complexity</th>
            <th rowspan="1" colspan="7">2. Form Fel 1 Engineering Report</th>
            <th rowspan="1" colspan="7">3. Form Fel 2 Engineering Report</th>
            <th rowspan="1" colspan="24">4. Project FEL 3 or Business Case Form</th>
        </tr>
        {{-- column header row 2 start here--}}
        <tr>
            <td rowspan="2">1 Problem Statement</td>
            <td rowspan="2">2 Objective</td>
            <td rowspan="2">3 Project Scope</td>
            <td rowspan="2">4 Key Performance Metric</td>
            <td rowspan="2">5 Key Project Risk And Mitigants</td>
            <td rowspan="2">6 Impact if not Executed</td>
            <td rowspan="2">7 Alternatives to Proposal</td>
            <td rowspan="2">8 Cost Estimate</td>
            <td rowspan="2">9 Complexity Score</td>
            <td rowspan="2">10 Assessment of Level Project</td>
            <td rowspan="2"> Problem Statement</td>
            <td rowspan="2"> Objective</td>
            <td rowspan="2"> Project Scope</td>
            <td rowspan="2"> Key Performance Metric</td>
            <td rowspan="2"> Key Project Risk And Mitigants</td>
            <td rowspan="2"> Impact if not Executed</td>
            <td rowspan="2"> Alternatives to Proposal</td>
            <td rowspan="2"> Cost Estimate</td>
            <td rowspan="2"> Complexity Score</td>
            <td rowspan="2"> Assessment of Level Project</td>
            <td rowspan="2">1. Cost Estimate</td>
            <td rowspan="2">2. Complexity Score</td>
            <td rowspan="2">1. Project Scope </td>
            <td rowspan="2">2. Identified Parameter, Requirement and Regulation</td>
            <td rowspan="2">3. Alternatives</td>
            <td rowspan="2">4. List of Stakeholder</td>
            <td rowspan="2">5. Schedule Project</td>
            <td rowspan="2">6. Attachment List</td>
            <td rowspan="2">1. Project Scope</td>
            <td rowspan="2">2. Identify Main Equipment</td>
            <td rowspan="2">3. Boundary and Assumption</td>
            <td rowspan="2">4. Analysis of Option</td>
            <td rowspan="2">5. Permit List</td>
            <td rowspan="2">6. Schedule Project</td>
            <td rowspan="2">7. Cost Estimate</td>
            <td rowspan="2">8. Attachment List</td>
            <td rowspan="1" colspan="9">Form Fel 3</td>
            <td rowspan="1" colspan="10">Business Case</td>
            <td rowspan="1" colspan="9">Business Case Risk Assessment</td>
            <td rowspan="2">Change Management Request</td>
            <td rowspan="1" colspan="3">Financial Evaluation</td>
        </tr>
        {{-- Header Row 3 Start Here --}}
        <tr>
            <td> 1. Executive Summary</td>
            <td> 2. Problem Statement</td>
            <td> 3. Project Scope</td>
            <td> 4. Alternatives and Best Option</td>
            <td> 5. Project Schedule</td>
            <td> 6. List of Equipment and Specification</td>
            <td> 7. Hazop Study</td>
            <td> 8. Cost Estimate</td>
            <td> 9. Attachment List</td>
            <td> 1. Problem Statement and Objective</td>
            <td> 2. Project Alternatives</td>
            <td> 3. Project Scope of Work</td>
            <td> 4. Major Equipment</td>
            <td> 5. Utility Requirements</td>
            <td> 6. Permitting</td>
            <td> 7. Social, Community and Government  </td>
            <td> 8. Cost Estimate  </td>
            <td> 9. Financial Evaluation  </td>
            <td> 10. Risk Assessment  </td>
            <td>People</td>
            <td>Environment</td>
            <td>Social and Human Rights</td>
            <td>Reputation</td>
            <td>Finance</td>
            <td>Final Impact Score</td>
            <td>Severity</td>
            <td>Probability</td>
            <td>Priority Level</td>
            <td>NPV</td>
            <td>IRR</td>
            <td>PP</td>
        </tr>
    </thead>
    <tbody>
        @foreach($project as $p)
            <tr>
                <td>{{$p->project_number}}</td>
                <td>{{$p->project_name}}</td>
                <td>{{$p->baskets?->name}}</td>
                <td>{{$p->subBaskets?->name}}</td>
                <td>{{$setting::PROJECT_CATEGORY[$p->project_category]}}</td>
                <td>{{$p->project_type}}</td>
                <td>{{$p->owners?->name}}</td>
                <td>{{$p->sponsors?->name}}</td>
                <td>{{$p->bc_presenter}}</td>
                <td>{{$p->finance_analyst}}</td>
                <td style="background-color:{!! $p->updated_at > now()->startOfDay() ? "#fefe00" : '' !!}">{!! $p->note !!}</td>
                <td>{{$p->created_at}}</td>
                <td style="background-color:
                @if($p?->assessment?->level_project_text == $setting::ASSESSMENT_LEVEL['COMPLEX'])
                    {!! '#fe0000' !!}
                @elseif($p?->assessment?->level_project_text == $setting::ASSESSMENT_LEVEL['MODERATE'])
                    {!! '#00af50' !!}
                @elseif($p?->assessment?->level_project_text == $setting::ASSESSMENT_LEVEL['LIGHT'])
                    {!! '#fefe00' !!}
                @elseif($p?->assessment?->level_project_text == $setting::ASSESSMENT_LEVEL['PDS'])
                    {!! '#5b9bd5' !!}
                @else
                    {!! '' !!}
                @endif
                ;text-align: center">
                    {{$p?->assessment?->level_project_text}}</td>
                <td>{{$p?->assessment?->problems_statement ?: '0'}}</td>
                <td>{{$p?->assessment?->objective ?: '0'}}</td>
                <td>{{$p?->assessment?->project_scope ?: '0'}}</td>
                <td>{{$p?->assessment?->key_performance_metric ?: '0'}}</td>
                <td>{{$p?->assessment?->key_project_risk_mitigants ?: '0'}}</td>
                <td>{{$p?->assessment?->impact_if_not_executed ?: '0'}}</td>
                <td>{{$p?->assessment?->alternative_to_proposal ?: '0'}}</td>
                <td>{{$p?->assessment?->cost_estimate ?: '0'}}</td>
                <td>{{$p?->assessment?->complexity_score_assessment ? '1' : '0'}}</td>
                <td>{{$p?->assessment?->level_project}}</td>
                <td>{{ html_entity_decode(strip_tags($p->assessment?->problem_statement_text)) }}</td>
                <td>{{ html_entity_decode(strip_tags($p->assessment?->objective_text)) }}</td>
                <td>{{ html_entity_decode(strip_tags($p->assessment?->project_scope_text)) }}</td>
                <td>{{ html_entity_decode(strip_tags($p->assessment?->key_performance_metric_text)) }}</td>
                <td>{{ html_entity_decode(strip_tags($p->assessment?->key_project_risk_and_mitigants_text)) }}</td>
                <td>{{ html_entity_decode(strip_tags($p->assessment?->impact_if_not_executed_text)) }}</td>
                <td>{{ html_entity_decode(strip_tags($p->assessment?->alternatives_to_proposal_text)) }}</td>
                <td>{!! ($p->assessment?->cost_estimate_text)  !!}</td>
                <td>{{ html_entity_decode(strip_tags($p->assessment?->complexity_score_assessment)) }}</td>
                <td>{{ html_entity_decode(strip_tags($p->assessment?->level_project_text)) }}</td>
                <td>{{$p?->assessment?->cost_estimate ? '1' : '0'}}</td>
                <td>{{$p?->assessment?->complexity_score_assessment ? '1' : '0'}}</td>
                <td>{{$p?->fel1?->project_scope ?: '0'}}</td>
                <td>{{$p?->fel1?->identified_parameter_requirement_regulation ?: '0'}}</td>
                <td>{{$p?->fel1?->alternatives ?: '0'}}</td>
                <td>{{$p?->fel1?->list_of_stakeholder ?: '0'}}</td>
                <td>{{$p?->fel1?->schedule_project ?: '0'}}</td>
                <td>{{$p?->fel1?->attachment ? '1' : '0'}}</td>
                <td>{{$p?->fel2?->project_scope ?: '0'}}</td>
                <td>{{$p?->fel2?->identify_main_equipment ?: '0'}}</td>
                <td>{{$p?->fel2?->boundary_and_assumption ?: '0'}}</td>
                <td>{{$p?->fel2?->analysis_of_option ?: '0'}}</td>
                <td>{{$p?->fel2?->permit_list ?: '0'}}</td>
                <td>{{$p?->fel2?->schedule_project ?: '0'}}</td>
                <td>{{$p?->fel2?->cost_estimate ?: '0'}}</td>
                <td>{{$p?->fel2?->attachment ? '1' : '0'}}</td>
                <td>{{$p?->fel3?->executive_summary ?: '0'}}</td>
                <td>{{$p?->fel3?->problem_statement ?: '0'}}</td>
                <td>{{$p?->fel3?->project_scope ?: '0'}}</td>
                <td>{{$p?->fel3?->alternatives_and_best_option ?: '0'}}</td>
                <td>{{$p?->fel3?->project_schedule ?: '0'}}</td>
                <td>{{$p?->fel3?->list_of_equipment_and_specification ?: '0'}}</td>
                <td>{{$p?->fel3?->hazop_study ?: '0'}}</td>
                <td>{{$p?->fel3?->cost_estimate ?: '0'}}</td>
                <td>{{$p?->fel3?->attachment ? '1' : '0'}}</td>
                <td>{{$p?->business_case?->problem_statement_and_objective ?: '0'}}</td>
                <td>{{$p?->business_case?->project_alternatives ?: '0'}}</td>
                <td>{{$p?->business_case?->project_scope_of_work ?: '0'}}</td>
                <td>{{$p?->business_case?->major_equipment ?: '0'}}</td>
                <td>{{$p?->business_case?->utility_requirements ?: '0'}}</td>
                <td>{{$p?->business_case?->permitting ?: '0'}}</td>
                <td>{{$p?->business_case?->social_community_and_government ?: '0'}}</td>
                <td>{{$p?->business_case?->cost_estimate ? '1' : '0'}}</td>
                <td>{{$p?->business_case?->financial_evaluation ?: '0'}}</td>
                <td>{{$p?->business_case?->riskAssessment?->id ? '1' : '0'}}</td>
                <td>{{$p?->getSeverityValue($p->business_case?->riskAssessment?->people)}}</td>
                <td>{{$p?->getSeverityValue($p?->business_case?->riskAssessment?->environment)}}</td>
                <td>{{$p?->getSeverityValue($p?->business_case?->riskAssessment?->social_and_human_rights)}}</td>
                <td>{{$p?->getSeverityValue($p?->business_case?->riskAssessment?->reputation)}}</td>
                <td>{{$p?->getSeverityValue($p?->business_case?->riskAssessment?->finance)}}</td>
                <td>{{$p?->business_case?->riskAssessment?->final_impact_score}}</td>
                <td>{{$p->getSeverityRiskAssessment()}}</td>
                <td>{{$p->getProbabilityRiskAssessment()}}</td>
                <td>{{$p?->business_case?->riskAssessment?->priority_level}}</td>
                <td>{{$p?->business_case?->change_management_request ? '1' : '0'}}</td>
                <td>{!!$p?->business_case?->npv ?: '0' !!}</td>
                <td>{{($p?->business_case?->irr / 100) ?: '0'}}</td>
                <td>{{$p?->business_case?->payback_period ?: '0'}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
