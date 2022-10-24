<div class="row js-form-project-detail m-b-30 {{!$errors->any() ? '' : 'd-none'}}">
    @if($project?->fel3)
        <div class="table-responsive">
            <table class="table table-striped js-table-assessment">
                <tbody>
                <tr>
                    <td style="width: 200px">Executive Summary  : </td>
                    <td style="width: 100px">{!! $project->getCheckTemplate($project?->fel3?->executive_summary) !!}</td>
                </tr>
                <tr>
                    <td>Problem Statement</td>
                    <td>{!! $project->getCheckTemplate($project?->fel3?->problem_statement) !!}</td>
                </tr>
                <tr>
                    <td>Project Scope :</td>
                    <td>{!! $project->getCheckTemplate($project?->fel3?->project_scope) !!}</td>
                </tr>
                <tr>
                    <td>Alternatives And Best Option :</td>
                    <td>{!! $project->getCheckTemplate($project?->fel3?->alternatives_and_best_option) !!}</td>
                </tr>
                <tr>
                    <td>Project Schedule :</td>
                    <td>{!! $project->getCheckTemplate($project?->fel3?->project_schedule) !!}</td>
                </tr>
                <tr>
                    <td>List Of Equipment And Specification :</td>
                    <td>{!! $project->getCheckTemplate($project?->fel3?->list_of_equipment_and_specification) !!}</td>
                </tr>
                <tr>
                    <td>HAZOP Study :</td>
                    <td>{!! $project->getCheckTemplate($project?->fel3?->hazop_study) !!}</td>
                </tr>
                <tr>
                    <td>Cost Estimate :</td>
                    <td>{!! $project->getCheckTemplate($project?->fel3?->cost_estimate) !!}</td>
                </tr>
                <tr>
                    <td>Status :</td>
                    <td>{{ $project?->fel3?->status }}</td>
                </tr>

                </tbody>
            </table>
        </div>
    @else
        <div class="text-center">
            No Data Fel 3
        </div>
    @endif
</div>
