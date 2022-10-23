<div class="row js-form-project-detail m-b-30 {{!$errors->any() ? '' : 'd-none'}}">
    @if($project?->fel1)
        <div class="table-responsive">
            <table class="table table-striped js-table-assessment">
                <tbody>
                <tr>
                    <td style="width: 200px">Project Scope : </td>
                    <td style="width: 100px">{!! $project->getCheckTemplate($project?->fel1?->project_scope) !!}</td>
                </tr>
                <tr>
                    <td>Identified Parameter, <br> Requirement & Regulation  : </td>
                    <td>{!! $project->getCheckTemplate($project?->fel1?->identified_parameter_requirement_regulation) !!}</td>
                </tr>
                <tr>
                    <td>Alternative : </td>
                    <td>{!! $project->getCheckTemplate($project?->fel1?->alternatives) !!}</td>
                </tr>
                <tr>
                    <td>List Of Stakeholder :</td>
                    <td>{!! $project->getCheckTemplate($project?->fel1?->list_of_stakeholder) !!}</td>
                </tr>
                <tr>
                    <td>Schedule Project :</td>
                    <td>{!! $project->getCheckTemplate($project?->fel1?->schedule_project) !!}</td>
                </tr>
                <tr>
                    <td>Status :</td>
                    <td>{{$project?->fel1?->status}}</td>
                </tr>

                </tbody>
            </table>
        </div>
    @else
        <div class="text-center">
            No Data Fel 1
        </div>
    @endif
</div>
