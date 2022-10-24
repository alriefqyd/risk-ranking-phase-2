<div class="table-responsive">
    <input type="hidden" class="js-project-id" value="{{$project->id}}">
    <table class="table table-striped js-table-assessment">
        <tbody>
        <tr>
            <td style="width: 200px">Project Scope : </td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-project_scope-fel2"
                           {{$project?->fel2?->project_scope == 1 ? 'checked' : ''}}
                           name="project_scope" class="js-checkbox-fel2" type="checkbox">
                    <label for="checkbox-project_scope-fel2"></label>
                </div>
            </td>
        </tr>
        <tr>
            <td>Identify Main Equipment </td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-identify_main_equipment"
                           {{$project?->fel2?->identify_main_equipment == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel2" type="checkbox">
                    <label for="checkbox-identify_main_equipment"></label>
                </div>
            </td>
        </tr>
        <tr>
            <td>Boundary & Assumption : </td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-boundary_assumption"
                           {{$project?->fel2?->boundary_and_assumption == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel2" type="checkbox">
                    <label for="checkbox-boundary_assumption"></label>
                </div>
            </td>
        </tr>
        <tr>
            <td>Analysis of Option :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-analysis_of_option"
                           {{$project?->fel2?->analysis_of_option == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel2" type="checkbox">
                    <label for="checkbox-analysis_of_option"></label>
                </div>
            </td>
        </tr>
        <tr>
            <td>Permit List :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-permit_list"
                           {{$project?->fel2?->permit_list == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel2" type="checkbox">
                    <label for="checkbox-permit_list"></label>
                </div>
            </td>
        </tr>
        <tr>
            <td>Schedule Project :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-schedule_project"
                           {{$project?->fel2?->schedule_project == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel2" type="checkbox">
                    <label for="checkbox-schedule_project"></label>
                </div>
            </td>
        </tr>
        <tr>
            <td>Cost Estimate :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-cost_estimate"
                           {{$project?->fel2?->cost_estimate == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel2" type="checkbox">
                    <label for="checkbox-cost_estimate"></label>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div class="row">

</div>
