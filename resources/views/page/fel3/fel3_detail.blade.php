@inject('setting',App\Models\Setting::class)
<div class="js-form-project-detail js-parent-detail">
    @if($project?->fel3)
        @if($project?->assessment?->complexity_analysis_type)
            @include('page.maturity_analysis.template',[
                     'isView' => true
            ])
        @endif

        <div class="row m-b-30 m-t-40 {{!$errors->any() ? '' : 'd-none'}}">
            <div class="table-responsive js-fel-3-view-property">
                <div class="col-md-12">
                    <h6 class="m-l-10 m-b-10 float-start js-fel-3-view-property">FEL 3 Detail</h6>
                </div>
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
                        <td>$ {!! $project?->fel3?->cost_estimate_text !!}</td>
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
                            <table style="width:100%">
                                <tr>
                                    <td style="width: 50%">
                                        <p class="m-b-0">Preliminary Design  : </p>
                                    </td>
                                    <td style="width: 50%">
                                        @if($project?->getAllAttachment($project->fel3?->attachment, $setting::FEL3_ATTACHMENT['preliminary_design']))
                                            <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{urlencode($project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['preliminary_design']))}}">
                                                <i class="fa mb-2 fa-file-text-o txt-info"></i>
                                                {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['preliminary_design'])}}
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">
                                        <p class="m-b-0">Utility/Infrastructure/Facilities Diagram :</p>
                                    </td>
                                    <td style="width: 50%">
                                        @if($project?->getAllAttachment($project->fel3?->attachment, $setting::FEL3_ATTACHMENT['utility_infrastructure_facilities_diagram']))
                                            <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{urlencode($project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['utility_infrastructure_facilities_diagram']))}}">
                                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['utility_infrastructure_facilities_diagram'])}}
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">
                                        <p class="m-b-0">HAZOP Study/GPRA/WI (Risk Assessment)		 :</p>
                                    </td>
                                    <td style="width: 50%">
                                        @if($project?->getAllAttachment($project->fel3?->attachment, $setting::FEL3_ATTACHMENT['hazop']))
                                            <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{urlencode($project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['hazop']))}}">
                                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['hazop'])}}
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">
                                        <p class="m-b-0">MoC Document  :</p>
                                    </td>
                                    <td style="width: 50%">
                                        @if($project?->getAllAttachment($project->fel3?->attachment, $setting::FEL3_ATTACHMENT['moc_document']))
                                            <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{urlencode($project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['moc_document']))}}">
                                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['moc_document'])}}
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">
                                        <p class="m-b-0">Cost Estimate with rough of magnitude 15-20% :</p>
                                    </td>
                                    <td style="width: 50%">
                                        @if($project?->getAllAttachment($project->fel3?->attachment, $setting::FEL3_ATTACHMENT['cost_estimate']))
                                            <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{urlencode($project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['cost_estimate']))}}">
                                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['cost_estimate'])}}
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">
                                        <p class="m-b-0">Quotation of equipment/Site Query :</p>
                                    </td>
                                    <td style="width: 50%">
                                        @if($project?->getAllAttachment($project->fel3?->attachment, $setting::FEL3_ATTACHMENT['quotation_of_equipment']))
                                            <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{urlencode($project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['quotation_of_equipment']))}}">
                                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['quotation_of_equipment'])}}
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">
                                        <p class="m-b-0">Project Assessment Level : </p>
                                    </td>
                                    <td style="width: 50%">
                                        @if($project?->getAllAttachment($project->fel3?->attachment, $setting::FEL3_ATTACHMENT['project_level_assessment']))
                                            <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{urlencode($project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['project_level_assessment']))}}">
                                                <i class="fa mb-2 fa-file-text-o txt-info"></i>
                                                {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['project_level_assessment'])}}
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">
                                        <p class="m-b-0">FEL 1 Engineering Report (if though FEL 1) :</p>
                                    </td>
                                    <td style="width: 50%">
                                        @if($project?->getAllAttachment($project->fel3?->attachment, $setting::FEL3_ATTACHMENT['fel1']))
                                            <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{urlencode($project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['fel1']))}}">
                                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['fel1'])}}
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">
                                        <p class="m-b-0">FEL 2 – Engineering Report (if through FEL 2) :</p>
                                    </td>
                                    <td style="width: 50%">
                                        @if($project?->getAllAttachment($project->fel3?->attachment, $setting::FEL3_ATTACHMENT['fel2']))
                                            <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{urlencode($project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['fel2']))}}">
                                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['fel2'])}}
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="text-center">
            No Data Fel 3
        </div>
    @endif
</div>
