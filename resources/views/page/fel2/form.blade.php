@inject('setting',App\Models\Setting::class)
<div class="table-responsive">
    <input type="hidden" class="js-project-id" value="{{$project->id}}">
    <table class="table table-striped js-table-assessment">
        <tbody>
        <tr>
            <td style="width: 200px">Project Scope : </td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-project_scope-fel2"
                           {{$project?->fel2?->project_scope == 1 ? 'checked' : ''}}
                           name="project_scope" class="js-checkbox-fel2" type="checkbox">
                    <label for="checkbox-project_scope-fel2"></label>
                </div>
            </td>
            <td style="width: 69%">
                <small>(Identify the scopes of project as complete as this stage can. More complete scope at this stage that will useful for conduct selection best option).  </small>
                <textarea class="tinymce js-fel2-text-project-scope"
                          name="project_scope_FEL2_text"
                    {!! $project?->fel2?->project_scope != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->fel2?->project_scope_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_fel2_project_scope">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Identify Main Equipment </td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-identify_main_equipment"
                           {{$project?->fel2?->identify_main_equipment == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel2" type="checkbox">
                    <label for="checkbox-identify_main_equipment"></label>
                </div>
            </td>
            <td style="width: 69%">
                <small>(At this stage, main equipment has can identify, mentioned at this section & attached the reference or quotation). </small>
                <textarea class="tinymce js-text-identify_main_equipment"
                          name="identified_parameter_FEL2_text"
                          {!! $project?->fel2?->identify_main_equipment != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->fel2?->identify_main_equipment_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_fel2_identify_main_equipment">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Boundary & Assumption : </td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-boundary_assumption"
                           {{$project?->fel2?->boundary_and_assumption == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel2" type="checkbox">
                    <label for="checkbox-boundary_assumption"></label>
                </div>
            </td>
            <td style="width: 69%">
                <small>(State of boundaries and assumptions that this analysis use let all stakeholder know).</small>
                <textarea class="tinymce js-text-boundary_and_assumption_text"
                          name="boundary_and_assumption_text"
                          {!! $project?->fel2?->boundary_and_assumption != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->fel2?->boundary_and_assumption_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_fel2_boundary_and_assumption_text">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Analysis of Option :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-analysis_of_option"
                           {{$project?->fel2?->analysis_of_option == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel2" type="checkbox">
                    <label for="checkbox-analysis_of_option"></label>
                </div>
            </td>
            <td style="width: 69%">
                <small>(Described in one two paragraph in this section about analysis of alternatives that this project use, process of analysis, which best option for this investment. Analysis of best option should reviewed from technical & economic valuation. Please attached document of analysis).</small>
                <textarea class="tinymce js-text-analysis_of_option_text"
                          name="analysis_of_option"
                          {!! $project?->fel2?->analysis_of_option != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->fel2?->analysis_of_option_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_fel2_analysis_of_option">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Permit List :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-permit_list"
                           {{$project?->fel2?->permit_list == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel2" type="checkbox">
                    <label for="checkbox-permit_list"></label>
                </div>
            </td>
            <td style="width: 69%">
                <small>(Listed the permit that required for this project)</small>
                <textarea class="tinymce js-text-permit_list_text"
                          name="analysis_of_option"
                          {!! $project?->fel2?->permit_list != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->fel2?->permit_list_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_fel2_permit_list">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Schedule Project :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox_fel2-schedule_project"
                           {{$project?->fel2?->schedule_project == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel2" type="checkbox">
                    <label for="checkbox_fel2-schedule_project"></label>
                </div>
            </td>
            <td style="width: 69%">
                <small>(Highlight the schedule, for breakdown until level 2 put as attachment) </small>
                <textarea class="tinymce js-text-fel2-schedule_project_text"
                          name="schedule_project_text"
                          {!! $project?->fel2?->schedule_project != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->fel2?->schedule_project_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_fel2_schedule">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Cost Estimate :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-cost_estimate_fel2"
                           {{$project?->fel2?->cost_estimate == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel2" type="checkbox">
                    <label for="checkbox-cost_estimate_fel2"></label>
                </div>
            </td>
            <td>
                <small>(Develop cost estimate for best option with rough of magnitude 25 – 30%, at this paragraph just summary put detail as attachment).</small>
                <div class="input-group mb-3 js-cost-estimate
                    {{$project?->fel2?->cost_estimate == 0 ? 'd-none' : ''}}"
                ><span class="input-group-text">$  </span>
                    <input class="form-control js-cost_estimate_assessment js-cost_estimate_fel2 cold-md-12" type="number"
                           name="fel2_cost_estimate"
                           value="{{$project?->fel2?->cost_estimate_text}}"
                           aria-label="Amount (to the nearest dollar)"><span class="input-group-text">.00  </span>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                Attachment File
            </td>
            <td>

            </td>
            <td>
                <div class="row">
                    <div class="col-md-12">
                        <label>Calculation/Reference of Capacity (Capacity & Location)</label>
                        <input class="form-control js-fel2-attachment_calculation_of_capacity col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['reference_of_capacity']))
                            <a target="_blank"
                               href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['reference_of_capacity'])}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['reference_of_capacity'])}}
                            </a>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label>Data of Survey for Parameter, reference</label>
                        <input class="form-control js-fel2-attachment_data_of_survey_parameter col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['data_of_survey_parameter']))
                            <a target="_blank"
                               href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['data_of_survey_parameter'])}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['data_of_survey_parameter'])}}
                            </a>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label>Diagram/Drawing of Flow/Process </label>
                        <input class="form-control js-fel2-attachment_diagram_process col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['diagram_process']))
                            <a target="_blank"
                               href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['diagram_process'])}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['diagram_process'])}}
                            </a>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label>Initial Risk Assessment (as reference for select best option)</label>
                        <input class="form-control js-fel2-attachment_initial_risk_assessment col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['initial_risk_assessment']))
                            <a target="_blank"
                               href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['initial_risk_assessment'])}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['initial_risk_assessment'])}}
                            </a>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label>Initial Utility/Facility/Infrastructure Diagram</label>
                        <input class="form-control js-fel2-attachment_initial_utility_diagram col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['initial_utility_diagram']))
                            <a target="_blank"
                               href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['initial_utility_diagram'])}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['initial_utility_diagram'])}}
                            </a>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label>Site Query/Quotation of Main Equipment</label>
                        <input class="form-control js-fel2-attachment_quotation_main_equipment col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['quotation_main_equipment']))
                            <a target="_blank"
                               href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['quotation_main_equipment'])}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['quotation_main_equipment'])}}
                            </a>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label>Project Level Assessment Document</label>
                        <input class="form-control js-fel2-attachment_project_level_assessment col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['project_level_assessment']))
                            <a target="_blank"
                               href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['project_level_assessment'])}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['project_level_assessment'])}}
                            </a>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label>FEL 1 Engineering Report (if though FEL 1)</label>
                        <input class="form-control js-fel2-attachment_fel1 col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['fel1']))
                            <a target="_blank"
                               href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['fel1'])}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['fel1'])}}
                            </a>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label>Technical Evaluation</label>
                        <input class="form-control js-fel2-attachment_technical_evaluation col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['technical_evaluation']))
                            <a target="_blank"
                               href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['technical_evaluation'])}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['technical_evaluation'])}}
                            </a>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label>Economic / Financial Evaluation</label>
                        <input class="form-control js-fel2-attachment_financial_evaluation col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['financial_evaluation']))
                            <a target="_blank"
                               href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['financial_evaluation'])}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['financial_evaluation'])}}
                            </a>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label>Schedule level 2</label>
                        <input class="form-control js-fel2-attachment_schedule_level-2 col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['schedule_level_2']))
                            <a target="_blank"
                               href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['schedule_level_2'])}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['schedule_level_2'])}}
                            </a>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label>Cost Estimate </label>
                        <input class="form-control js-fel2-attachment_cost_estimate col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['cost_estimate']))
                            <a target="_blank"
                               href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['cost_estimate'])}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['cost_estimate'])}}
                            </a>
                        @endif
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div class="row">
    <input type="hidden" name="validate_check_empty_count" class="js-validate-checkbox-count">
</div>
