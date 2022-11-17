@inject('setting',App\Models\Setting::class)
<div class="row js-form-project-detail m-b-30 {{!$errors->any() ? '' : 'd-none'}}">
    @if($project?->fel3)
        <div class="table-responsive">
            <table class="table table-striped js-table-assessment">
                <tbody>
                <tr>
                    <td style="width: 100px">Executive Summary  : </td>
                    <td style="width: 10px">{!! $project->getCheckTemplate($project?->fel3?->executive_summary) !!}</td>
                    <td style="width: 350px">{!! $project?->fel3?->executive_summary_text !!}</td>
                </tr>
                <tr>
                    <td>Problem Statement</td>
                    <td>{!! $project->getCheckTemplate($project?->fel3?->problem_statement) !!}</td>
                    <td>{!!$project?->fel3?->problem_statement_text !!}</td>
                </tr>
                <tr>
                    <td>Project Scope :</td>
                    <td>{!! $project->getCheckTemplate($project?->fel3?->project_scope) !!}</td>
                    <td>{!! $project?->fel3?->project_scope_text !!}</td>
                </tr>
                <tr>
                    <td>Alternatives And Best Option :</td>
                    <td>{!! $project->getCheckTemplate($project?->fel3?->alternatives_and_best_option) !!}</td>
                    <td>{!! $project?->fel3?->alternatives_and_best_option_text !!}</td>
                </tr>
                <tr>
                    <td>Project Schedule :</td>
                    <td>{!! $project->getCheckTemplate($project?->fel3?->project_schedule) !!}</td>
                    <td>{!! $project?->fel3?->project_schedule_text !!}</td>
                </tr>
                <tr>
                    <td>List Of Equipment And Specification :</td>
                    <td>{!! $project->getCheckTemplate($project?->fel3?->list_of_equipment_and_specification) !!}</td>
                    <td>{!! $project?->fel3?->list_of_equipment_and_specification_text !!}</td>
                </tr>
                <tr>
                    <td>HAZOP Study :</td>
                    <td>{!! $project->getCheckTemplate($project?->fel3?->hazop_study) !!}</td>
                    <td>{!! $project?->fel3?->hazop_study_text !!}</td>
                </tr>
                <tr>
                    <td>Cost Estimate :</td>
                    <td>{!! $project->getCheckTemplate($project?->fel3?->cost_estimate) !!}</td>
                    <td>{!! $project?->fel3?->cost_estimate_text !!}</td>
                </tr>
                <tr>
                    <td>Status :</td>
                    <td>{{ $project?->fel3?->status }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Attachment List</td>
                    <td>
                        {!! $project?->getCheckTemplate($project?->fel3?->attachment ? 1 : 0) !!}
                    </td>
                    <td>
                        <ul>
                            @if($project?->getAllAttachment($project->fel3?->attachment, $setting::FEL3_ATTACHMENT['preliminary_design']))
                                <li>
                                    <p class="m-b-0">Calculation/Reference of Capacity (Capacity & Location) : </p>
                                    <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['preliminary_design'])}}">
                                        <i class="fa mb-2 fa-file-text-o txt-info"></i>
                                        {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['preliminary_design'])}}
                                    </a>
                                </li>
                            @endif
                            @if($project?->getAllAttachment($project->fel3?->attachment, $setting::FEL3_ATTACHMENT['utility_infrastructure_facilities_diagram']))
                                <li><p class="m-b-0">Data of Survey for Parameter, reference :</p>
                                    <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['utility_infrastructure_facilities_diagram'])}}">
                                        <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                        {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['utility_infrastructure_facilities_diagram'])}}
                                    </a>
                                </li>
                            @endif
                            @if($project?->getAllAttachment($project->fel3?->attachment, $setting::FEL3_ATTACHMENT['hazop']))
                                <li><p class="m-b-0">Diagram/Drawing of Flow/Process :</p>
                                    <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['hazop'])}}">
                                        <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                        {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['hazop'])}}
                                    </a>
                                </li>
                            @endif
                            @if($project?->getAllAttachment($project->fel3?->attachment, $setting::FEL3_ATTACHMENT['moc_document']))
                                <li><p class="m-b-0">Initial Risk Assessment (as reference for select best option) :</p>
                                    <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['moc_document'])}}">
                                        <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                        {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['moc_document'])}}
                                    </a>
                                </li>
                            @endif
                            @if($project?->getAllAttachment($project->fel3?->attachment, $setting::FEL3_ATTACHMENT['cost_estimate']))
                                <li><p class="m-b-0">Initial Utility/Facility/Infrastructure Diagram :</p>
                                    <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['cost_estimate'])}}">
                                        <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                        {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['cost_estimate'])}}
                                    </a>
                                </li>
                            @endif
                            @if($project?->getAllAttachment($project->fel3?->attachment, $setting::FEL3_ATTACHMENT['quotation_of_equipment']))
                                <li><p class="m-b-0">Site Query/Quotation of Main Equipment :</p>
                                    <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['quotation_of_equipment'])}}">
                                        <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                        {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['quotation_of_equipment'])}}
                                    </a>
                                </li>
                            @endif
                            @if($project?->getAllAttachment($project->fel3?->attachment, $setting::FEL3_ATTACHMENT['project_level_assessment']))
                                <li>
                                    <p class="m-b-0">Project Level Assessment Document : </p>
                                    <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['project_level_assessment'])}}">
                                        <i class="fa mb-2 fa-file-text-o txt-info"></i>
                                        {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['project_level_assessment'])}}
                                    </a>
                                </li>
                            @endif
                            @if($project?->getAllAttachment($project->fel3?->attachment, $setting::FEL3_ATTACHMENT['fel1']))
                                <li><p class="m-b-0">FEL 1 Engineering Report (if though FEL 1) :</p>
                                    <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['fel1'])}}">
                                        <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                        {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['fel1'])}}
                                    </a>
                                </li>
                            @endif
                            @if($project?->getAllAttachment($project->fel3?->attachment, $setting::FEL3_ATTACHMENT['fel2']))
                                <li><p class="m-b-0">Technical Evaluation :</p>
                                    <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['fel2'])}}">
                                        <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                        {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['fel2'])}}
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </td>
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
