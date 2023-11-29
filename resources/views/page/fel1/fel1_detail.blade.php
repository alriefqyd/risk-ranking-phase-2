@inject('setting',App\Models\Setting::class)
<div class="row js-form-project-detail m-b-30 {{!$errors->any() ? '' : 'd-none'}}">
    @if($project?->fel1)
        <div class="table-responsive">
            <table class="table table-striped js-table-assessment">
                <tbody>

                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Project Scope :</label>
                            </div>
                            <div class="col-md-8 float-start">
                                {!! $project->getCheckTemplate($project?->fel1?->project_scope) !!}
                            </div>
                            <div class="col-md-12">
                                {!! $project?->fel1?->project_scope_text !!}
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Status :</label>
                            </div>
                            <div class="col-md-8 float-start">

                            </div>
                            <div class="col-md-12">
                                {{$project?->fel1?->status}}
                            </div>
                        </div>
                    </td>
                </tr>


                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Attachment List :</label>
                            </div>
                            <div class="col-md-8 float-start">
                                {!! $project?->getCheckTemplate($project?->fel1?->attachment ? 1 : 0) !!}
                            </div>
                            <div class="col-md-12">
                                <table style="width: 100%">
                                    <tr>
                                        <td>
                                            Parameter, Regulation, Requirement :
                                        </td>
                                        <td>
                                            @if($project?->getAllAttachment($project->fel1?->attachment, $setting::FEL1_ATTACHMENT['parameter_regulation_requirement']))
                                                <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel1']}}&file={{urlencode($project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['parameter_regulation_requirement']))}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['parameter_regulation_requirement'])}}
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Initial Process Diagram (Alur)
                                        </td>
                                        <td>
                                            @if($project?->getAllAttachment($project->fel1?->attachment, $setting::FEL1_ATTACHMENT['initial_process_diagram']))
                                                <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel1']}}&file={{urlencode($project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['initial_process_diagram']))}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['initial_process_diagram'])}}
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Data of alternatives (drawing/figure, cost of investment & operation, maintenance, etc.) :
                                        </td>
                                        <td>
                                            @if($project?->getAllAttachment($project->fel1?->attachment, $setting::FEL1_ATTACHMENT['data_of_alternatives']))
                                                <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel1']}}&file={{urlencode($project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['data_of_alternatives']))}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['data_of_alternatives'])}}
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Initial schedule until level 1 :
                                        </td>
                                        <td>
                                            @if($project?->getAllAttachment($project->fel1?->attachment, $setting::FEL1_ATTACHMENT['initial_schedule']))
                                                <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel1']}}&file={{urlencode($project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['initial_schedule']))}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['initial_schedule'])}}
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Project level assessment :
                                        </td>
                                        <td>
                                            @if($project?->getAllAttachment($project->fel1?->attachment, $setting::FEL1_ATTACHMENT['project_level_assessment']))
                                                <a target="_blank" href="/preview?id={{$project->id}}&category={{$setting::FOLDER_TYPE['fel1']}}&file={{urlencode($project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['project_level_assessment']))}}&dir={{urlencode($project->project_name)}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['project_level_assessment'])}}
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Stakeholder list :
                                        </td>
                                        <td>
                                            @if($project?->getAllAttachment($project->fel1?->attachment, $setting::FEL1_ATTACHMENT['stakeholder_list']))
                                                <a target="_blank" href="/preview?id={{$project->id}}&category={{$setting::FOLDER_TYPE['fel1']}}&file={{urlencode($project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['stakeholder_list']))}}&dir={{urlencode($project->project_name)}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['stakeholder_list'])}}
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </td>
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
