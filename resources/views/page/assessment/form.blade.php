<div class="table-responsive">
    <input type="hidden" class="js-project-id" value="{{$project->id}}">
    <table class="table table-striped js-table-assessment">
        <tbody>
        <tr>
            <td style="width: 200px">Problem Statement : </td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-problem-statement"
                           {{$project?->assessment?->problems_statement == 1 ? 'checked' : ''}}
                           name="problem_statement" class="js-checkbox-assessment" type="checkbox">
                    <label for="checkbox-problem-statement"></label>
                </div>
            </td>
            <td style="max-width: 100%">
                <div class="froala js-text-problem-statement
                {{$project?->assessment?->problems_statement != 1 ? 'd-none' : ''}}">
                    {!! $project?->assessment?->problem_statement_text !!}
                </div>
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
                <div class="froala js-text-objective
                {{$project?->assessment?->objective != 1 ? 'd-none' : ''}}">
                    {!! $project?->assessment?->objective_text !!}
                </div>
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
                <div class="froala js-text-project-scope
                {{$project?->assessment?->project_scope != 1 ? 'd-none' : ''}}">
                    {!! $project?->assessment?->project_scope_text !!}</div>
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
                <div class="froala js-key-performance
                {{$project?->assessment?->key_performance_metric != 1 ? 'd-none' : ''}}">
                    {!! $project?->assessment?->key_performance_metric_text !!}
                </div>
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
                <div class="froala js-key-project-risk
                {{$project?->assessment?->key_project_risk_mitigants != 1 ? 'd-none' : ''}}">
                    {!! $project?->assessment?->key_project_risk_and_mitigants_text !!}
                </div>
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
                <div class="froala js-impact
                {{$project?->assessment?->impact_if_not_executed != 1 ? 'd-none' : ''}}">
                    {!! $project?->assessment?->impact_if_not_executed_text !!}</div>
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
                <div class="froala js-alternative
                    {{$project?->assessment?->alternative_to_proposal != 1 ? 'd-none' : ''}}">
                    {!! $project?->assessment?->alternatives_to_proposal_text !!}</div>
                <input type="hidden" class="js-hidden-validate" name="validate_alternative">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Cost Estimate :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-cost-estimate"
                           {{$project?->assessment?->cost_estimate == 1 ? 'checked' : ''}}
                           class="js-checkbox-assessment" type="checkbox">
                    <label for="checkbox-cost-estimate"></label>
                </div>
            </td>
            <td>
                <div class="froala js-cost-estimate
                    {{$project?->assessment?->cost_estimate != 1 ? 'd-none' : ''}}">
                    {!! $project?->assessment?->cost_estimate_text !!}</div>
                <input type="hidden" class="js-hidden-validate" name="validate_cost_estimate">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Complexity Score Assessment :</td>
            <td style="width: 100px">

            </td>
            <td>
                <div class="js-select2">
                    <select class="select2 js-select-score" style="width: 100%" name="complexity_score_assessment">
                        @foreach($complexityScore as $key => $value)
                            <option {{(old('complexity_score_assessment') == $value ||
                            $project?->assessment?->complexity_score_assessment == $value
                            ? "selected" : "" )}} value="{{$value}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <td>Level Project :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-level"
                           {{$project?->assessment?->level_project == 1 ? 'checked' : ''}}
                           class="js-checkbox-assessment" type="checkbox">
                    <label for="checkbox-level"></label>
                </div>
            </td>
            <td>
                <div class="froala js-text-level
                    {{$project?->assessment?->level_project != 1 ? 'd-none' : ''}}">
                    {!! $project?->assessment?->level_project_text !!}</div>
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
                <div class="froala js-text-detail-cost
                    {{$project?->assessment?->detail_estimate_cost != 1 ? 'd-none' : ''}}">
                    {!! $project?->assessment?->detail_estimate_cost_text !!}</div>
                <input type="hidden" class="js-hidden-validate" name="validate_detail_estimate">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div class="row">

</div>
