@inject('setting',App\Models\Setting::class)
<div class="row js-form-project-detail m-b-30 {{!$errors->any() ? '' : 'd-none'}}">
    @if($project?->fel2)
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
                                {!! $project->getCheckTemplate($project?->fel2?->project_scope) !!}
                            </div>
                            <div class="col-md-12">
                                {!! $project?->fel2?->project_scope_text !!}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Identify Main Equipment :</label>
                            </div>
                            <div class="col-md-8 float-start">
                                {!! $project->getCheckTemplate($project?->fel2?->identify_main_equipment) !!}
                            </div>
                            <div class="col-md-12">
                                {!! $project?->fel2?->identify_main_equipment_text !!}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Alternatives and Analysis of Alternatives  :</label>
                            </div>
                            <div class="col-md-8 float-start">
                                {!! $project->getCheckTemplate($project?->fel2?->alternatives_and_analysis) !!}
                            </div>
                            <div class="col-md-12">
                                {!! $project?->fel2?->alternatives_and_analysis_text !!}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Status  :</label>
                            </div>
                            <div class="col-md-8 float-start">
                                {{$project?->fel2?->status}}
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
                                {!! $project?->getCheckTemplate($project?->fel2?->attachment ? 1 : 0) !!}
                            </div>
                            <div class="col-md-12">
                                <table style="width: 100%">
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
                                        <td>
                                            Data of Survey for Parameter, reference :
                                        </td>
                                        <td>
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
                                        <td>
                                            Diagram/Drawing of Flow/Process :
                                        </td>
                                        <td>
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
                                        <td>
                                            Initial Risk Assessment (as reference for select best option) :
                                        </td>
                                        <td>
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
                                        <td>
                                            Initial Utility/Facility/Infrastructure Diagram :
                                        </td>
                                        <td>
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
                                        <td>
                                            Site Query/Quotation of Main Equipment :
                                        </td>
                                        <td>
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
                                        <td>
                                            Project Level Assessment Document :
                                        </td>
                                        <td>
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
                                        <td>
                                            FEL 1 Engineering Report (if though FEL 1) :
                                        </td>
                                        <td>
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
                                        <td>
                                            Technical Evaluation :
                                        </td>
                                        <td>
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
                                        <td>
                                            Schedule level 2 :
                                        </td>
                                        <td>
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
                                        <td>
                                            <p class="m-b-0">Economic / Financial Evaluation :</p> </p>
                                        </td>
                                        <td>
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
                                        <td>
                                            <p class="m-b-0">Cost Estimate :</p>
                                        </td>
                                        <td>
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
                            </div>
                        </div>
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
