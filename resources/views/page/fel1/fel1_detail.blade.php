@inject('setting',App\Models\Setting::class)
<div class="row js-form-project-detail m-b-30 {{!$errors->any() ? '' : 'd-none'}}">
    @if($project?->fel1)
        <div class="table-responsive">
            <table class="table table-striped js-table-assessment">
                <tbody>
                <tr>
                    <td style="width: 15%">Project Scope : </td>
                    <td style="width: 10%">{!! $project->getCheckTemplate($project?->fel1?->project_scope) !!}</td>
                    <td style="width: 75%">{!! $project?->fel1?->project_scope_text !!}</td>
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
                <td>Attachment List</td>
                <td>
                    {!! $project?->getCheckTemplate($project?->fel1?->attachment ? 1 : 0) !!}
                </td>
                <td>
                    <table>
                        <tr>
                            <td style="width: 50%">
                                <p class="m-b-0">Parameter, Regulation, Requirement</p>
                            </td>
                            <td style="width: 50%">
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
                            <td style="width: 50%">
                                <p class="m-b-0">Initial Process Diagram (Alur)</p>
                            </td>
                            <td style="width: 50%">
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
                                <p class="m-b-0">Data of alternatives (drawing/figure, cost of investment & operation, maintenance, etc.)</p>
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
                                <p class="m-b-0">Initial schedule until level 1</p>
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
                                <p class="m-b-0">Project level assessment</p>
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
                               <p class="m-b-0">Stakeholder list</p>
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
                </td>
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center">
            No Data Fel 1
        </div>
    @endif
</div>
