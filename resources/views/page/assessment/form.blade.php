<div class="table-responsive">
    <input type="hidden" class="js-project-id" value="{{$project->id}}">
    <table class="table table-striped js-table-assessment">
        <tbody>
        <tr>
            <td style="width: 200px">Problem Statement : </td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-problem-statement" name="problem_statement" class="js-checkbox-assessment" type="checkbox">
                    <label for="checkbox-problem-statement"></label>
                </div>
            </td>
            <td style="max-width: 100%">
                <div class="froala js-text-problem-statement d-none"></div>
                <input type="hidden" class="js-hidden-validate" name="validate_problem_statement">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Objective : </td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-objective" class="js-checkbox-assessment" type="checkbox">
                    <label for="checkbox-objective"></label>
                </div>
            </td>
            <td>
                <div class="froala js-text-objective d-none"></div>
                <input type="hidden" class="js-hidden-validate" name="validate_objective">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Project Scope : </td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-project-scope" class="js-checkbox-assessment" type="checkbox">
                    <label for="checkbox-project-scope"></label>
                </div>
            </td>
            <td>
                <div class="froala js-text-project-scope d-none"></div>
                <input type="hidden" class="js-hidden-validate" name="validate_project_scope">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Key Performance Metric :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-kpm" class="js-checkbox-assessment" type="checkbox">
                    <label for="checkbox-kpm"></label>
                </div>
            </td>
            <td>
                <div class="froala js-key-performance d-none"></div>
                <input type="hidden" class="js-hidden-validate" name="validate_kpm">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Key Project Risk Mitigants :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-prm" class="js-checkbox-assessment" type="checkbox">
                    <label for="checkbox-prm"></label>
                </div>
            </td>
            <td>
                <div class="froala js-key-project-risk d-none"></div>
                <input type="hidden" class="js-hidden-validate" name="validate_prm">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Impact If <br/>Not Executed :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-iie" class="js-checkbox-assessment" type="checkbox">
                    <label for="checkbox-iie"></label>
                </div>
            </td>
            <td>
                <div class="froala js-impact d-none"></div>
                <input type="hidden" class="js-hidden-validate" name="validate_iie">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Alternative To <br/>Proposal :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-alternative" class="js-checkbox-assessment" type="checkbox">
                    <label for="checkbox-alternative"></label>
                </div>
            </td>
            <td>
                <div class="froala js-alternative d-none"></div>
                <input type="hidden" class="js-hidden-validate" name="validate_alternative">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Cost Estimate :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-cost-estimate" class="js-checkbox-assessment" type="checkbox">
                    <label for="checkbox-cost-estimate"></label>
                </div>
            </td>
            <td>
                <div class="froala js-cost-estimate d-none"></div>
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
                            <option {{(old('complexity_score_assessment') == $value ? "selected" : "" )}} value="{{$value}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <td>Level Project :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-level" class="js-checkbox-assessment" type="checkbox">
                    <label for="checkbox-level"></label>
                </div>
            </td>
            <td>
                <div class="froala js-text-level d-none"></div>
                <input type="hidden" class="js-hidden-validate" name="validate_level">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Detail Estimate Cost :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-detail-estimate" class="js-checkbox-assessment" type="checkbox">

                    <label for="checkbox-detail-estimate"></label>
                </div>
            </td>
            <td>
                <div class="froala js-text-detail-cost d-none"></div>
                <input type="hidden" class="js-hidden-validate" name="validate_detail_estimate">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div class="row">

</div>
