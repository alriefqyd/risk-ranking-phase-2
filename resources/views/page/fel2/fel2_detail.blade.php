<div class="row js-form-project-detail m-b-30 {{!$errors->any() ? '' : 'd-none'}}">
    @if($project?->fel2)
        <div class="table-responsive">
            <table class="table table-striped js-table-assessment">
                <tbody>
                <tr>
                    <td style="width: 200px">Project Scope : </td>
                    <td style="width: 100px">{!! $project->getCheckTemplate($project?->fel2?->project_scope) !!}</td>
                </tr>
                <tr>
                    <td>Identify Main Equipment  : </td>
                    <td>{!! $project->getCheckTemplate($project?->fel2?->identify_main_equipment) !!}</td>
                </tr>
                <tr>
                    <td>Boundary and Assumption</td>
                    <td>{!! $project->getCheckTemplate($project?->fel2?->boundary_and_assumption) !!}</td>
                </tr>
                <tr>
                    <td>Analysis of Option :</td>
                    <td>{!! $project->getCheckTemplate($project?->fel2?->analysis_of_option) !!}</td>
                </tr>
                <tr>
                    <td>Permit List :</td>
                    <td>{!! $project->getCheckTemplate($project?->fel2?->permit_list) !!}</td>
                </tr>
                <tr>
                    <td>Schedule Project :</td>
                    <td>{!! $project->getCheckTemplate($project?->fel2?->schedule_project) !!}</td>
                </tr>
                <tr>
                    <td>Cost Estimate :</td>
                    <td>{!! $project->getCheckTemplate($project?->fel2?->cost_estimate) !!}</td>
                </tr>
                <tr>
                    <td>Status :</td>
                    <td>{{$project?->fel2?->status}}</td>
                </tr>

                </tbody>
            </table>
        </div>
    @else
        <div class="text-center">
            No Data Fel 2
        </div>
    @endif
</div>
