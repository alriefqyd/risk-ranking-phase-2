@inject('setting',App\Models\Setting::class)
<table class="tg">
    <thead>
        <tr>
            <th rowspan="3">Project Number</th>
            <th rowspan="3">Project Name</th>
            <th rowspan="3">Basket</th>
            <th rowspan="3">Sub Basket</th>
            <th rowspan="3">Sub Basket Categories</th>
            <th rowspan="3">Owner</th>
            <th rowspan="3">Project Sponsor</th>
            <th rowspan="3">BC Presenter</th>
            <th rowspan="3">Finance Analyst</th>
            <th rowspan="3">Narrative</th>
            <th rowspan="3">Project Submit Date</th>
            <th rowspan="3">Assessment of Level Project</th>
            <th rowspan="1" colspan="29">1. Form Assessment of Project Level</th>
            <th rowspan="1" colspan="2">2. Form Project Level Complexity</th>
            <th rowspan="1" colspan="1">2. Form Fel 1 Engineering Report</th>
            <th rowspan="1" colspan="3">3. Form Fel 2 Engineering Report</th>
            <th rowspan="1" colspan="25">4. Project FEL 3 or Business Case Form</th>
            <th rowspan="3">Prioritization Criteria</th>
        </tr>
        {{-- column header row 2 start here--}}
        <tr>
            <td rowspan="2">1 Executive Summary</td>
            <td rowspan="2">2 Problem Statement</td>
            <td rowspan="2">3 Objective</td>
            <td rowspan="2">4 Project Scope</td>
            <td rowspan="2">5 Alternatives and Best Option</td>
            <td rowspan="2">6 Project Schedule</td>
            <td rowspan="2">7 List of Equipment and Specification</td>
            <td rowspan="2">8 Key Performance Metric</td>
            <td rowspan="2">9 Key Project Risk Mitigants</td>
            <td rowspan="2">10 Impact if Not Executed</td>
            <td rowspan="2">11 Hazop Study</td>
            <td rowspan="2">12 Cost Estimate</td>
            <td rowspan="2">13 Complexity Score</td>
            <td rowspan="2">14 Assessment of Level Project</td>
            <td rowspan="2">Executive Summary</td>
            <td rowspan="2">Problem Statement</td>
            <td rowspan="2">Objective</td>
            <td rowspan="2">Project Scope</td>
            <td rowspan="2">Alternatives and Best Option</td>
            <td rowspan="2">Project Schedule</td>
            <td rowspan="2">List of Equipment and Specification</td>
            <td rowspan="2">Key Performance Metric</td>
            <td rowspan="2">Key Project Risk Mitigants</td>
            <td rowspan="2">Impact if Not Executed</td>
            <td rowspan="2">Hazop Study</td>
            <td rowspan="2">Cost Estimate</td>
            <td rowspan="2">Complexity Score</td>
            <td rowspan="2">Location of Asset Capitalization</td>
            <td rowspan="2">Assessment of Level Project</td>
            <td rowspan="2">1. Cost Estimate</td>
            <td rowspan="2">2. Complexity Score</td>

            <td rowspan="2">1. Project Scope </td>

            <td rowspan="2">1. Project Scope</td>
            <td rowspan="2">2. Identify Main Equipment</td>
            <td rowspan="2">3. Alternatives and Analysis of Alternatives</td>

            <td rowspan="1" colspan="8">Form Fel 3</td>
            <td rowspan="1" colspan="4">Business Case</td>
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

            <td> 1. Project Scope of Work</td>
            <td> 2. Financial Evaluation  </td>
            <td> 3. Risk Assessment  </td>
            <td> 4. Cost Estimate </td>

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
                <td>{{$p->basket}}</td>
                <td>{{$p->subBasket}}</td>
                <td>{{$p->categoriesName}}</td>
                <td>{{$p->operation}}</td>
                <td>{{$p->sponsor}}</td>
                <td>{{$p->bc_presenter}}</td>
                <td>{{$p->finance_analyst}}</td>
                <td style="background-color:{!! $p->updated_at > now()->startOfDay() ? "#fefe00" : '' !!}">{!! $p->note !!}</td>
                <td>{{$p->created_at}}</td>
                <td style="text-align: center">
                    {{$p?->level_project_text}}</td>
                <td>{{$p?->executive_summary_assessment ?: '0'}}</td>
                <td>{{$p?->problems_statement ?: '0'}}</td>
                <td>{{$p?->objective ?: '0'}}</td>
                <td>{{$p?->project_scope_assessment ?: '0'}}</td>
                <td>{{$p?->alternative_to_proposal ?: '0'}}</td>
                <td>{{$p?->project_schedule_assessment ?: '0'}}</td>
                <td>{{$p?->list_equipment_specification ?: '0'}}</td>
                <td>{{$p?->key_performance_metric ?: '0'}}</td>
                <td>{{$p?->key_project_risk_mitigants ? '1' : '0'}}</td>
                <td>{{$p?->impact_if_not_executed ? '1' : '0'}}</td>
                <td>{{$p?->hazop_study_assessment ? '1' : '0'}}</td>
                <td>{{$p?->cost_estimate_text}}</td>
                <td>{{$p?->complexity_score_assessment ? '1' : '0'}}</td>
                <td>{{$p?->level_project}}</td>
                <td>{!! $p?->executive_summary_text !!} </td>
                <td>{{ $p?->problem_statement_text }}</td>
                <td>{{ $p?->objective_text }}</td>
                <td>{{ $p?->project_scope_text }}</td>
                <td>{{ $p?->alternatives_to_proposal_text }}</td>
                <td>{{ $p?->project_schedule_text }}</td>
                <td>{{ $p?->list_equipment_specification_text }}</td>
                <td>
                    <ol>
                        @if ($p->key_performance_metric_text)
                            @foreach ($p->key_performance_metric_text ?? [] as $value)
                                <li>
                                    Description: {{ $value['description'] ?? "" }},
                                    UOM: {{ $value['uom'] ?? "" }},
                                    Time Benefit: {{ $value['time_benefit'] ?? "" }},
                                    Remarks: {{ $value['remarks'] ?? "" }}.
                                </li>
                            @endforeach
                        @endif
                    </ol>
                </td>
                <td>{{ $p?->key_project_risk_and_mitigants_text }}</td>
                <td>{{ $p?->impact_if_not_executed_text }}</td>
                <td>{{ $p?->hazop_study_text }}</td>
                <td>{!! ($p?->cost_estimate_text)  !!}</td>
                <td>{{ $p?->complexity_score_assessment }}</td>
                <td>
                    @if ($p->location_of_asset_capitalization)
                        <ul>
                            @foreach ($p->location_of_asset_capitalization ?? [] as $value)
                                <li>
                                    Area: {{ $value['area'] }},
                                    Cost Center: {{ $value['cost_center'] }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </td>
                <td>{{$p?->level_project_text }}</td>
                <td>{{$p?->cost_estimate ? '1' : '0'}}</td>
                <td>{{$p?->complexity_score_assessment ? '1' : '0'}}</td>
                <td>{{$p?->project_scope_fel1 ?: '0'}}</td>

                <td>{{$p?->project_scope_fel2 ?: '0'}}</td>
                <td>{{$p?->identify_main_equipment ?: '0'}}</td>
                <td>{{$p?->alternatives_and_analysis ?: '0'}}</td>

                <td>{{$p?->executive_summary ?: '0'}}</td>
                <td>{{$p?->problem_statement ?: '0'}}</td>
                <td>{{$p?->project_scope_fel3 ?: '0'}}</td>
                <td>{{$p?->alternatives_and_best_option ?: '0'}}</td>
                <td>{{$p->project_schedule_fel3 ? '1' : '0'}}</td>
                <td>{{$p?->list_of_equipment_and_specification ? '1' : '0'}}</td>
                <td>{{$p?->hazop_study_fel3 ? '1' : '0'}}</td>
                <td>{{$p?->cost_estimate ? '1' : '0'}}</td>
                <td>{{$p?->project_scope_of_work ?: '0'}}</td>
                <td>{{$p?->financial_evaluation ?: '0'}}</td>
                <td>{{$p?->risk_assessment ?: '0'}}</td>
                <td>{{$p?->cost_estimate}}</td>

                <td>{{$p?->getSeverityValue($p->people)}}</td>
                <td>{{$p?->getSeverityValue($p?->environment)}}</td>
                <td>{{$p?->getSeverityValue($p?->social_and_human_rights)}}</td>
                <td>{{$p?->getSeverityValue($p?->reputation)}}</td>
                <td>{{$p?->getSeverityValue($p?->finance)}}</td>
                <td>{{$p?->final_impact_score}}</td>
                <td>{{$p->getSeverityRiskAssessment($p->final_impact_score)}}</td>
                <td>{{$p->getProbabilityRiskAssessment($p->final_impact_score)}}</td>
                <td>{{$p?->priority_level}}</td>
                <td>{{$p?->change_management_request ? '1' : '0'}}</td>
                <td>{!!$p?->npv ?: '0' !!}</td>
                <td>{{($p?->irr / 100) ?: '0'}}</td>
                <td>{{$p?->payback_period ?: '0'}}</td>
                <td>
                    <div class="row">
                        @foreach($p->breakdownPrioritizationCriteria() as $data)
                            <div class="col-md-12">
                                <p>{{$loop->index + 1}}) </p>
                                <p>Criteria : {{$data['question']}}</p>
                                <p>Answer : {{$data['answer']}}</p>
                            </div>
                        @endforeach
                    </div>
                </td>

            </tr>
        @endforeach
    </tbody>
</table>
