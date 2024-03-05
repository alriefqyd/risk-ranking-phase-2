@inject('setting',App\Models\Setting::class)
    <div class="col-md-12 m-b-20">
        <div class="col-md-12 m-l-10 m-t-10">
            <h6>Investment Strategy</h6>
        </div>
        <div class="col-md-4 m-l-10 text-center">
            <div style="height: 3px; background-color: #24695c "></div>
        </div>
    </div>
    <div class="col-md-12 m-b-25">
        <div class="card-body" style="padding-top: 0">
            @foreach($investmentStrategyList as $investment)
                <div class="js-level-1">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="checkbox checkbox-primary height-40"><input id="checkbox-{{$investment->key}}"
                                       data-id="{{$investment->key}}"
                                       name="checkbox_investment"
                                       value="{{$investment->key}}"
                                       {{!empty($project->investment_strategy) && $investment->key != $project->getInvestmentStrategy()?->level1 ? 'disabled' : ''}}
                                       {{$investment->key == $project->getInvestmentStrategy()?->level1 ? 'checked' : ''}}
                                       class="js-checkbox-{{$investment->key}} js-checkbox-investment-strategy"
                                       type="checkbox">

                                <label for="checkbox-{{$investment->key}}">{{$investment->value}}</label>
                            </div>
                        </div>
                    </div>

                    @foreach($investment->child as $child)
                        <div class="js-level-2
                        {{!isset($project->investment_category) && ($investment->key
                        != $project->getInvestmentStrategy()?->level1) ? 'd-none' : ''}}">
                            <div class="row m-l-15">
                                <div class="col-md-12">
                                    <div class="checkbox checkbox-primary checkbox-width-auto height-35">
                                        <input id="checkbox_level_2-{{$child->key}}"
                                               data-id="{{$child->key}}"
                                               name="checkbox_child_2"
                                               value="{{$child->key}}"
                                               {{!empty($project->investment_strategy) && $child->key != $project->getInvestmentStrategy()?->level2 ? 'disabled' : ''}}
                                               {{$child->key == $project->getInvestmentStrategy()?->level2 ? 'checked' : ''}}
                                               class="js-checkbox-{{$child->key}} js-checkbox-investment-strategy-level-2"
                                               type="checkbox">

                                        <label for="checkbox_level_2-{{$child->key}}">{{$child->value}}</label>
                                    </div>
                                </div>
                            </div>
                            @foreach($child->child as $c)
                                <div class="js-level-3
                                {{!isset($project->investment_category) && ($child->key
                                != $project->getInvestmentStrategy()?->level2) ? 'd-none' : ''}}">
                                    <div class="row m-l-45 m-t-0 ">
                                        <div class="col-md-12">
                                            <div class="checkbox checkbox-primary checkbox-width-auto height-35">
                                                <input id="checkbox_level3-21{{$c->key}}"
                                                       data-id="{{$c->key}}"
                                                       name="checkbox_child_3"
                                                       value="{{$c->key}}"
                                                       {{!empty($project->investment_strategy) && $c->key != $project->getInvestmentStrategy()?->level3 ? 'disabled' : ''}}
                                                       {{$c->key == $project->getInvestmentStrategy()?->level3 ? 'checked' : ''}}
                                                       class="js-checkbox-{{$c->key}} js-checkbox-investment-strategy-level-3"
                                                       type="checkbox">
                                                <label for="checkbox_level3-21{{$c->key}}">{{$c->value}}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
        <button class="btn btn-primary float-end js-next-assessment-form m-r-15 m-b-30 {{!empty($project->investment_strategy) ? 'd-none' : ''}}" {{empty($project->investment_strategy) ? 'disabled' : ''}}  id="nextBtn" type="button">
           <span class="text-button loader-box loader-box-custom"  style="height: 21px">
                Save <span class="m-l-5 loader-34 loader-34-custom d-none"></span>
            </span>
        </button>
    </div>

    <div class="col-md-12 m-t-45 js-table-form-assessment {{empty($project->investment_strategy) ? 'd-none' : ''}}">
        <div class="col-md-12 m-l-10">
            <h6>Project Level Assessment</h6>
        </div>
        <div class="col-md-4 m-l-10 text-center  m-b-10">
            <div style="height: 3px; background-color: #24695c "></div>
        </div>
    </div>

    <div class="table-responsive js-table-form-assessment {{empty($project->investment_strategy) ? 'd-none' : ''}}">
        <input type="hidden" class="js-project-id" value="{{$project->id}}">
        <table class="table table-striped js-table-assessment">
            <tbody>
            <tr>
                <td colspan="3">
                    <div class="row">
                        <div class="col-md-3 mb-3 padding-right-0 w-20">
                            <label class="float-start">Executive Summary : </label>
                        </div>
                        <div class="col-md-3 m-t-4 float-start padding-left-0">
                            <div class="checkbox-rect">
                                <input id="checkbox-executive-summary"
                                       name="check-executive_summary"
                                       {{$project?->assessment?->executive_summary == 1 ? 'checked' : ''}}
                                       class="js-checkbox-assessment js-executive-summary" type="checkbox">
                                <label for="checkbox-executive-summary"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <small>(The Executive Summary is a high level description of the project and describes how the project fits in to the PTI and business area strategic plan. This should describe the project objectives backed up by an analysis of the organization’s current and projected future situation and the definition of its objectives. It is necessary to identify the overall reason for the initiative by relating it to one or more objectives of the organization. The business case should describe the result that an organization needs to achieve). Including Summary Financial Evaluation</small>

                            <textarea class="tinymce js-text-executive-summary"
                                      name="problem_statement"
                                  {!! $project?->assessment?->executive_summary != 1 ? 'style="display: none"' : '' !!}>
                            {!! $project?->assessment?->executive_summary_text !!}
                        </textarea>
                            <input type="hidden" class="js-hidden-validate" name="validate_executive_summary">
                            <div class="col-md-12 txt-danger js-error-message"></div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="row">
                        <div class="col-md-3 mb-3 padding-right-0 w-20">
                            <label class="float-start">Problem Statement : </label>
                        </div>
                        <div class="col-md-3 m-t-4 float-start padding-left-0">
                            <div class="checkbox-rect">
                                <input id="checkbox-problem-statement"
                                       {{$project?->assessment?->problems_statement == 1 ? 'checked' : ''}}
                                       class="js-checkbox-assessment js-problem-statement" type="checkbox">
                                <label for="checkbox-problem-statement"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <small>(Provide a description of problems, restrictions, constraints. At this document should not be a description of a solution).</small>
                            <textarea class="tinymce js-text-problem-statement"
                                      name="problem_statement"
                                  {!! $project?->assessment?->problems_statement != 1 ? 'style="display: none"' : '' !!}>
                                {!! $project?->assessment?->problem_statement_text !!}
                            </textarea>
                            <input type="hidden" class="js-hidden-validate" name="validate_problem_statement">
                            <div class="col-md-12 txt-danger js-error-message"></div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="row">
                        <div class="col-md-3 mb-3 padding-right-0 w-20">
                            <label class="float-start">Objective : </label>
                        </div>
                        <div class="col-md-3 m-t-4 float-start padding-left-0">
                            <div class="checkbox-rect">
                                <input id="checkbox-objective"
                                       {{$project?->assessment?->objective == 1 ? 'checked' : ''}}
                                       class="js-checkbox-assessment" type="checkbox">
                                <label for="checkbox-objective"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <small>(It is necessary to identify the overall reason for the initiative by relating it to one or more objectives of the organization that need to achieve).</small>
                            <textarea class="tinymce js-text-objective" name="objective"
                            {!! $project?->assessment?->objective != 1 ? 'style="display: none"' : '' !!}>
                                {!! $project?->assessment?->objective_text !!}
                        </textarea>
                            <input type="hidden" class="js-hidden-validate" name="validate_objective">
                            <div class="col-md-12 txt-danger js-error-message"></div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="row">
                        <div class="col-md-3 mb-3 padding-right-0 w-20">
                            <label class="float-start">Project Scope : </label>
                        </div>
                        <div class="col-md-3 m-t-4 float-start padding-left-0">
                            <div class="checkbox-rect">
                                <input id="checkbox-project-scope"
                                       {{$project?->assessment?->project_scope == 1 ? 'checked' : ''}}
                                       class="js-checkbox-assessment" type="checkbox">
                                <label for="checkbox-project-scope"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <small>(According to problem that has and objective that would to achieve, please mentioned what scope that this project need to cover).</small>
                            <textarea class="tinymce js-text-project-scope"
                                {!! $project?->assessment?->project_scope != 1 ? 'style="display: none"' : '' !!}>
                                            {!! $project?->assessment?->project_scope_text !!}
                            </textarea>
                            <input type="hidden" class="js-hidden-validate" name="validate_project_scope">
                            <div class="col-md-12 txt-danger js-error-message"></div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>

                <td colspan="3">
                    <div class="row">
                        <div class="col-md-3 mb-3 padding-right-0 w-20">
                            <label class="float-start">Alternative & <br> Best Option : </label>
                        </div>
                        <div class="col-md-3 m-t-5 float-start padding-left-0">
                            <div class="checkbox-rect">
                                <input id="checkbox-alternative"
                                       {{$project?->assessment?->alternative_to_proposal == 1 ? 'checked' : ''}}
                                       class="js-checkbox-assessment" type="checkbox">
                                <label for="checkbox-alternative"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <small>Discuss the next best alternative to the proposed spend (if applicable)</small>
                                    <textarea class="tinymce js-alternative"
                                {!! $project?->assessment?->alternative_to_proposal != 1 ? 'style="display: none"' : '' !!}>
                                {!! $project?->assessment?->alternatives_to_proposal_text !!}
                            </textarea>
                            <input type="hidden" class="js-hidden-validate" name="validate_alternative">
                            <div class="col-md-12 txt-danger js-error-message"></div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="row">
                        <div class="col-md-3 mb-3 padding-right-0 w-20">
                            <label class="float-start">Project Schedule : </label>
                        </div>
                        <div class="col-md-3 m-t-5 float-start padding-left-0">
                            <div class="checkbox-rect">
                                <input id="checkbox-schedule"
                                       {{$project?->assessment?->project_schedule == 1 ? 'checked' : ''}}
                                       class="js-checkbox-assessment js-project-schedule" type="checkbox">
                                <label for="checkbox-schedule"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <small>(Highlight the schedule, for breakdown until level 3 put as attachment)</small>
                            <textarea class="tinymce js-text-project-schedule" name="project_schedule_text"
                                {!! $project?->assessment?->project_schedule != 1 ? 'style="display: none"' : '' !!}>
                                    {!! $project?->assessment?->project_schedule_text !!}
                            </textarea>
                            <input type="hidden" class="js-hidden-validate" name="validate_project_schedule">
                            <div class="col-md-12 txt-danger js-error-message"></div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="row">
                        <div class="col-md-3 mb-3 padding-right-0 w-20">
                            <label class="float-start">List of Equipment and Specification : </label>
                        </div>
                        <div class="col-md-3 m-t-5 float-start padding-left-0">
                            <div class="checkbox-rect">
                                <input id="checkbox-list-equipment-specification"
                                       {{$project?->assessment?->list_equipment_specification == 1 ? 'checked' : ''}}
                                       class="js-checkbox-assessment js-checkbox-list-equipment-specification" type="checkbox">
                                <label for="checkbox-list-equipment-specification"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <small>(At this stage list of equipment can identify, mentioned at this paragraph & attached the reference or quotation).</small>
                            <textarea class="tinymce js-text-list-equipment-specification" name="list_equipment_specification_text"
                                {!! $project?->assessment?->list_equipment_specification != 1 ? 'style="display: none"' : '' !!}>
                                    {!! $project?->assessment?->list_equipment_specification_text !!}
                            </textarea>
                            <input type="hidden" class="js-hidden-validate" name="validate_project_schedule">
                            <div class="col-md-12 txt-danger js-error-message"></div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="row">
                        <div class="col-md-3 w-20 mb-3 padding-right-0">
                            <label class="float-start">Key Performance <br> Metric : </label>
                        </div>
                        <div class="col-md-3 m-t-4 float-start padding-left-0">
                            <div class="checkbox-rect">
                                <input type="checkbox" class="js-checkbox-key-performance-metric"
                                       id="checkbox-key-performance-metric"
                                       {{$project?->assessment?->key_performance_metric == 1 ? 'checked' : ''}}
                                       name="check">
                                <label for="checkbox-key-performance-metric"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <small>Key performance indicator assumption before and after investment, justification for proposed budget</small>
                            <ol>
                                <li>Define project’s benefit:</li>
                                <li>Project’s benefit related to Opex budget? Y/N</li>
                                <li>Project’s benefit related to production volume? Y/N</li>
                                <li>If any of the answer is Yes, how it is reflected and measured?</li>
                            </ol>

                            <div class="table table-striped js-table-kpm-kpi {{$project->assessment?->key_performance_metric == 0 ? 'd-none' : ''}}">
                                <table style="width: 100%">
                                    <thead>
                                    <th colspan="5" class="text-center">KPI - Key Performance Indicator <br> (KPI will be measured upon project completion)</th>
                                    </thead>
                                    <thead>
                                    <th style="width: 30px">No</th>
                                    <th class="">KPI Description</th>
                                    <th style="width: 100px">UoM</th>
                                    <th>Time to Benfit</th>
                                    <th>Remarks</th>
                                    <th></th>
                                    </thead>
                                    <tbody class="js-table-body-kpm-kpi">
                                    @if($isEdit)
                                        @if($project->assessment->isKpiJson())
                                            @foreach($project->assessment?->getKpiList() as $kpi)
                                                <tr class="js-row-kpi">
                                                    <td>1</td>
                                                    <td><input type="text" value="{{$kpi?->description ?? ''}}" class="form-control js-kpi-description"></td>
                                                    <td><input type="text" value="{{$kpi?->uom ?? ''}}" class="form-control js-kpi-uom"></td>
                                                    <td><input type="text" value="{{$kpi?->time_benefit ?? ''}}" class="form-control js-kpi-time-benefit"></td>
                                                    <td><input type="text" value="{{$kpi?->remarks ?? ''}}" class="form-control js-kpi-remarks"></td>
                                                    <td>
                                                        <i class="fa fa-plus-circle cursor-pointer js-add-kpm-kpi"></i>
                                                        <i class="fa fa-times-circle m-l-2 text-danger cursor-pointer js-delete-kpm-kpi"></i>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @else
                                        <tr class="js-row-kpi">
                                            <td>1</td>
                                            <td><input type="text" class="form-control js-kpi-description"></td>
                                            <td><input type="text" class="form-control js-kpi-uom"></td>
                                            <td><input type="text" class="form-control js-kpi-time-benefit"></td>
                                            <td><input type="text" class="form-control js-kpi-remarks"></td>
                                            <td>
                                                <i class="fa fa-plus-circle cursor-pointer js-add-kpm-kpi"></i>
                                                <i class="fa fa-times-circle m-l-2 text-danger cursor-pointer js-delete-kpm-kpi"></i>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <input type="hidden" class="js-hidden-validate" name="validate_kpm">
                            <div class="col-md-12 txt-danger js-error-message"></div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="row">
                        <div class="col-md-3 mb-3 padding-right-0 w-20">
                            <label class="float-start">Key Project Risk Mitigants : </label>
                        </div>
                        <div class="col-md-3 m-t-5 float-start padding-left-0">
                            <div class="checkbox-rect">
                                <input id="checkbox-prm"
                                       {{$project?->assessment?->key_project_risk_mitigants == 1 ? 'checked' : ''}}
                                       class="js-checkbox-assessment" type="checkbox">
                                <label for="checkbox-prm"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <small>List top 5 project risks, and where applicable the mitigation measures required</small>
                            <textarea class="tinymce js-key-project-risk"
                                {!! $project?->assessment?->key_project_risk_mitigants != 1 ? 'style="display: none"' : '' !!}>
                                    {!! $project?->assessment?->key_project_risk_and_mitigants_text !!}
                            </textarea>
                            <input type="hidden" class="js-hidden-validate" name="validate_prm">
                            <div class="col-md-12 txt-danger js-error-message"></div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="row">
                        <div class="col-md-3 mb-3 padding-right-0 w-20">
                            <label class="float-start">Impact If <br/>Not Executed :</label>
                        </div>
                        <div class="col-md-3 m-t-5 float-start padding-left-0">
                            <div class="checkbox-rect">
                                <input id="checkbox-impact-if-not-executed"
                                       {{$project?->assessment?->impact_if_not_executed == 1 ? 'checked' : ''}}
                                       class="js-checkbox-assessment" type="checkbox">
                                <label for="checkbox-impact-if-not-executed"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <small>What is the likely consequence of not executing on this capital item</small>
                            <textarea class="tinymce js-impact"
                                {!! $project?->assessment?->impact_if_not_executed != 1 ? 'style="display: none"' : '' !!}>
                                    {!! $project?->assessment?->impact_if_not_executed_text !!}
                            </textarea>
                            <input type="hidden" class="js-hidden-validate" name="validate_iie">
                            <div class="col-md-12 txt-danger js-error-message"></div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="row">
                        <div class="col-md-3 mb-3 padding-right-0 w-20">
                            <label class="float-start">HAZOP Study<span class="text-danger f-w-550">*</span> :</label>
                        </div>
                        <div class="col-md-3 m-t-5 float-start padding-left-0">
                            <div class="checkbox-rect">
                                <input id="checkbox-hazop-study"
                                       {{$project?->assessment?->hazop_study == 1 ? 'checked' : ''}}
                                       class="js-checkbox-hazop-study js-checkbox-assessment" type="checkbox">
                                <label for="checkbox-hazop-study"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <small>(From preliminary design please conduct HAZOP Study, highlighted the main issue in one or two paragraph. Result of HAZOP study that has updated as reference for future stage/detail design).</small>
                            <textarea class="tinymce js-text-hazop-study"
                                {!! $project?->assessment?->hazop_study != 1 ? 'style="display: none"' : '' !!}>
                                    {!! $project?->assessment?->hazop_study_text !!}
                            </textarea>
                            <input type="hidden" class="js-hidden-validate" name="validate_iie">
                            <div class="col-md-12 txt-danger js-error-message"></div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="row">
                        <div class="col-md-3 mb-3 padding-right-0 w-20">
                            <label class="float-start">Cost Estimate<span class="text-danger f-w-550">*</span> :</label>
                        </div>
                        <div class="col-md-3 m-t-5 float-start padding-left-0">
                            <div class="checkbox-rect">
                                <input id="checkbox-cost-estimate"
                                       class="js-checkbox-assessment"
                                       {{$project?->assessment?->cost_estimate == 1 ? 'checked' : ''}}
                                       type="checkbox">
                                <label for="checkbox-cost-estimate"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <small>(Develop rough cost estimate or reference (from similar project is acceptable) for assessment of complexity level).</small>
                            <div class="input-group mb-3 js-cost-estimate
                                {{$project?->assessment?->cost_estimate == 0 ? 'd-none' : ''}}">
                                <span class="input-group-text">$  </span>
                                <input class="form-control js-currency-format js-cost_estimate_assessment cold-md-12" type="text"
                                       placeholder="xxx.xxx.xxx,xx"
                                       value="{{$project?->assessment?->cost_estimate_text}}"
                                       aria-label="Amount (to the nearest dollar)">
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="row">
                        <div class="col-md-3 mb-3 padding-right-0 w-20">
                            <label class="float-start">Economic Evaluation<span class="text-danger f-w-550">*</span> : </label>
                        </div>
                        <div class="col-md-3 m-t-5 float-start padding-left-0">
                            <div class="checkbox-rect">
                                <input id="checkbox-economic-evaluation"
                                       {{$project?->assessment?->economic_evaluation == 1 ? 'checked' : ''}}
                                       class="js-checkbox-assessment js-check-economic-evaluation" type="checkbox">
                                <label for="checkbox-economic-evaluation"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <small>(Develop financial evaluation with Financial Analyst)</small>
                            <textarea class="tinymce js-text-economic-evaluation"
                                {!! $project?->assessment?->key_project_risk_mitigants != 1 ? 'style="display: none"' : '' !!}>
                                    {!! $project?->assessment?->key_project_risk_and_mitigants_text !!}
                            </textarea>
                            <input type="hidden" class="js-hidden-validate" name="validate_prm">
                            <div class="col-md-12 txt-danger js-error-message"></div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="row">
                        <div class="col-md-3 mb-3 padding-right-0 w-20">
                            <label class="float-start">Complexity Score<span class="text-danger f-w-550">*</span> :</label>
                        </div>
                        <div class="col-md-3 m-t-5 float-start padding-left-0">
                            <div class="checkbox-rect">
                                <input id="checkbox-complexity-assessment"
                                       {{$project?->assessment?->complexity_assessment_checkbox == 1 ? 'checked' : ''}}
                                       class="js-checkbox-assessment" type="checkbox">
                                <label for="checkbox-complexity-assessment"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <small>(According to complexity assessment, this project has score ……).</small>
                            <div class="js-complexity-assessment-head
                            {!! $project?->assessment?->complexity_assessment_checkbox != 1 ? 'd-none' : '' !!}">
                                <table style="width: 100%">
                                    <tr>
                                        <td>
                                            Technology Characteristic
                                        </td>
                                        <td>
                                            <select id="u-rating-movie" data-idx="0" class="rating-custom js-complexity-assessment-technology js-complexity-assessment-score" name="rating" autocomplete="off">
                                                @for($i=1;$i<6;$i++)
                                                    <option value></option>
                                                    @if($i > 0)
                                                        <option
                                                            {{$project?->getProjectAssessmentComplexity('complexity_assessment_technology') == $i ? 'selected' : ''}}
                                                            value="{{$i}}">{{$i}}</option>
                                                    @endif
                                                @endfor
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Engineering Characteristic
                                        </td>
                                        <td>
                                            <select id="u-rating-movie" data-idx="1" class="rating-custom js-complexity-assessment-engineering js-complexity-assessment-score" name="rating" autocomplete="off">
                                                @for($i=1;$i<6;$i++)
                                                    <option value></option>
                                                    @if($i > 0)
                                                        <option
                                                            {{$project?->getProjectAssessmentComplexity('complexity_assessment_engineering') == $i ? 'selected' : ''}}
                                                            value="{{$i}}">{{$i}}</option>
                                                    @endif
                                                @endfor
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Owner Business Impact Characteristic
                                        </td>
                                        <td>
                                            <select id="u-rating-movie" data-idx="2" class="rating-custom js-complexity-assessment-owner_business js-complexity-assessment-score" name="rating" autocomplete="off">
                                                @for($i=1;$i<6;$i++)
                                                    <option value></option>
                                                    @if($i > 0)
                                                        <option
                                                            {{$project?->getProjectAssessmentComplexity('complexity_assessment_owner_business') == $i ? 'selected' : ''}}
                                                            value="{{$i}}">{{$i}}</option>
                                                    @endif
                                                @endfor
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            External Approval Characteristic
                                        </td>
                                        <td>
                                            <select id="u-rating-movie" data-idx="3" class="rating-custom js-complexity-assessment-external-approval js-complexity-assessment-score" name="rating" autocomplete="off">
                                                @for($i=1;$i<6;$i++)
                                                    <option value></option>
                                                    @if($i > 0)
                                                        <option
                                                            {{$project?->getProjectAssessmentComplexity('complexity_assessment_external_approval') == $i ? 'selected' : ''}}
                                                            value="{{$i}}">{{$i}}</option>
                                                    @endif
                                                @endfor
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td>
                                            <p class="f-w-700 js-label-project-complexity-score">{{$project?->assessment?->complexity_score_assessment ?: 0}}</p>
                                            <input type="hidden" class="js-hidden-project-level-assessment-score" value="{{$project?->assessment?->complexity_score_assessment ?: 0}}">
                                        </td>
                                    </tr>
                                </table>
                                <label class="m-t-3 js-assessment-message-mandatory-form-fels"></label>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="row">
                        <div class="col-md-12 mb-3 padding-right-0">
                            <label class="float-start">Assessment of Level Project : </label>
                            <small>(According to cost estimate $ <span class="text-danger js-currency-format-text js-cost-estimate-label-assessment">
                                    {{$project?->assessment?->cost_estimate_text}}
                                    </span> and complexity score
                                <span class="text-danger js-complexity-score-label-assessment">
                                        {{$project?->assessment?->complexity_score_assessment}}
                                    </span> , that this categorize as
                                <span class="text-danger text-large-custom js-assessment-level-status-auto">{{$project?->assessment?->level_project_text}}</span> project).
                            </small>
                            <div class="js-select2">
                                <input type="hidden" value="{{$project?->assessment?->level_project_text}}" class="form-control js-select-score" style="width: 100%" name="complexity_score_assessment">
                                <div class="col-md-12 txt-danger js-error-message"></div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div class="row">
                        <div class="col-md-3 mb-3 padding-right-0 w-20">
                            <label class="float-start">Complexity Analyzis<span class="text-danger f-w-550">*</span> :</label>
                        </div>
                        <div class="col-md-3 m-t-5 float-start padding-left-0">
                            <div class="checkbox-rect">
                                <input id="checkbox-level"
                                       {{$project?->assessment?->level_project == 1 ? 'checked' : ''}}
                                       class="js-checkbox-assessment" type="checkbox">
                                <label for="checkbox-level"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <small>(Answer the complexity analyzes questions below with select “Yes” or “No” according to investment requirement completely). Notes: if the answer of question number #1 is “Yes” and if the answer of question number #2 is “No”, you may not continue to the next complexity analyzes.</small>
                            <div class="js-complexity-analysis-head {!! $project?->assessment?->level_project != 1 ? 'd-none' : '' !!}">
                                <div class="default-according style-1" id="accordionoc">
                                    <h5 class="mb-3">
                                        <button class="p-0 btn btn-link js-btn-complexity-score-accordion text-primary-template" data-bs-toggle="collapse" data-bs-target="#collapseicon" aria-expanded="true" aria-controls="collapse11"><i class="icofont icofont-briefcase-alt-2"></i>
                                            <span>Complexity Analyzes Questions</span>
                                        </button>
                                    </h5>
                                </div>
                                <div class="collapse show mb-4" id="collapseicon" aria-labelledby="collapseicon" data-bs-parent="#accordionoc">
                                    <table>
                                        <tr>
                                            <td>1</td>
                                            <td>Is the investment just a purchase of materials, components, operational eqiupments (shelf or catalog) and / or service?</td>
                                            <td>
                                                Yes
                                                <input type="radio" class="js-complexity-analysis" data-idx="0"
                                                       {{$project?->getComplexityAnalysis($setting::COMPLEXITY_ANALYSIS['1']) ? 'checked' : ''}}
                                                       name={{$setting::COMPLEXITY_ANALYSIS['1']}} value="1">
                                            </td>
                                            <td>
                                                No
                                                <input type="radio" class="js-complexity-analysis" data-idx="0"
                                                       {{!$project?->getComplexityAnalysis($setting::COMPLEXITY_ANALYSIS['1']) ? 'checked' : ''}}
                                                       name="{{$setting::COMPLEXITY_ANALYSIS['1']}}" value="0">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Does the investment needs engineering development?</td>
                                            <td>
                                                Yes
                                                <input type="radio" class="js-complexity-analysis" data-idx="1"
                                                       {{$project?->getComplexityAnalysis($setting::COMPLEXITY_ANALYSIS['2']) ? 'checked' : ''}}
                                                       name="{{$setting::COMPLEXITY_ANALYSIS['2']}}" value="1">
                                            </td>
                                            <td>
                                                No
                                                <input type="radio" class="js-complexity-analysis" data-idx="1"
                                                       {{!$project?->getComplexityAnalysis($setting::COMPLEXITY_ANALYSIS['2']) ? 'checked' : ''}}
                                                       name="{{$setting::COMPLEXITY_ANALYSIS['2']}}" value="0">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Does the project require requires 3 or more engineering disciplines? (mechanical, electrical, chemical, civil, automation, geotechnics)</td>
                                            <td>
                                                Yes
                                                <input type="radio" class="js-complexity-analysis js-disable-step" data-idx="2"
                                                       {{$project?->getComplexityAnalysis($setting::COMPLEXITY_ANALYSIS['3']) ? 'checked' : ''}}
                                                       name="{{$setting::COMPLEXITY_ANALYSIS['3']}}" value="1">
                                            </td>
                                            <td>
                                                No
                                                <input type="radio" class="js-complexity-analysis js-disable-step" data-idx="2"
                                                       {{!$project?->getComplexityAnalysis($setting::COMPLEXITY_ANALYSIS['3']) ? 'checked' : ''}}
                                                       name="{{$setting::COMPLEXITY_ANALYSIS['3']}}" value="0">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Does the investment require 3 or more contracts simultaneously?</td>
                                            <td>
                                                Yes
                                                <input type="radio" class="js-complexity-analysis js-disable-step" data-idx="3"
                                                       {{$project?->getComplexityAnalysis($setting::COMPLEXITY_ANALYSIS['4']) ? 'checked' : ''}}
                                                       name="{{$setting::COMPLEXITY_ANALYSIS['4']}}" value="1">
                                            </td>
                                            <td>
                                                No
                                                <input type="radio" class="js-complexity-analysis js-disable-step" data-idx="3"
                                                       {{!$project?->getComplexityAnalysis($setting::COMPLEXITY_ANALYSIS['4']) ? 'checked' : ''}}
                                                       name="{{$setting::COMPLEXITY_ANALYSIS['4']}}" value="0">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Will the number of workers (internal and external) during deployment exceed 100 people?</td>
                                            <td>
                                                Yes
                                                <input type="radio" class="js-complexity-analysis js-disable-step" data-idx="4"
                                                       {{$project?->getComplexityAnalysis($setting::COMPLEXITY_ANALYSIS['5']) ? 'checked' : ''}}
                                                       name="{{$setting::COMPLEXITY_ANALYSIS['5']}}" value="1">
                                            </td>
                                            <td>
                                                No
                                                <input type="radio" class="js-complexity-analysis js-disable-step" data-idx="4"
                                                       {{!$project?->getComplexityAnalysis($setting::COMPLEXITY_ANALYSIS['5']) ? 'checked' : ''}}
                                                       name="{{$setting::COMPLEXITY_ANALYSIS['5']}}" value="0">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Does the investment involve the transportation hiring or special equipment under Vale's responsibility?</td>
                                            <td>
                                                Yes
                                                <input type="radio" class="js-complexity-analysis js-disable-step" data-idx="5"
                                                       {{$project?->getComplexityAnalysis($setting::COMPLEXITY_ANALYSIS['6']) ? 'checked' : ''}}
                                                       name="{{$setting::COMPLEXITY_ANALYSIS['6']}}" value="1">
                                            </td>
                                            <td>
                                                No
                                                <input type="radio" class="js-complexity-analysis js-disable-step" data-idx="5"
                                                       {{!$project?->getComplexityAnalysis($setting::COMPLEXITY_ANALYSIS['6']) ? 'checked' : ''}}
                                                       name="{{$setting::COMPLEXITY_ANALYSIS['6']}}" value="0">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>Does the project require operational shutdowns on operating systems?</td>
                                            <td>
                                                Yes
                                                <input type="radio" class="js-complexity-analysis js-disable-step" data-idx="6"
                                                       {{$project?->getComplexityAnalysis($setting::COMPLEXITY_ANALYSIS['7']) ? 'checked' : ''}}
                                                       name="{{$setting::COMPLEXITY_ANALYSIS['7']}}" value="1">
                                            </td>
                                            <td>
                                                No
                                                <input type="radio" class="js-complexity-analysis js-disable-step" data-idx="6"
                                                       {{!$project?->getComplexityAnalysis($setting::COMPLEXITY_ANALYSIS['7']) ? 'checked' : ''}}
                                                       name="{{$setting::COMPLEXITY_ANALYSIS['7']}}" value="0">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td>Are there interferences that may delay the project (e.g. na asset needs to be moved to start a project?</td>
                                            <td>
                                                Yes
                                                <input type="radio" class="js-complexity-analysis js-disable-step" data-idx="7"
                                                       {{$project?->getComplexityAnalysis($setting::COMPLEXITY_ANALYSIS['8']) ? 'checked' : ''}}
                                                       name="{{$setting::COMPLEXITY_ANALYSIS['8']}}" value="1">
                                            </td>
                                            <td>
                                                No
                                                <input type="radio" class="js-complexity-analysis js-disable-step" data-idx="7"
                                                       {{!$project?->getComplexityAnalysis($setting::COMPLEXITY_ANALYSIS['8']) ? 'checked' : ''}}
                                                       name="{{$setting::COMPLEXITY_ANALYSIS['8']}}" value="0">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td>Does the investment require environmental licensing or involvement of other regulatory bodies?</td>
                                            <td>
                                                Yes
                                                <input type="radio" class="js-complexity-analysis js-disable-step" data-idx="8"
                                                       {{$project?->getComplexityAnalysis($setting::COMPLEXITY_ANALYSIS['9']) ? 'checked' : ''}}
                                                       name="{{$setting::COMPLEXITY_ANALYSIS['9']}}" value="1">
                                            </td>
                                            <td>
                                                No
                                                <input type="radio" class="js-complexity-analysis js-disable-step" data-idx="8"
                                                       {{!$project?->getComplexityAnalysis($setting::COMPLEXITY_ANALYSIS['9']) ? 'checked' : ''}}
                                                       name="{{$setting::COMPLEXITY_ANALYSIS['9']}}" value="0">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td>Does the investment require community involvement?</td>
                                            <td>
                                                Yes
                                                <input type="radio" class="js-complexity-analysis js-disable-step" data-idx="9"
                                                       {{$project?->getComplexityAnalysis($setting::COMPLEXITY_ANALYSIS['10']) ? 'checked' : ''}}
                                                       name="{{$setting::COMPLEXITY_ANALYSIS['10']}}" value="1">
                                            </td>
                                            <td>
                                                No
                                                <input type="radio" class="js-complexity-analysis js-disable-step" data-idx="9"
                                                       {{!$project?->getComplexityAnalysis($setting::COMPLEXITY_ANALYSIS['10']) ? 'checked' : ''}}
                                                       name="{{$setting::COMPLEXITY_ANALYSIS['10']}}" value="0">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>11</td>
                                            <td>Does the investment require the purchase or lease of third party land?</td>
                                            <td>
                                                Yes
                                                <input type="radio" class="js-complexity-analysis js-disable-step" data-idx="10"
                                                       {{$project?->getComplexityAnalysis($setting::COMPLEXITY_ANALYSIS['11']) ? 'checked' : ''}}
                                                       name="{{$setting::COMPLEXITY_ANALYSIS['11']}}" value="1">
                                            </td>
                                            <td>
                                                No
                                                <input type="radio" class="js-complexity-analysis js-disable-step" data-idx="10"
                                                       {{!$project?->getComplexityAnalysis($setting::COMPLEXITY_ANALYSIS['11']) ? 'checked' : ''}}
                                                       name="{{$setting::COMPLEXITY_ANALYSIS['11']}}" value="0">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <input type="hidden" name="score" value="{{$project?->assessment?->complexity_analyzis_score}}" class="js-complexity-analyzis-score-label-val">
                                <input type="hidden" name="complexity_analysis_type" data-existing-type="{{$project?->assessment?->complexity_analysis_type}}"
                                       value="{{$project?->assessment?->complexity_analysis_type}}"
                                       data-is-ma-exist="{{$project?->fel3?->maturityAnalysis?->id}}" class="js-complexity-label-val">
                                Score : <span class="js-complexity-score-label">{{$project?->assessment?->complexity_analyzis_score}}</span></br>
                                Complexity : <span class="js-complexity-label">{{$project?->assessment?->complexity_analysis_type}}</span>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>

        <tr>
            <td colspan="3">
                <div class="row mb-3">
                    <label class="float-start">Attachment File : </label>
                </div>

                <div class="row">
                    <div class="table-responsive">
                        <table class="table-striped" style="width: 100%">
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @php($attachmentInitialCostEstimate = $project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['initial_cost_estimate']))
                                            <label>Initial Cost Estimate <span class="text-danger f-w-550">*</span> </label>
                                            <input class="form-control js-attachment-mandatory js-upload-attachment js-assessment-attachment_initial_cost_estimate col-md-10"
                                                   data-validated="{{isset($attachmentInitialCostEstimate) ? 'true' : 'false'}}"
                                                   value="{{$project?->project_name}}" name="document" id="inputFile" data-idx="0" multiple type="file">
                                            @if($project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['initial_cost_estimate']))
                                                <a target="_blank"
                                                   class="js-attachment-existing-assessment"
                                                   href="/preview?id={{$project->id}}&category={{$setting::FOLDER_TYPE['assessment']}}&file={{urlencode($project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['initial_cost_estimate']))}}&dir={{$project->project_name}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$attachmentInitialCostEstimate}}
                                                </a>
                                            @endif
                                        </div>
                                        <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                                        <div class="js-error-file_size js-check-count-error text-danger"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @php($attachmentComplexity = $project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['complexity_matrix']))
                                            <label>Complexity Matrix <span class="text-danger f-w-550">*</span></label>
                                            <input class="form-control js-attachment-mandatory js-upload-attachment js-assessment-attachment_complexity_matrix col-md-10"
                                                   data-validated="{{isset($attachmentComplexity) ? 'true' : 'false'}}"
                                                   value="{{$project?->project_name}}" name="document" id="inputFile" data-idx="1" multiple type="file">
                                            @if($project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['complexity_matrix']))
                                                <a target="_blank"
                                                   class="js-attachment-existing-assessment"
                                                   href="/preview?id={{$project->id}}&category={{$setting::FOLDER_TYPE['assessment']}}&file={{urlencode($project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['complexity_matrix']))}}&dir={{$project->project_name}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$attachmentComplexity}}
                                                </a>
                                            @endif
                                        </div>
                                        <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                                        <div class="js-error-file_size js-check-count-error text-danger"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @php($attachmentPreliminaryDesign = $project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['preliminary_design']))
                                            <label>Preliminary Design <span class="text-danger f-w-550">*</span></label>
                                            <input class="form-control js-attachment-mandatory js-upload-attachment js-assessment-attachment_preliminary_design col-md-10"
                                                   data-validated="{{isset($attachmentPreliminaryDesign) ? 'true' : 'false'}}"
                                                   value="{{$project?->project_name}}" name="document" id="inputFile" data-idx="2" multiple type="file">
                                            @if($project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['preliminary_design']))
                                                <a target="_blank"
                                                   class="js-attachment-existing-assessment"
                                                   href="/preview?id={{$project->id}}&category={{$setting::FOLDER_TYPE['assessment']}}&file={{urlencode($project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['preliminary_design']))}}&dir={{$project->project_name}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$attachmentPreliminaryDesign}}
                                                </a>
                                            @endif
                                        </div>
                                        <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                                        <div class="js-error-file_size js-check-count-error text-danger"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @php($attachmentUtility = $project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['utility_infrastructure_facilities_diagram']))
                                            <label>Utility/Infrastructure/Facilities Diagram <span class="text-danger f-w-550">*</span></label>
                                            <input class="form-control js-attachment-mandatory js-upload-attachment js-assessment-attachment_utility_infrastructure_facilities_diagram col-md-10"
                                                   data-validated="{{isset($attachmentUtility) ? 'true' : 'false'}}"
                                                   value="{{$project?->project_name}}" name="document" data-idx="3" id="inputFile" multiple type="file">
                                            @if($project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['utility_infrastructure_facilities_diagram']))
                                                <a target="_blank"
                                                   class="js-attachment-existing-assessment"
                                                   href="/preview?id={{$project->id}}&category={{$setting::FOLDER_TYPE['assessment']}}&file={{urlencode($project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['utility_infrastructure_facilities_diagram']))}}&dir={{$project->project_name}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$attachmentUtility}}
                                                </a>
                                            @endif
                                        </div>
                                        <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                                        <div class="js-error-file_size js-check-count-error text-danger"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @php($attachmentHazop = $project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['hazop_study']))
                                            <label>HAZOP Study <span class="text-danger f-w-550">*</span></label>
                                            <input class="form-control js-attachment-mandatory js-upload-attachment js-assessment-attachment_hazop_study col-md-10"
                                                   data-validated="{{isset($attachmentHazop) ? 'true' : 'false'}}"
                                                   value="{{$project?->project_name}}" name="document" id="inputFile" data-idx="4" multiple type="file">
                                            @if($project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['hazop_study']))
                                                <a target="_blank"
                                                   class="js-attachment-existing-assessment"
                                                   href="/preview?id={{$project->id}}&category={{$setting::FOLDER_TYPE['assessment']}}&file={{urlencode($project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['hazop_study']))}}&dir={{$project->project_name}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$attachmentHazop}}
                                                </a>
                                            @endif
                                        </div>
                                        <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                                        <div class="js-error-file_size js-check-count-error text-danger"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @php($assessmentMOC = $project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['moc_document']))
                                            <label>MOC Document <span class="text-danger f-w-550">*</span></label>
                                            <input class="form-control js-attachment-mandatory js-upload-attachment js-assessment-attachment_moc_document col-md-10"
                                                   data-validated="{{isset($assessmentMOC) ? 'true' : 'false'}}"
                                                   value="{{$project?->project_name}}" name="document" id="inputFile" data-idx="5" multiple type="file">
                                            @if($project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['moc_document']))
                                                <a target="_blank"
                                                   class="js-attachment-existing-assessment"
                                                   href="/preview?id={{$project->id}}&category={{$setting::FOLDER_TYPE['assessment']}}&file={{urlencode($project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['moc_document']))}}&dir={{$project->project_name}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$assessmentMOC}}
                                                </a>
                                            @endif
                                        </div>
                                        <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                                        <div class="js-error-file_size js-check-count-error text-danger"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @php($attachmentCostEstimate = $project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['cost_estimate_with_rough_of_magnitude']))
                                            <label>Cost Estimate with rough of magnitude 15-20% <span class="text-danger f-w-550">*</span></label>
                                            <input class="form-control js-attachment-mandatory js-upload-attachment js-assessment-attachment_cost_estimate_with_rough_of_magnitude col-md-10"
                                                   data-validated="{{isset($attachmentCostEstimate) ? 'true' : 'false'}}"
                                                   value="{{$project?->project_name}}" data-idx="6" name="document" id="inputFile" multiple type="file">
                                            @if($project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['cost_estimate_with_rough_of_magnitude']))
                                                <a target="_blank"
                                                   class="js-attachment-existing-assessment"
                                                   href="/preview?id={{$project->id}}&category={{$setting::FOLDER_TYPE['assessment']}}&file={{urlencode($project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['cost_estimate_with_rough_of_magnitude']))}}&dir={{$project->project_name}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$attachmentCostEstimate}}
                                                </a>
                                            @endif
                                        </div>
                                        <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                                        <div class="js-error-file_size js-check-count-error text-danger"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @php($attachmentQuotationEquipment = $project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['quotation_of_equipment']))
                                            <label>Quotation of Equipment <span class="text-danger f-w-550">*</span></label>
                                            <input class="form-control js-attachment-mandatory js-upload-attachment js-assessment-attachment_quotation_of_equipment col-md-10"
                                                   data-validated="{{isset($attachmentQuotationEquipment) ? 'true' : 'false'}}"
                                                   value="{{$project?->project_name}}" name="document" data-idx="7" id="inputFile" multiple type="file">
                                            @if($project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['quotation_of_equipment']))
                                                <a target="_blank"
                                                   class="js-attachment-existing-assessment"
                                                   href="/preview?id={{$project->id}}&category={{$setting::FOLDER_TYPE['assessment']}}&file={{urlencode($project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['quotation_of_equipment']))}}&dir={{$project->project_name}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$attachmentQuotationEquipment}}
                                                </a>
                                            @endif
                                        </div>
                                        <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                                        <div class="js-error-file_size js-check-count-error text-danger"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @php($attachmentAssessment = $project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['project_assessment_level']))
                                            <label>Project Assessment Level <span class="text-danger f-w-550">*</span></label>
                                            <input class="form-control js-attachment-mandatory js-upload-attachment js-assessment-attachment_project_assessment_level col-md-10"
                                                   data-validated="{{isset($attachmentAssessment) ? 'true' : 'false'}}"
                                                   value="{{$project?->project_name}}" name="document" data-idx="8" id="inputFile" multiple type="file">
                                            @if($project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['project_assessment_level']))
                                                <a target="_blank"
                                                   class="js-attachment-existing-assessment"
                                                   href="/preview?id={{$project->id}}&category={{$setting::FOLDER_TYPE['assessment']}}&file={{urlencode($project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['project_assessment_level']))}}&dir={{$project->project_name}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$attachmentAssessment}}
                                                </a>
                                            @endif
                                        </div>
                                        <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                                        <div class="js-error-file_size js-check-count-error text-danger"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @php($attachmentFel1 = $project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['fel1']))
                                            <label>FEL 1 <span class="text-danger f-w-550">*</span></label>
                                            <input class="form-control js-attachment-mandatory js-mandatory-conditional-attachment  js-upload-attachment js-assessment-attachment_fel1 col-md-10"
                                                   data-validated="{{isset($attachmentFel1) ? 'true' : 'false'}}"
                                                   value="{{$project?->project_name}}" name="document" id="inputFile" data-idx="9" multiple type="file">
                                            @if($project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['fel1']))
                                                <a target="_blank"
                                                   class="js-attachment-existing-assessment"
                                                   href="/preview?id={{$project->id}}&category={{$setting::FOLDER_TYPE['assessment']}}&file={{urlencode($project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['fel1']))}}&dir={{$project->project_name}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$attachmentFel1}}
                                                </a>
                                            @endif
                                        </div>
                                        <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                                        <div class="js-error-file_size js-check-count-error text-danger"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @php($attachmentFel2 = $project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['fel2']))
                                            <label>FEL 2 <span class="text-danger f-w-550">*</span></label>
                                            <input class="form-control js-attachment-mandatory js-mandatory-conditional-attachment js-upload-attachment js-assessment-attachment_fel2 col-md-10"
                                                   data-validated="{{isset($attachmentFel2) ? 'true' : 'false'}}"
                                                   value="{{$project?->project_name}}" name="document" id="inputFile" data-idx="10" multiple type="file">
                                            @if($project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['fel2']))
                                                <a target="_blank"
                                                   class="js-attachment-existing-assessment"
                                                   href="/preview?id={{$project->id}}&category={{$setting::FOLDER_TYPE['assessment']}}&file={{urlencode($project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['fel2']))}}&dir={{$project->project_name}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$attachmentFel2}}
                                                </a>
                                            @endif
                                        </div>
                                        <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                                        <div class="js-error-file_size js-check-count-error text-danger"></div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <div class="row">
                    <div class="col-md-12 mb-3 padding-right-0">
                        <label class="float-start"> Location (Location of Asset Capitalization) <span class="text-danger f-w-550">*</span> </label>
                    </div>
                    <div class="col-md-12">
                        <div class="table table-hover">
                            <table>
                                <thead>
                                <th>
                                    Area
                                </th>
                                <th>Cost Center</th>
                                <th></th>
                                </thead>
                                <tbody class="js-row-area-capitalization">
                                @if($isEdit && $project->assessment?->getAllAreaAssetCapitalization() > 0)
                                    @foreach($project->assessment?->getAllAreaAssetCapitalization() as $area)
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control js-form-area" value="{{$area->area}}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control js-form-cost-center" value="{{$area->cost_center}}">
                                            </td>
                                            <td>
                                                <i class="fa fa-plus-circle cursor-pointer js-add-location-area-capitalization"></i>
                                                <i class="fa fa-times-circle m-l-2 text-danger cursor-pointer js-delete-location-area-capitalization"></i>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control js-form-area">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control js-form-cost-center">
                                        </td>
                                        <td>
                                            <i class="fa fa-plus-circle cursor-pointer js-add-location-area-capitalization"></i>
                                            <i class="fa fa-times-circle m-l-2 text-danger cursor-pointer js-delete-location-area-capitalization"></i>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="row">
    <input type="hidden" name="validate_check_empty_count" class="js-validate-checkbox-count">
</div>
