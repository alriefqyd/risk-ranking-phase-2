@inject('setting',App\Models\Setting::class)
<h6 class="m-l-10 m-b-10">FEL 3 Form</h6>
<div class="table-responsive">
    <input type="hidden" class="js-project-id" value="{{$project->id}}">
    <table class="table table-striped js-table-assessment">
        <tbody>
        <tr>
            <td colspan="3">
                <div class="row">
                    <div class="col-md-3 mb-3 padding-right-0 w-20">
                        <label class="float-start">Executive Summary : </label>
                    </div>
                    <div class="col-md-3 m-t-4 float-start padding-left-0">
                        <div class="checkbox-rect">
                            <input id="checkbox-executive_summary_fel3"
                                   name="checkbox-executive_summary_fel3"
                                   {{$project?->fel3?->executive_summary == 1 ? 'checked' : ''}}
                                   class="js-checkbox-fel3" type="checkbox">
                            <label for="checkbox-executive_summary_fel3"></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <small>(The Executive Summary is a high level description of the project and describes how the project fits in to the PTI and business area strategic plan. This should describe the project objectives
                            backed up by an analysis of the organization’s current and projected future situation and the definition of its objectives. It is necessary to identify the overall reason for the initiative by
                            relating it to one or more objectives of the organization. The business case should describe the result that an organization needs to achieve).</small>

                        <textarea class="tinymce js-fel3-executive_summary_text"
                                  name="executive_summary_text"
                            {!! $project?->fel3?->executive_summary != 1 ? 'style="display: none"' : '' !!}>
                            {!! $project?->fel3?->executive_summary_text !!}
                        </textarea>
                        <input type="hidden" class="js-hidden-validate" name="validate_fel3_executive_summary">
                        <div class="col-md-12 txt-danger js-error-message"></div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <div class="row">
                    <div class="col-md-3 mb-3 padding-right-0 w-20">
                        <label class="float-start">Problem Statement  : </label>
                    </div>
                    <div class="col-md-3 m-t-4 float-start padding-left-0">
                        <div class="checkbox-rect">
                            <input id="checkbox-problem_statement_fel3"
                                   {{$project?->fel3?->problem_statement == 1 ? 'checked' : ''}}
                                   class="js-checkbox-fel3" type="checkbox">
                            <label for="checkbox-problem_statement_fel3"></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <small>(Provide description of problems, restrictions, constraints. How this problem impact to production, etc.).</small>

                        <textarea class="tinymce js-fel3-problem_statement_text"
                                  name="problem_statement_text"
                            {!! $project?->fel3?->problem_statement != 1 ? 'style="display: none"' : '' !!}>
                            {!! $project?->fel3?->problem_statement_text !!}
                        </textarea>
                        <input type="hidden" class="js-hidden-validate" name="validate_fel3_problem_statement">
                        <div class="col-md-12 txt-danger js-error-message"></div>
                    </div>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="3">
                <div class="row">
                    <div class="col-md-3 mb-3 padding-right-0 w-20">
                        <label class="float-start">Project Scope  : </label>
                    </div>
                    <div class="col-md-3 m-t-4 float-start padding-left-0">
                        <div class="checkbox-rect">
                            <input id="checkbox-project_scope_fel3"
                                   name="checkbox-project_scope_fel3"
                                   {{$project?->fel3?->project_scope == 1 ? 'checked' : ''}}
                                   class="js-checkbox-fel3" type="checkbox">
                            <label for="checkbox-project_scope_fel3"></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <small>
                            (According to previous stage, please update scopes of project as complete as this stage can.
                            More complete scope at this stage that will useful to figure schedule & cost for execution).
                        </small>

                        <textarea class="tinymce js-fel3-project_scope_text"
                                  name="project_scope_text"
                            {!! $project?->fel3?->project_scope != 1 ? 'style="display: none"' : '' !!}>
                            {!! $project?->fel3?->project_scope_text !!}
                        </textarea>
                        <input type="hidden" class="js-hidden-validate" name="validate_fel3_project_scope">
                        <div class="col-md-12 txt-danger js-error-message"></div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <div class="row">
                    <div class="col-md-3 mb-3 padding-right-0 w-20">
                        <label class="float-start">Alternatives And Best Option : </label>
                    </div>
                    <div class="col-md-3 m-t-4 float-start padding-left-0">
                        <div class="checkbox-rect">
                            <input id="checkbox-alternatives_best_option_fel3"
                                   {{$project?->fel3?->alternatives_and_best_option == 1 ? 'checked' : ''}}
                                   class="js-checkbox-fel3" type="checkbox">
                            <label for="checkbox-alternatives_best_option_fel3"></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <small>
                            (According to previous stage, please summary in one or two paragraph the alternatives and best option for this project).
                        </small>

                        <textarea class="tinymce js-fel3-alternatives_and_best_option_text"
                                  name="alternatives_and_best_option"
                            {!! $project?->fel3?->alternatives_and_best_option != 1 ? 'style="display: none"' : '' !!}>
                            {!! $project?->fel3?->alternatives_and_best_option_text !!}
                        </textarea>
                        <input type="hidden" class="js-hidden-validate"
                               name="validate_fel3_alternatives_and_best_option">
                        <div class="col-md-12 txt-danger js-error-message"></div>
                    </div>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="3">
                <div class="row js-row-schedule">
                    <div class="col-md-3 mb-3 padding-right-0 w-20">
                        <label class="float-start">Project Schedule : </label>
                    </div>
                    <div class="col-md-3 m-t-4 float-start padding-left-0">
                        <div class="checkbox-rect">
                            <input id="checkbox-project_schedule_fel3"
                                   {{$project?->fel3?->project_schedule == 1 ? 'checked' : ''}}
                                   class="js-checkbox-fel3 js-checkbox-schedule-fel3" type="checkbox">
                            <label for="checkbox-project_schedule_fel3"></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-striped js-table-schedule {{$project?->fel3?->project_schedule == 0 ? "d-none" : ""}}">
                            <thead>
                                <th style="width: 60%">Description</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th></th>
                            </thead>
                            <tbody>
                            @if($project->fel3?->getScheduleList()['isMilestone'] == true)
                                @foreach($project->fel3?->getScheduleList()['data'] as $data)
                                    <tr class="js-table-row-schedule" data-idx="0">
                                        <td class="w-25">
                                            <input class="form-control js-schedule-desc" name="schedule_desc[]" value="{{$data->desc}}">
                                        </td>
                                        <td>
                                            <input class="form-control js-schedule-start-date" type="date" value="{{$data->start_date}}" name="schedule_start_date[]">
                                        </td>
                                        <td>
                                            <input class="form-control js-schedule-end-date" type="date" value="{{$data->end_date}}" name="schedule_end_date[]">
                                        </td>
                                        <td>
                                            <i class="fa fa-trash-o text-danger cursor-pointer js-remove-schedule-fel3"></i>
                                            <i class="fa fa-plus-circle cursor-pointer js-add-new-schedule-fel3"></i>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="js-table-row-schedule" data-idx="0">
                                    <td class="w-25">
                                        <input class="form-control js-schedule-desc" name="schedule_desc[]">
                                    </td>
                                    <td>
                                        <input class="form-control js-schedule-start-date" type="date" name="schedule_start_date[]">
                                    </td>
                                    <td>
                                        <input class="form-control js-schedule-end-date" type="date" name="schedule_end_date[]">
                                    </td>
                                    <td>
                                        <i class="fa fa-trash-o text-danger cursor-pointer js-remove-schedule-fel3"></i>
                                        <i class="fa fa-plus-circle cursor-pointer js-add-new-schedule-fel3"></i>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
{{--                        @endif--}}
                    </div>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="3">
                <div class="row">
                    <div class="col-md-3 mb-3 padding-right-0 w-20">
                        <label class="float-start">List Of Equipment And Specification :</label>
                    </div>
                    <div class="col-md-3 m-t-4 float-start padding-left-0">
                        <div class="checkbox-rect">
                            <input id="checkbox-list_of_equipment_fel3"
                                   {{$project?->fel3?->list_of_equipment_and_specification == 1 ? 'checked' : ''}}
                                   class="js-checkbox-fel3" type="checkbox">
                            <label for="checkbox-list_of_equipment_fel3"></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <small>
                            (At this stage list of equipment can identify, mentioned at this paragraph & attached the reference or quotation).
                        </small>

                        <textarea class="tinymce js-fel3-list_of_equipment_text"
                                  name="list_of_equipment_and_specification"
                            {!! $project?->fel3?->list_of_equipment_and_specification != 1 ? 'style="display: none"' : '' !!}>
                            {!! $project?->fel3?->list_of_equipment_and_specification_text !!}
                        </textarea>
                        <input type="hidden" class="js-hidden-validate"
                               name="validate_fel3_list_of_equipment">
                        <div class="col-md-12 txt-danger js-error-message"></div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <div class="row">
                    <div class="col-md-3 mb-3 padding-right-0 w-20">
                        <label class="float-start">HAZOP Study :</label>
                    </div>
                    <div class="col-md-3 m-t-4 float-start padding-left-0">
                        <div class="checkbox-rect">
                            <input id="checkbox-hazop"
                                   {{$project?->fel3?->hazop_study == 1 ? 'checked' : ''}}
                                   class="js-checkbox-fel3" type="checkbox">
                            <label for="checkbox-hazop"></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <small>
                            (From preliminary design please conduct HAZOP Study, highlighted the main issue in one or two paragraph. Result of HAZOP study that has updated as reference for future stage/detail design).
                        </small>

                        <textarea class="tinymce js-fel3-hazop_study_text"
                                  name="hazop_study_text"
                            {!! $project?->fel3?->hazop_study != 1 ? 'style="display: none"' : '' !!}>
                            {!! $project?->fel3?->hazop_study_text !!}
                        </textarea>
                        <input type="hidden" class="js-hidden-validate"
                               name="validate_fel3_hazop_study">
                        <div class="col-md-12 txt-danger js-error-message"></div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <div class="row">
                    <div class="col-md-3 mb-3 padding-right-0 w-20">
                        <label class="float-start">Cost Estimate :</label>
                    </div>
                    <div class="col-md-3 m-t-4 float-start padding-left-0">
                        <div class="checkbox-rect">
                            <input id="checkbox-cost_estimate_fel3"
                                   {{$project?->fel3?->cost_estimate == 1 ? 'checked' : ''}}
                                   class="js-checkbox-fel3" type="checkbox">
                            <label for="checkbox-cost_estimate_fel3"></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <small>
                            (Develop cost estimate based on preliminary design with rough of magnitude 15 – 20%, at this paragraph put summary for detail put as attachment).
                        </small>

                        <div class="input-group mb-3 js-cost-estimate
                            {{$project?->fel3?->cost_estimate == 0 ? 'd-none' : ''}}">
                                <span class="input-group-text">$  </span>
                                <input class="form-control js-currency-format js-cost_estimate_assessment js-fel3-cost_estimate_text cold-md-12" type="text"
                                       name="fel3_cost_estimate"
                                       placeholder="xxx.xxx.xxx,xx"
                                       value="{{$project?->fel3?->cost_estimate_text}}"
                                       aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="3">
                <div class="row mb-3">
                    <label class="float-start">Attachment File : </label>
                </div>

                <div class="row">
                    <div class="table-responsive">
                        <table class="table-striped js-ta" style="width: 100%">
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @php($attachmentPreliminaryDesign = $project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['preliminary_design']))
                                            <label>Preliminary Design <span class="text-danger f-w-550">*</span> </label>
                                            <input class="form-control js-attachment-mandatory js-upload-attachment js-fel3-attachment_preliminary_design col-md-10"
                                                   data-validated="{{isset($attachmentPreliminaryDesign) ? 'true' : 'false'}}"
                                                   value="{{$project?->project_name}}" name="document" id="inputFile" data-idx="0" multiple type="file">
                                            @if($attachmentPreliminaryDesign)
                                                <a target="_blank"
                                                   href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{urlencode($project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['preliminary_design']))}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$attachmentPreliminaryDesign}}
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
                                            @php($attachmentUtilityDiagram = $project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['utility_infrastructure_facilities_diagram']))
                                            <label>Utility/Infrastructure/Facilities Diagram <span class="text-danger f-w-550">*</span> </label>
                                            <input class="form-control js-attachment-mandatory js-upload-attachment js-fel3-attachment_utility_infrastructure_facilities_diagram col-md-10"
                                                   data-validated="{{isset($attachmentUtilityDiagram) ? 'true' : 'false'}}"
                                                   value="{{$project?->project_name}}" name="document" id="inputFile" data-idx="0" multiple type="file">
                                            @if($attachmentUtilityDiagram)
                                                <a target="_blank"
                                                   href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{urlencode($project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['utility_infrastructure_facilities_diagram']))}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$attachmentUtilityDiagram}}
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
                                            @php($attachmentHazop = $project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['hazop']))
                                            <label>HAZOP Study/GPRA/WI (Risk Assessment) <span class="text-danger f-w-550">*</span> </label>
                                            <input class="form-control js-upload-attachment js-attachment-mandatory js-fel3-attachment_hazop col-md-10" value="{{$project?->project_name}}"
                                                   data-validated="{{isset($attachmentHazop)  ? 'true' : 'false'}}"
                                                   name="document" id="inputFile" multiple type="file">
                                            @if($attachmentHazop)
                                                <a target="_blank"
                                                   href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{urlencode($project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['hazop']))}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$attachmentHazop}}
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
                                            @php($attachmentMoc = $project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['moc_document']))
                                            <label>MoC Document  <span class="text-danger f-w-550">*</span> </label>
                                            <input class="form-control js-upload-attachment js-attachment-mandatory js-fel3-attachment_moc_document col-md-10" value="{{$project?->project_name}}"
                                                   data-validated="{{isset($attachmentMoc)  ? 'true' : 'false'}}"
                                                   name="document" id="inputFile" multiple type="file">
                                            @if($attachmentMoc)
                                                <a target="_blank"
                                                   href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{urlencode($project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['hazop']))}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$attachmentMoc}}
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
                                            @php($attachmentCostEstimate = $project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['cost_estimate']))
                                            <label>Cost Estimate with rough of magnitude 15-20%<span class="text-danger f-w-550">*</span> </label>
                                            <input class="form-control js-upload-attachment js-attachment-mandatory js-fel3-cost_estimate col-md-10" value="{{$project?->project_name}}"
                                                   data-validated="{{isset($attachmentCostEstimate)  ? 'true' : 'false'}}"
                                                   name="document" id="inputFile" multiple type="file">
                                            @if($attachmentCostEstimate)
                                                <a target="_blank"
                                                   href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{urlencode($project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['cost_estimate']))}}">
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
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @php($attachmentQuotation = $project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['quotation_of_equipment']))
                                            <label>Quotation of equipment/Site Query <span class="text-danger f-w-550">*</span> </label>
                                            <input class="form-control js-upload-attachment js-attachment-mandatory js-fe3-attachment_quotation_of_equipment col-md-10"
                                                   value="{{$project?->project_name}}"
                                                   data-validated="{{isset($attachmentQuotation)  ? 'true' : 'false'}}"
                                                   name="document" id="inputFile" multiple type="file">
                                            @if($attachmentQuotation)
                                                <a target="_blank"
                                                   href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{urlencode($project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['quotation_of_equipment']))}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['quotation_of_equipment'])}}
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
                                            @php($attachmentAssessment = $project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['project_level_assessment']))
                                            <label>Project Level Assessment Document <span class="text-danger f-w-550">*</span> </label>
                                            <input class="form-control js-upload-attachment js-attachment-mandatory js-fel3-attachment_project_level_assessment col-md-10"
                                                   data-validated="{{isset($attachmentAssessment)  ? 'true' : 'false'}}"
                                                   value="{{$project?->project_name}}"
                                                   name="document" id="inputFile" multiple type="file">
                                            @if($attachmentAssessment)
                                                <a target="_blank"
                                                   href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{urlencode($project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['project_level_assessment']))}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$attachmentAssessment}}
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
                                            @php($attachmentFel1 = $project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['fel1']))
                                            <label>FEL 1 Engineering Report (if though FEL 1) <span class="text-danger f-w-550">*</span> </label>
                                            <input class="form-control js-upload-attachment js-attachment-mandatory js-fel3-attachment_fel1 col-md-10"
                                                   value="{{$project?->project_name}}"
                                                   data-validated="{{isset($attachmentFel1)  ? 'true' : 'false'}}"
                                                   name="document" id="inputFile" multiple type="file">
                                            @if($attachmentFel1)
                                                <a target="_blank"
                                                   href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{urlencode($project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['fel1']))}}">
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
                                            @php($attachmentFel2 = $project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['fel2']))
                                            <label>FEL 2 – Engineering Report (if through FEL 2)<span class="text-danger f-w-550">*</span> </label>
                                            <input class="form-control js-upload-attachment js-attachment-mandatory js-fel3-attachment_fel2 col-md-10"
                                                   value="{{$project?->project_name}}"
                                                   data-validated="{{isset($attachmentFel2)  ? 'true' : 'false'}}"
                                                   name="document" id="inputFile" multiple type="file">
                                            @if($attachmentFel2)
                                                <a target="_blank"
                                                   href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{urlencode($project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['fel2']))}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$attachmentFel2}}
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
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div class="row">
    <input type="hidden" name="validate_check_empty_count" class="js-validate-checkbox-count">
</div>
