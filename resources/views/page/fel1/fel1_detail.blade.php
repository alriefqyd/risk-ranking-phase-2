<div class="row js-form-project-detail m-b-30 {{!$errors->any() ? '' : 'd-none'}}">
    @if($project?->fel1)
        <div class="table-responsive">
            <table class="table table-striped js-table-assessment">
                <tbody>
                <tr>
                    <td style="width: 10px">Project Scope : </td>
                    <td style="width: 10px">{!! $project->getCheckTemplate($project?->fel1?->project_scope) !!}</td>
                    <td style="width: 270px">{!! $project?->fel1?->project_scope_text !!}</td>
                </tr>
                <tr>
                    <td>Identified Parameter, <br> Requirement & Regulation  : </td>
                    <td>{!! $project->getCheckTemplate($project?->fel1?->identified_parameter_requirement_regulation) !!}</td>
                    <td>{!! $project?->fel1?->identified_parameter_requirement_regulation_text !!}</td>
                </tr>
                <tr>
                    <td>Alternative : </td>
                    <td>{!! $project->getCheckTemplate($project?->fel1?->alternatives) !!}</td>
                    <td>{!!$project?->fel1?->alternatives_text !!}</td>
                </tr>
                <tr>
                    <td>List Of Stakeholder :</td>
                    <td>{!! $project->getCheckTemplate($project?->fel1?->list_of_stakeholder) !!}</td>
                    <td>{!! $project?->fel1?->list_of_stakeholder_text !!}</td>
                </tr>
                <tr>
                    <td>Schedule Project :</td>
                    <td>{!! $project->getCheckTemplate($project?->fel1?->schedule_project) !!}</td>
                    <td>{!! $project?->fel1?->schedule_project_text !!}</td>
                </tr>
                <tr>
                    <td>Status :</td>
                    <td></td>
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
