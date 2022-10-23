<div class="table-responsive">
    <input type="hidden" class="js-project-id" value="{{$project->id}}">
    <table class="table table-striped js-table-assessment">
        <tbody>
        <tr>
            <td style="width: 200px">Project Scope Statement : </td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-project_scope"
                           {{$project?->fel1?->project_scope == 1 ? 'checked' : ''}}
                           name="project_scope" class="js-checkbox-fel1" type="checkbox">
                    <label for="checkbox-project_scope"></label>
                </div>
            </td>
        </tr>
        <tr>
            <td>Identified Parameter, <br>Requirement & Regulation : </td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-identified_parameter"
                           {{$project?->fel1?->identified_parameter_requirement_regulation == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel1" type="checkbox">
                    <label for="checkbox-identified_parameter"></label>
                </div>
            </td>
        </tr>
        <tr>
            <td>Alternatives : </td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-alternatives"
                           {{$project?->fel1?->alternatives == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel1" type="checkbox">
                    <label for="checkbox-alternatives"></label>
                </div>
            </td>
        </tr>
        <tr>
            <td>List of Stakeholder :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-list_of_stakeholder"
                           {{$project?->fel1?->list_of_stakeholder == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel1" type="checkbox">
                    <label for="checkbox-list_of_stakeholder"></label>
                </div>
            </td>
        </tr>
        <tr>
            <td>Schedule Project :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-schedule"
                           {{$project?->fel1?->schedule_project == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel1" type="checkbox">
                    <label for="checkbox-schedule"></label>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div class="row">

</div>
