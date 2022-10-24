<div class="table-responsive">
    <input type="hidden" class="js-project-id" value="{{$project->id}}">
    <table class="table table-striped js-table-assessment">
        <tbody>
        <tr>
            <td style="width: 200px">Executive Summary : </td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-executive_summary"
                           {{$project?->fel3?->executive_summary == 1 ? 'checked' : ''}}
                           name="project_scope" class="js-checkbox-fel3" type="checkbox">
                    <label for="checkbox-executive_summary"></label>
                </div>
            </td>
        </tr>
        <tr>
            <td>Problem Statement </td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-problem_statement_fel3"
                           {{$project?->fel3?->problem_statement == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel3" type="checkbox">
                    <label for="checkbox-problem_statement_fel3"></label>
                </div>
            </td>
        </tr>
        <tr>
            <td>Project Scope  : </td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-project_scope_fel_3"
                           {{$project?->fel3?->project_scope == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel3" type="checkbox">
                    <label for="checkbox-project_scope_fel_3"></label>
                </div>
            </td>
        </tr>
        <tr>
            <td>Alternatives And Best Option :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-alternatives_best_option"
                           {{$project?->fel3?->alternatives_and_best_option == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel3" type="checkbox">
                    <label for="checkbox-alternatives_best_option"></label>
                </div>
            </td>
        </tr>
        <tr>
            <td>Project Schedule :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-project_schedule_fel_3"
                           {{$project?->fel3?->project_schedule == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel3" type="checkbox">
                    <label for="checkbox-project_schedule_fel_3"></label>
                </div>
            </td>
        </tr>
        <tr>
            <td>List Of Equipment And Specification :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-list_of_equipment"
                           {{$project?->fel3?->list_of_equipment_and_specification == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel3" type="checkbox">
                    <label for="checkbox-list_of_equipment"></label>
                </div>
            </td>
        </tr>
        <tr>
            <td>HAZOP Study :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-hazop"
                           {{$project?->fel3?->hazop_study == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel3" type="checkbox">
                    <label for="checkbox-hazop"></label>
                </div>
            </td>
        </tr>
        <tr>
            <td>Cost Estimate :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-cost_estimate_fel3"
                           {{$project?->fel3?->cost_estimate == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel3" type="checkbox">
                    <label for="checkbox-cost_estimate_fel3"></label>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div class="row">

</div>
