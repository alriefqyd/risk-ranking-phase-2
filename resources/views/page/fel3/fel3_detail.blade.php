@inject('setting',App\Models\Setting::class)
<div class="js-form-project-detail js-parent-detail">
    @if($project?->fel3)
        <div class="row m-b-30 m-t-40 {{!$errors->any() ? '' : 'd-none'}}">
            <div class="table-responsive js-fel-3-view-property">
                <div class="col-md-12">
                    <h6 class="m-l-10 m-b-10 float-start js-fel-3-view-property">FEL 3 Detail</h6>
                </div>
                <table class="table table-striped js-table-assessment">
                    <tbody>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Executive Summary :</label>
                                </div>
                                <div class="col-md-8 float-start">
                                    {!! $project->getCheckTemplate($project?->fel3?->executive_summary) !!}
                                </div>
                                <div class="col-md-12">
                                    {!! $project?->fel3?->executive_summary_text !!}
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Problem Statement :</label>
                                </div>
                                <div class="col-md-8 float-start">
                                    {!! $project->getCheckTemplate($project?->fel3?->problem_statement) !!}
                                </div>
                                <div class="col-md-12">
                                    {!!$project?->fel3?->problem_statement_text !!}
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Project Scope :</label>
                                </div>
                                <div class="col-md-8 float-start">
                                    {!! $project->getCheckTemplate($project?->fel3?->project_scope) !!}
                                </div>
                                <div class="col-md-12">
                                    {!! $project?->fel3?->project_scope_text !!}
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Alternatives And Best Option :</label>
                                </div>
                                <div class="col-md-8 float-start">
                                    {!! $project->getCheckTemplate($project?->fel3?->alternatives_and_best_option) !!}
                                </div>
                                <div class="col-md-12">
                                    {!! $project?->fel3?->alternatives_and_best_option_text !!}
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Project Schedule :</label>
                                </div>
                                <div class="col-md-8 float-start">
                                    {!! $project->getCheckTemplate($project?->fel3?->project_schedule) !!}
                                </div>
                                <div class="col-md-12">
                                    @if($project->fel3?->getScheduleList()['isMilestone'] == true)
                                        <table class="table table-striped">
                                            <thead>
                                            <th style="width: 60%">Desc</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            </thead>
                                            <tbody>
                                            @foreach($project->fel3?->getScheduleList()['data'] as $data)
                                                <tr>
                                                    <td>{{$data->desc}}</td>
                                                    <td>{{$data->start_date}}</td>
                                                    <td>{{$data->end_date}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        {!! $project?->fel3?->project_schedule_text !!}
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>List Of Equipment And Specification :</label>
                                </div>
                                <div class="col-md-8 float-start">
                                    {!! $project->getCheckTemplate($project?->fel3?->list_of_equipment_and_specification) !!}
                                </div>
                                <div class="col-md-12">
                                    {!! $project?->fel3?->list_of_equipment_and_specification_text !!}
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>HAZOP Study :</label>
                                </div>
                                <div class="col-md-8 float-start">
                                    {!! $project->getCheckTemplate($project?->fel3?->hazop_study) !!}
                                </div>
                                <div class="col-md-12">
                                    {!! $project?->fel3?->hazop_study_text !!}
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Cost Estimate :</label>
                                </div>
                                <div class="col-md-8 float-start">
                                    {!! $project->getCheckTemplate($project?->fel3?->cost_estimate) !!}
                                </div>
                                <div class="col-md-12">
                                    $ {!! $project?->fel3?->cost_estimate_text !!}
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
                                    {{ $project?->fel3?->status }}
                                </div>
                                <div class="col-md-12">

                                </div>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Attachment List</label>
                                </div>
                                <div class="col-md-8 float-start">
                                    {!! $project?->getCheckTemplate($project?->fel3?->attachment ? 1 : 0) !!}
                                </div>
                                <div class="col-md-12">
                                    <table style="width: 100%">
                                        <tr>
                                            <td>
                                                Preliminary Design :
                                            </td>
                                            <td>
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
                                            <td>
                                                Utility/Infrastructure/Facilities Diagram : :
                                            </td>
                                            <td>
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
                                            <td>
                                                HAZOP Study/GPRA/WI (Risk Assessment) :
                                            </td>
                                            <td>
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
                                            <td>
                                                MOC Document :
                                            </td>
                                            <td>
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
                                            <td>
                                                Cost Estimate with rough of magnitude 15-20% :
                                            </td>
                                            <td>
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
                                            <td>
                                                Quotation of equipment/Site Query :
                                            </td>
                                            <td>
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
                                            <td>
                                                Project Assessment Level :
                                            </td>
                                            <td>
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
                                            <td>
                                                FEL 1 Engineering Report (if though FEL 1) :
                                            </td>
                                            <td>
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
                                            <td>
                                                FEL 2 Engineering Report (if though FEL 2) :
                                            </td>
                                            <td>
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
                                </div>
                            </div>
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
