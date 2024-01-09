@inject('setting',App\Models\Setting::class)
<div class="table-responsive">
    <input type="hidden" class="js-project-id" value="{{$project->id}}">
    <table class="table table-striped js-table-assessment">
        <tbody>
        <tr>
            <td colspan="3">
                <div class="row">
                    <div class="col-md-3 mb-3 padding-right-0 w-20">
                        <label class="float-start">Project Scope :</label>
                    </div>
                    <div class="col-md-3 m-t-4 float-start padding-left-0">
                        <div class="checkbox-rect">
                            <input id="checkbox-project_scope-fel2"
                                   name="project_scope"
                                   {{$project?->fel2?->project_scope == 1 ? 'checked' : ''}}
                                   class="js-checkbox-fel2" type="checkbox">
                            <label for="checkbox-project_scope-fel2"></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <small>(Identify the scopes of project as complete as this stage can. More complete scope at this stage that will useful for conduct selection best option). </small>

                        <textarea class="tinymce js-fel2-text-project-scope"
                                  name="problem_statement"
                                  {!! $project?->fel2?->project_scope != 1 ? 'style="display: none"' : '' !!}>
                                 {!! $project?->fel2?->project_scope_text !!}
                        </textarea>
                        <input type="hidden" class="js-hidden-validate" name="validate_fel2_project_scope">
                        <div class="col-md-12 txt-danger js-error-message"></div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <div class="row">
                    <div class="col-md-3 mb-3 padding-right-0 w-20">
                        <label class="float-start">Identify Main Equipment :</label>
                    </div>
                    <div class="col-md-3 m-t-4 float-start padding-left-0">
                        <div class="checkbox-rect">
                            <input id="checkbox-identify_main_equipment"
                                   {{$project?->fel2?->identify_main_equipment == 1 ? 'checked' : ''}}
                                   class="js-checkbox-fel2" type="checkbox">
                            <label for="checkbox-identify_main_equipment"></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <small>(At this stage, main equipment has can identify, mentioned at this section & attached the reference or quotation). </small>
                        <textarea class="tinymce js-text-identify_main_equipment"
                                  name="identified_parameter_FEL2_text"
                          {!! $project?->fel2?->identify_main_equipment != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->fel2?->identify_main_equipment_text !!}
                </textarea>
                        <input type="hidden" class="js-hidden-validate" name="validate_fel2_identify_main_equipment">
                        <div class="col-md-12 txt-danger js-error-message"></div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <div class="row">
                    <div class="col-md-3 mb-3 padding-right-0 w-20">
                        <label class="float-start">Alternatives and Analysis of Alternatives :</label>
                    </div>
                    <div class="col-md-3 m-t-4 float-start padding-left-0">
                        <div class="checkbox-rect">
                            <input id="checkbox-alternatives_and_analysis"
                                   {{$project?->fel2?->alternatives_and_analysis == 1 ? 'checked' : ''}}
                                   class="js-checkbox-fel2" type="checkbox">
                            <label for="checkbox-alternatives_and_analysis"></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <small>(Described in one two paragraph in this section about analysis of alternatives that this project use, process of analysis, which best option for this investment. Analysis of best option should reviewed from technical & economic valuation. Please attached document of analysis). </small>
                        <textarea class="tinymce js-text-alternatives_and_analysis"
                                          name="alternatives_and_analysis_text"
                                  {!! $project?->fel2?->alternatives_and_analysis != 1 ? 'style="display: none"' : '' !!}>
                            {!! $project?->fel2?->alternatives_and_analysis_text !!}
                        </textarea>
                        <input type="hidden" class="js-hidden-validate" name="validate_fel2_alternatives_and_analysis">
                        <div class="col-md-12 txt-danger js-error-message"></div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="float-start">Attachment File : </label>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table-striped" style="width: 100%">
                                    <tr>
                                        <td>
                                            <div class="row">
                                                @php($attachmentReferenceCapacity = $project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['reference_of_capacity']))
                                                <div class="col-md-12">
                                                    <label>Calculation/Reference of Capacity (Capacity & Location)</label>
                                                    <input class="form-control js-upload-attachment js-fel2-attachment_calculation_of_capacity col-md-10"
                                                           data-validated="{{isset($attachmentReferenceCapacity) ? 'true' : 'false'}}"
                                                           value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                                                    @if(isset($attachmentReferenceCapacity))
                                                        <a target="_blank"
                                                           class="js-attachment-existing-assessment"
                                                           href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{urlencode($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['reference_of_capacity']))}}">
                                                            <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                            {{$attachmentReferenceCapacity}}
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                                                <div class="js-error-file_size js-check-count-error text-danger"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @php($attachmentDataOfSurvey = $project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['data_of_survey_parameter']))
                                                    <label>Data of Survey for Parameter, reference</label>
                                                    <input class="form-control js-upload-attachment js-fel2-attachment_data_of_survey_parameter col-md-10"
                                                           data-validated="{{isset($attachmentDataOfSurvey) ? 'true' : 'false'}}"
                                                           value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                                                    @if($attachmentDataOfSurvey)
                                                        <a target="_blank"
                                                           class="js-attachment-existing-assessment"
                                                           href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{urlencode($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['data_of_survey_parameter']))}}">
                                                            <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                            {{$attachmentDataOfSurvey}}
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                                                <div class="js-error-file_size js-check-count-error text-danger"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @php($attachmentDiagramFlow = $project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['diagram_process']))
                                                    <label>Diagram/Drawing of Flow/Process <span class="text-danger f-w-550">*</span></label>
                                                    <input class="form-control js-upload-attachment js-attachment-mandatory js-fel2-attachment_diagram_process col-md-10"
                                                           data-validated="{{isset($attachmentDiagramFlow) ? 'true' : 'false'}}"
                                                           value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                                                    @if($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['diagram_process']))
                                                        <a target="_blank"
                                                           class="js-attachment-existing-assessment"
                                                           href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{urlencode($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['diagram_process']))}}">
                                                            <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                            {{$attachmentDiagramFlow}}
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                                                <div class="js-error-file_size js-check-count-error text-danger"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @php($attachmentRiskAssessment = $project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['initial_risk_assessment']))
                                                    <label>Initial Risk Assessment (as reference for select best option) <span class="text-danger f-w-550">*</span></label>
                                                    <input class="form-control js-upload-attachment js-attachment-mandatory js-fel2-attachment_initial_risk_assessment col-md-10"
                                                           data-validated="{{isset($attachmentRiskAssessment) ? 'true' : 'false'}}"
                                                           value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                                                    @if($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['initial_risk_assessment']))
                                                        <a target="_blank"
                                                           class="js-attachment-existing-assessment"
                                                           href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{urlencode($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['initial_risk_assessment']))}}">
                                                            <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                            {{$attachmentRiskAssessment}}
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                                                <div class="js-error-file_size js-check-count-error text-danger"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @php($attachmentInitialUtility = $project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['initial_utility_diagram']))
                                                    <label>Initial Utility/Facility/Infrastructure Diagram <span class="text-danger f-w-550">*</span></label>
                                                    <input class="form-control js-upload-attachment js-attachment-mandatory js-fel2-attachment_initial_utility_diagram col-md-10"
                                                           data-validated="{{isset($attachmentInitialUtility) ? 'true' : 'false'}}"
                                                           value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                                                    @if($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['initial_utility_diagram']))
                                                        <a target="_blank"
                                                           class="js-attachment-existing-assessment"
                                                           href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{urlencode($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['initial_utility_diagram']))}}">
                                                            <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                            {{$attachmentInitialUtility}}
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                                                <div class="js-error-file_size js-check-count-error text-danger"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @php($attachmentSiteQuery = $project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['quotation_main_equipment']))
                                                    <label>Site Query/Quotation of Main Equipment <span class="text-danger f-w-550">*</span></label>
                                                    <input class="form-control js-upload-attachment js-attachment-mandatory js-fel2-attachment_quotation_main_equipment col-md-10"
                                                           data-validated="{{isset($attachmentSiteQuery) ? 'true' : 'false'}}"
                                                           value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                                                    @if($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['quotation_main_equipment']))
                                                        <a target="_blank"
                                                           class="js-attachment-existing-assessment"
                                                           href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{urlencode($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['quotation_main_equipment']))}}">
                                                            <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                            {{$attachmentSiteQuery}}
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                                                <div class="js-error-file_size js-check-count-error text-danger"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @php($attachmentProjectLevelAssessment = $project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['project_level_assessment']))
                                                    <label>Project Level Assessment Document</label>
                                                    <input class="form-control js-upload-attachment js-fel2-attachment_project_level_assessment col-md-10"
                                                           data-validated="{{isset($attachmentProjectLevelAssessment) ? 'true' : 'false'}}"
                                                           value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                                                    @if($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['project_level_assessment']))
                                                        <a target="_blank"
                                                           class="js-attachment-existing-assessment"
                                                           href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{urlencode($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['project_level_assessment']))}}">
                                                            <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                            {{$attachmentProjectLevelAssessment}}
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @php($attachmentFel1 = $project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['fel1']))
                                                    <label>FEL 1 Engineering Report (if though FEL 1)</label>
                                                    <input class="form-control js-upload-attachment js-fel2-attachment_fel1 col-md-10"
                                                           data-validated="{{isset($attachmentFel1) ? 'true' : 'false'}}"
                                                           value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                                                    @if($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['fel1']))
                                                        <a target="_blank"
                                                           class="js-attachment-existing-assessment"
                                                           href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{urlencode($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['fel1']))}}">
                                                            <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                            {{$attachmentFel1}}
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                                                <div class="js-error-file_size js-check-count-error text-danger"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @php($attachmentTechnicalEvaluation = $project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['technical_evaluation']))
                                                    <label>Technical Evaluation</label>
                                                    <input class="form-control js-upload-attachment js-fel2-attachment_technical_evaluation col-md-10"
                                                           data-validated="{{isset($attachmentTechnicalEvaluation) ? 'true' : 'false'}}"
                                                           value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                                                    @if($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['technical_evaluation']))
                                                        <a target="_blank"
                                                           class="js-attachment-existing-assessment"
                                                           href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{urlencode($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['technical_evaluation']))}}">
                                                            <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                            {{$attachmentTechnicalEvaluation}}
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                                                <div class="js-error-file_size js-check-count-error text-danger"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @php($attachmentFinancialEvaluation = $project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['financial_evaluation']))
                                                    <label>Economic / Financial Evaluation</label>
                                                    <input class="form-control js-upload-attachment js-fel2-attachment_financial_evaluation col-md-10"
                                                           data-validated="{{isset($attachmentFinancialEvaluation) ? 'true' : 'false'}}"
                                                           value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                                                    @if($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['financial_evaluation']))
                                                        <a target="_blank"
                                                           class="js-attachment-existing-assessment"
                                                           href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{urlencode($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['financial_evaluation']))}}">
                                                            <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                            {{$attachmentFinancialEvaluation}}
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                                                <div class="js-error-file_size js-check-count-error text-danger"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @php($attachmentScheduleLevel2 = $project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['schedule_level_2']))
                                                    <label>Schedule level 2</label>
                                                    <input class="form-control js-upload-attachment js-fel2-attachment_schedule_level-2 col-md-10"
                                                           data-validated="{{isset($attachmentScheduleLevel2) ? 'true' : 'false'}}"
                                                           value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                                                    @if($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['schedule_level_2']))
                                                        <a target="_blank"
                                                           class="js-attachment-existing-assessment"
                                                           href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{urlencode($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['schedule_level_2']))}}">
                                                            <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                            {{$attachmentScheduleLevel2}}
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                                                <div class="js-error-file_size js-check-count-error text-danger"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @php($attachmentCostEstimate = $project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['cost_estimate']))
                                                    <label>Cost Estimate <span class="text-danger f-w-550">*</span></label>
                                                    <input class="form-control js-upload-attachment js-attachment-mandatory js-fel2-attachment_cost_estimate col-md-10"
                                                           data-validated="{{isset($attachmentCostEstimate) ? 'true' : 'false'}}"
                                                           value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                                                    @if($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['cost_estimate']))
                                                        <a target="_blank"
                                                           class="js-attachment-existing-assessment"
                                                           href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel2']}}&file={{urlencode($project?->getAllAttachment($project->fel2?->attachment,$setting::FEL2_ATTACHMENT['cost_estimate']))}}">
                                                            <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                            {{$attachmentCostEstimate}}
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                                                <div class="js-error-file_size js-check-count-error text-danger"></div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
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
