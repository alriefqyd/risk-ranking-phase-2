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
                    <input class="form-control cold-md-12" type="number"
                           value="{{$project?->assessment?->cost_estimate_text}}"
                           aria-label="Amount (to the nearest dollar)"><span class="input-group-text">.00  </span>
                </div>
            </td>
        </tr>
        <tr>
            <td>Assessment of Level Project :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-level"
                           {{$project?->assessment?->level_project == 1 ? 'checked' : ''}}
                           class="js-checkbox-assessment" type="checkbox">
                    <label for="checkbox-level"></label>
                </div>
            </td>
            <td>
                <small>(According to cost estimate $ …… and complexity score…….., that this categorize as (Complex/Moderate/Light) project). </small>
                <textarea class="tinymce js-text-level"
                    {!! $project?->assessment?->level_project != 1 ? 'style="display: none"' : '' !!}>
                    {{$project?->assessment?->level_project_text}}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_level">
                <div class="col-md-12 txt-danger js-error-message"></div>
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
            <td>Complexity Score Assessment :</td>
            <td style="width: 100px">

            </td>
            <td>
                <small>(According to complexity assessment, this project has score ……).</small>
                <div class="js-select2">
                    <select class="select2 js-select-score" style="width: 100%" name="complexity_score_assessment">
                        @foreach($complexityScore as $key => $value)
                            <option {{(old('complexity_score_assessment') == $value ||
                            $project?->assessment?->complexity_score_assessment == $value
                            ? "selected" : "" )}} value="{{$value}}">{{$value}}</option>
                        @endforeach
                    </select>
                    <div class="col-md-12 txt-danger js-error-message"></div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div class="row">

</div>
