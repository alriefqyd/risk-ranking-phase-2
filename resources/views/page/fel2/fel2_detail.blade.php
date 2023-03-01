@inject('setting',App\Models\Setting::class)
<div class="row js-form-project-detail m-b-30 {{!$errors->any() ? '' : 'd-none'}}">
    @if($project?->fel2)
        <div class="table-responsive">
            <table class="table table-striped js-table-assessment">
                <tbody>
                <tr>
                    <td style="width: 200px">Project Scope : </td>
                    <td style="width: 10px">{!! $project->getCheckTemplate($project?->fel2?->project_scope) !!}</td>
                    <td style="width: 67%">{!! $project?->fel2?->project_scope_text !!}</td>
                </tr>
                <tr>
                    <td>Identify Main Equipment  : </td>
                    <td>{!! $project->getCheckTemplate($project?->fel2?->identify_main_equipment) !!}</td>
                    <td>{!! $project?->fel2?->identify_main_equipment_text !!}</td>
                </tr>
                <tr>
                    <td>Boundary and Assumption</td>
                    <td>{!! $project->getCheckTemplate($project?->fel2?->boundary_and_assumption) !!}</td>
                    <td style="width: 270px">{!! $project?->fel2?->boundary_and_assumption_text !!}</td>
                </tr>
                <tr>
                    <td>Analysis of Option :</td>
                    <td>{!! $project->getCheckTemplate($project?->fel2?->analysis_of_option) !!}</td>
                    <td style="width: 270px">{!! $project?->fel2?->analysis_of_option_text !!}</td>
                </tr>
                <tr>
                    <td>Permit List :</td>
                    <td>{!! $project->getCheckTemplate($project?->fel2?->permit_list) !!}</td>
                    <td style="width: 270px">{!! $project?->fel2?->permit_list_text !!}</td>
                </tr>
                <tr>
                    <td>Schedule Project :</td>
                    <td>{!! $project->getCheckTemplate($project?->fel2?->schedule_project) !!}</td>
                    <td style="width: 270px">{!! $project?->fel2?->schedule_project_text !!}</td>
                </tr>
                <tr>
                    <td>Cost Estimate :</td>
                    <td>{!! $project->getCheckTemplate($project?->fel2?->cost_estimate) !!}</td>
                    <td style="width: 270px">$ {!! $project?->fel2?->cost_estimate_text !!}</td>
                </tr>
                <tr>
                    <td>Status :</td>
                    <td>{{$project?->fel2?->status}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Attachment List : </td>
                    <td>
                        {!! $project?->getCheckTemplate($project?->fel2?->attachment ? 1 : 0) !!}
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td style="width:50%">
                                    <p class="m-b-0">Calculation/Reference of Capacity (Capacity & Location) : </p>
                                </td>
                                <td style="width:50%">
                                    @if($project?->getAllAttachment($project->fel2?->attachment, $setting::FEL2_ATTACHMENT['reference_of_capacity']))
                                        <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{urlencode($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['reference_of_capacity']))}}">
                                            <i class="fa mb-2 fa-file-text-o txt-info"></i>
                                            {{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['reference_of_capacity'])}}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width:50%">
                                    <p class="m-b-0">Data of Survey for Parameter, reference :</p>
                                </td>
                                <td style="width:50%">
                                    @if($project?->getAllAttachment($project->fel2?->attachment, $setting::FEL2_ATTACHMENT['data_of_survey_parameter']))
                                        <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{urlencode($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['data_of_survey_parameter']))}}">
                                            <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                            {{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['data_of_survey_parameter'])}}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width:50%">
                                    <p class="m-b-0">Diagram/Drawing of Flow/Process :</p>
                                </td>
                                <td style="width:50%">
                                    @if($project?->getAllAttachment($project->fel2?->attachment, $setting::FEL2_ATTACHMENT['diagram_process']))
                                        <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{urlencode($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['diagram_process']))}}">
                                            <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                            {{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['diagram_process'])}}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width:50%">
                                    <p class="m-b-0">Initial Risk Assessment (as reference for select best option) :</p>
                                </td>
                                <td style="width:50%">
                                    @if($project?->getAllAttachment($project->fel2?->attachment, $setting::FEL2_ATTACHMENT['initial_risk_assessment']))
                                        <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{urlencode($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['initial_risk_assessment']))}}">
                                            <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                            {{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['initial_risk_assessment'])}}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width:50%">
                                    <p class="m-b-0">Initial Utility/Facility/Infrastructure Diagram :</p>
                                </td>
                                <td style="width:50%">
                                    @if($project?->getAllAttachment($project->fel2?->attachment, $setting::FEL2_ATTACHMENT['initial_utility_diagram']))
                                        <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{urlencode($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['initial_utility_diagram']))}}">
                                            <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                            {{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['initial_utility_diagram'])}}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width:50%">
                                    <p class="m-b-0">Site Query/Quotation of Main Equipment :</p>
                                </td>
                                <td style="width:50%">
                                    @if($project?->getAllAttachment($project->fel2?->attachment, $setting::FEL2_ATTACHMENT['quotation_main_equipment']))
                                        <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{urlencode($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['quotation_main_equipment']))}}">
                                            <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                            {{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['quotation_main_equipment'])}}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width:50%">
                                    <p class="m-b-0">Project Level Assessment Document : </p>
                                </td>
                                <td style="width:50%">
                                    @if($project?->getAllAttachment($project->fel2?->attachment, $setting::FEL2_ATTACHMENT['project_level_assessment']))
                                        <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{urlencode($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['project_level_assessment']))}}">
                                            <i class="fa mb-2 fa-file-text-o txt-info"></i>
                                            {{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['project_level_assessment'])}}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width:50%">
                                    <p class="m-b-0">FEL 1 Engineering Report (if though FEL 1) :</p>
                                </td>
                                <td style="width:50%">
                                    @if($project?->getAllAttachment($project->fel2?->attachment, $setting::FEL2_ATTACHMENT['fel1']))
                                        <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{urlencode($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['fel1']))}}">
                                            <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                            {{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['fel1'])}}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width:50%">
                                    <p class="m-b-0">Technical Evaluation :</p>
                                </td>
                                <td style="width:50%">
                                    @if($project?->getAllAttachment($project->fel2?->attachment, $setting::FEL2_ATTACHMENT['technical_evaluation']))
                                        <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{urlencode($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['technical_evaluation']))}}">
                                            <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                            {{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['technical_evaluation'])}}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width:50%">
                                    <p class="m-b-0">Economic / Financial Evaluation :</p> </p>
                                </td>
                                <td style="width:50%">
                                    @if($project?->getAllAttachment($project->fel2?->attachment, $setting::FEL2_ATTACHMENT['financial_evaluation']))

                                            <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{urlencode($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['financial_evaluation']))}}">
                                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                {{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['financial_evaluation'])}}
                                            </a>
                                        </li>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width:50%">
                                    <p class="m-b-0">Schedule level 2 :</p>
                                </td>
                                <td style="width:50%">
                                    @if($project?->getAllAttachment($project->fel2?->attachment, $setting::FEL2_ATTACHMENT['schedule_level_2']))
                                        <a target="_blank" href="/preview?id={{$project->id}}&dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{urlencode($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['schedule_level_2']))}}">
                                            <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                            {{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['schedule_level_2'])}}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width:50%">
                                    <p class="m-b-0">Cost Estimate :</p>
                                </td>
                                <td style="width:50%">
                                    @if($project?->getAllAttachment($project->fel2?->attachment, $setting::FEL2_ATTACHMENT['cost_estimate']))
                                        <a target="_blank" href="/preview?id={{$project->id}}&dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{urlencode($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['cost_estimate']))}}">
                                            <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                            {{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['cost_estimate'])}}
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
    @else
        <div class="text-center">
            No Data Fel 2
        </div>
    @endif
</div>
