@inject('setting',App\Models\Setting::class)
<div class="table-responsive">
    <input type="hidden" class="js-project-id" value="{{$project->id}}">
    <table class="table table-striped js-table-assessment">
        <tbody>
        <tr>
            <td>Problem Statement : </td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-problem-statement"
                           {{$project?->assessment?->problems_statement == 1 ? 'checked' : ''}}
                           class="js-checkbox-assessment" type="checkbox">
                    <label for="checkbox-problem-statement"></label>
                </div>
            </td>
            <td style="width: 69%">
                <small>(Provide a description of problems, restrictions, constraints. At this document should not be a description of a solution).</small>
                <textarea class="tinymce js-text-problem-statement"
                          name="problem_statement"
                          {!! $project?->assessment?->problems_statement != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->assessment?->problem_statement_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_problem_statement">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Objective : </td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-objective"
                           {{$project?->assessment?->objective == 1 ? 'checked' : ''}}
                           class="js-checkbox-assessment" type="checkbox">
                    <label for="checkbox-objective"></label>
                </div>
            </td>
            <td>
                <small>(It is necessary to identify the overall reason for the initiative by relating it to one or more objectives of the organization that need to achieve).</small>
                <textarea class="tinymce js-text-objective" name="objective"
                {!! $project?->assessment?->objective != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->assessment?->objective_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_objective">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Project Scope : </td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-project-scope"
                           {{$project?->assessment?->project_scope == 1 ? 'checked' : ''}}
                           class="js-checkbox-assessment" type="checkbox">
                    <label for="checkbox-project-scope"></label>
                </div>
            </td>
            <td>
                <small>(According to problem that has and objective that would to achieve, please mentioned what scope that this project need to cover).</small>
                <textarea class="tinymce js-text-project-scope"
                {!! $project?->assessment?->project_scope != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->assessment?->project_scope_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_project_scope">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Key Performance Metric :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-kpm"
                           {{$project?->assessment?->key_performance_metric == 1 ? 'checked' : ''}}
                           class="js-checkbox-assessment" type="checkbox">
                    <label for="checkbox-kpm"></label>
                </div>
            </td>
            <td>
                <small>Key performance indicator assumption before and after investment, justification for proposed budget</small>
                <textarea class="tinymce js-key-performance"
                {!! $project?->assessment?->key_performance_metric != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->assessment?->key_performance_metric_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_kpm">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Key Project Risk Mitigants :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-prm"
                           {{$project?->assessment?->key_project_risk_mitigants == 1 ? 'checked' : ''}}
                           class="js-checkbox-assessment" type="checkbox">
                    <label for="checkbox-prm"></label>
                </div>
            </td>
            <td>
                <small>List top 5 project risks, and where applicable the mitigation measures required</small>
                <textarea class="tinymce js-key-project-risk"
                {!! $project?->assessment?->key_project_risk_mitigants != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->assessment?->key_project_risk_and_mitigants_text !!}

                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_prm">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Impact If <br/>Not Executed :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-iie"
                           {{$project?->assessment?->impact_if_not_executed == 1 ? 'checked' : ''}}
                           class="js-checkbox-assessment" type="checkbox">
                    <label for="checkbox-iie"></label>
                </div>
            </td>
            <td>
                <small>What is the likely consequence of not executing on this capital item</small>
                <textarea class="tinymce js-impact"
                {!! $project?->assessment?->impact_if_not_executed != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->assessment?->impact_if_not_executed_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_iie">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Alternative To <br/>Proposal :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-alternative"
                           {{$project?->assessment?->alternative_to_proposal == 1 ? 'checked' : ''}}
                           class="js-checkbox-assessment" type="checkbox">
                    <label for="checkbox-alternative"></label>
                </div>
            </td>
            <td>
                <small>Discuss the next best alternative to the proposed spend (if applicable)</small>
                <textarea class="tinymce js-alternative"
                    {!! $project?->assessment?->alternative_to_proposal != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->assessment?->alternatives_to_proposal_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_alternative">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Cost Estimate</td>
            <td>
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-cost-estimate"
                           class="js-checkbox-assessment"
                           {{$project?->assessment?->cost_estimate == 1 ? 'checked' : ''}}
                    type="checkbox">
                    <label for="checkbox-cost-estimate"></label>
                </div>
            </td>
            <td>
                <small>(Develop rough cost estimate or reference (from similar project is acceptable) for assessment of complexity level).</small>
                <div class="input-group mb-3 js-cost-estimate
                    {{$project?->assessment?->cost_estimate == 0 ? 'd-none' : ''}}"
                ><span class="input-group-text">$  </span>
                    <input class="form-control js-cost_estimate_assessment cold-md-12" type="number"
                           value="{{$project?->assessment?->cost_estimate_text}}"
                           aria-label="Amount (to the nearest dollar)"><span class="input-group-text">.00  </span>
                </div>
            </td>
        </tr>
        <tr>
            <td>Detail Estimate Cost :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-detail-estimate"
                           {{$project?->assessment?->detail_estimate_cost == 1 ? 'checked' : ''}}
                           class="js-checkbox-assessment" type="checkbox">

                    <label for="checkbox-detail-estimate"></label>
                </div>
            </td>
            <td>
                <textarea class="tinymce js-text-detail-cost"
                    {!! $project?->assessment?->detail_estimate_cost != 1 ? 'style="display: none"' : '' !!}>
                        {{$project?->assessment?->detail_estimate_cost_text}}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_detail_estimate">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Complexity Score :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-level"
                           {{$project?->assessment?->level_project == 1 ? 'checked' : ''}}
                           class="js-checkbox-assessment" type="checkbox">
                    <label for="checkbox-level"></label>
                </div>
            </td>
            <td>
                <small>(According to complexity assessment, this project has score ……).</small>
                {{--<textarea class="tinymce js-text-level"
                    {!! $project?->assessment?->level_project != 1 ? 'style="display: none"' : '' !!}>
                    {{$project?->assessment?->level_project_text}}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_level">
                <div class="col-md-12 txt-danger js-error-message"></div>--}}
                <div class="js-complexity-analysis-head
                    {!! $project?->assessment?->level_project != 1 ? 'd-none' : '' !!}">
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
                    <input type="hidden" name="score" value="{{$project?->assessment?->complexity_score_assessment}}" class="js-complexity-score-label-val">
                    <input type="hidden" name="complexity_analysis_type" value="{{$project?->assessment?->complexity_analysis_type}}" class="js-complexity-label-val">
                    Score : <span class="js-complexity-score-label">{{$project?->assessment?->complexity_score_assessment}}</span></br>
                    Complexity : <span class="js-complexity-label">{{$project?->assessment?->complexity_analysis_type}}</span>
                </div>
            </td>
        </tr>
        <tr>
            <td>Assessment of Level Project :</td>
            <td style="width: 100px">

            </td>
            <td>
                <small>(According to cost estimate $ <span class="text-danger js-cost-estimate-label-assessment">
                        {{$project?->assessment?->cost_estimate_text}}
                    </span> and complexity score
                    <span class="text-danger js-complexity-score-label-assessment">
                        {{$project?->assessment?->complexity_score_assessment}}
                    </span> , that this categorize as
                    <span class="text-danger text-large-custom js-assessment-level-status-auto">{{$project?->assessment?->level_project_text}}</span> project). </small>
                <div class="js-select2">
                    <input type="hidden" class="form-control js-select-score" style="width: 100%" name="complexity_score_assessment">
                    <div class="col-md-12 txt-danger js-error-message"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                Attachment File
            </td>
            <td>

            </td>
            <td>
                <div class="row">
                    <div class="col-md-12">
                        <label>Initial Cost Estimate : </label>
                        <input class="form-control js-assessment-attachment_initial_cost_estimate col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['initial_cost_estimate']))
                            <a target="_blank"
                               href="/preview?dir={{$project->project_name}}&file={{$project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['initial_cost_estimate'])}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['initial_cost_estimate'])}}
                            </a>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label>Complexity Matrix :</label>
                        <input class="form-control js-assessment-attachment_complexity_matrix col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['complexity_matrix']))
                            <a target="_blank"
                               href="/preview?dir={{$project->project_name}}&file={{$project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['complexity_matrix'])}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['complexity_matrix'])}}
                            </a>
                        @endif
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div class="row">

</div>
