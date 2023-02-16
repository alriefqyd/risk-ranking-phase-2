@inject('setting',App\Models\Setting::class)
<h6 class="m-l-10 m-b-10">FEL 3 Form</h6>
<div class="table-responsive">
    <input type="hidden" class="js-project-id" value="{{$project->id}}">
    <table class="table table-striped js-table-assessment">
        <tbody>
        <tr>
            <td style="width: 200px">Executive Summary : </td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-executive_summary-fel3"
                           {{$project?->fel3?->executive_summary == 1 ? 'checked' : ''}}
                           name="project_scope" class="js-checkbox-fel3" type="checkbox">
                    <label for="checkbox-executive_summary-fel3"></label>
                </div>
            </td>
            <td style="width: 69%">
                <small>
                    (The Executive Summary is a high level description of the project and describes how the project fits in to the PTI and business area strategic plan. This should describe the project objectives
                    backed up by an analysis of the organization’s current and projected future situation and the definition of its objectives. It is necessary to identify the overall reason for the initiative by
                    relating it to one or more objectives of the organization. The business case should describe the result that an organization needs to achieve).
                </small>
                <textarea class="tinymce js-fel3-executive_summary_text"
                          name="executive_summary_text"
                    {!! $project?->fel3?->executive_summary != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->fel3?->executive_summary_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_fel3_executive_summary">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Problem Statement </td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-problem_statement_fel3"
                           {{$project?->fel3?->problem_statement == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel3" type="checkbox">
                    <label for="checkbox-problem_statement_fel3"></label>
                </div>
            </td>
            <td style="width: 69%">
                <small>
                    (Provide description of problems, restrictions, constraints. How this problem impact to production, etc.).
                </small>
                <textarea class="tinymce js-fel3-problem_statement_text"
                          name="problem_statement_text"
                    {!! $project?->fel3?->problem_statement != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->fel3?->problem_statement_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_fel3_problem_statement">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Project Scope  : </td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-project_scope_fel3"
                           {{$project?->fel3?->project_scope == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel3" type="checkbox">
                    <label for="checkbox-project_scope_fel3"></label>
                </div>
            </td>
            <td style="width: 69%">
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
            </td>
        </tr>
        <tr>
            <td>Alternatives And Best Option :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-alternatives_best_option_fel3"
                           {{$project?->fel3?->alternatives_and_best_option == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel3" type="checkbox">
                    <label for="checkbox-alternatives_best_option_fel3"></label>
                </div>
            </td>
            <td style="width: 69%">
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
            </td>
        </tr>
        <tr>
            <td>Project Schedule :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-project_schedule_fel3"
                           {{$project?->fel3?->project_schedule == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel3" type="checkbox">
                    <label for="checkbox-project_schedule_fel3"></label>
                </div>
            </td>
            <td style="width: 69%">
                <small>
                    (Highlight the schedule, for breakdown until level 3 put as attachment).
                </small>
                <textarea class="tinymce js-fel3-project_schedule_text"
                          name="project_schedule"
                    {!! $project?->fel3?->project_schedule != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->fel3?->project_schedule_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate"
                       name="validate_fel3_project_schedule">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>List Of Equipment And Specification :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-list_of_equipment_fel3"
                           {{$project?->fel3?->list_of_equipment_and_specification == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel3" type="checkbox">
                    <label for="checkbox-list_of_equipment_fel3"></label>
                </div>
            </td>
            <td style="width: 69%">
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
            </td>
        </tr>
        <tr>
            <td>HAZOP Study :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-hazop"
                           {{$project?->fel3?->hazop_study == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel3" type="checkbox">
                    <label for="checkbox-hazop"></label>
                </div>
            </td>
            <td style="width: 69%">
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
            </td>
        </tr>
        <tr>
            <td>Cost Estimate :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-cost_estimate_fel3"
                           {{$project?->fel3?->cost_estimate == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel3" type="checkbox">
                    <label for="checkbox-cost_estimate_fel3"></label>
                </div>
            </td>
            <td style="width: 69%">
                <small>
                    (Develop cost estimate based on preliminary design with rough of magnitude 15 – 20%, at this paragraph put summary for detail put as attachment).
                </small>
                <div class="input-group mb-3 js-cost-estimate
                    {{$project?->fel3?->cost_estimate == 0 ? 'd-none' : ''}}"
                ><span class="input-group-text">$  </span>
                    <input class="form-control js-currency-format js-cost_estimate_assessment js-fel3-cost_estimate_text cold-md-12" type="text"
                           name="fel3_cost_estimate"
                           value="{{$project?->fel3?->cost_estimate_text}}"
                           aria-label="Amount (to the nearest dollar)">
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
                        <label>Preliminary Design</label>
                        <input class="form-control js-upload-attachment js-fel3-attachment_preliminary_design col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['preliminary_design']))
                            <a target="_blank"
                               href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['preliminary_design'])}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['preliminary_design'])}}
                            </a>
                        @endif
                    </div>
                    <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                    <div class="js-error-file_size js-check-count-error text-danger"></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label>Utility/Infrastructure/Facilities Diagram</label>
                        <input class="form-control js-upload-attachment js-fel3-attachment_utility_infrastructure_facilities_diagram
                        col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['utility_infrastructure_facilities_diagram']))
                            <a target="_blank"
                               href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['utility_infrastructure_facilities_diagram'])}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['utility_infrastructure_facilities_diagram'])}}
                            </a>
                        @endif
                    </div>
                    <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                    <div class="js-error-file_size js-check-count-error text-danger"></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label>HAZOP Study/GPRA/WI (Risk Assessment)</label>
                        <input class="form-control js-upload-attachment js-fel3-attachment_hazop col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['hazop']))
                            <a target="_blank"
                               href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['hazop'])}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['hazop'])}}
                            </a>
                        @endif
                    </div>
                    <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                    <div class="js-error-file_size js-check-count-error text-danger"></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label>MoC Document </label>
                        <input class="form-control js-upload-attachment js-fel3-attachment_moc_document col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['moc_document']))
                            <a target="_blank"
                               href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['moc_document'])}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['moc_document'])}}
                            </a>
                        @endif
                    </div>
                    <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                    <div class="js-error-file_size js-check-count-error text-danger"></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label>Cost Estimate with rough of magnitude 15-20%</label>
                        <input class="form-control js-upload-attachment js-fel3-cost_estimate col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['cost_estimate']))
                            <a target="_blank"
                               href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['cost_estimate'])}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['cost_estimate'])}}
                            </a>
                        @endif
                    </div>
                    <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                    <div class="js-error-file_size js-check-count-error text-danger"></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label>Quotation of equipment/Site Query </label>
                        <input class="form-control js-upload-attachment js-fe3-attachment_quotation_of_equipment col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['quotation_of_equipment']))
                            <a target="_blank"
                               href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['quotation_of_equipment'])}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['quotation_of_equipment'])}}
                            </a>
                        @endif
                    </div>
                    <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                    <div class="js-error-file_size js-check-count-error text-danger"></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label>Project Level Assessment Document</label>
                        <input class="form-control js-upload-attachment js-fel3-attachment_project_level_assessment col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['project_level_assessment']))
                            <a target="_blank"
                               href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['project_level_assessment'])}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['project_level_assessment'])}}
                            </a>
                        @endif
                    </div>
                    <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                    <div class="js-error-file_size js-check-count-error text-danger"></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label>FEL 1 Engineering Report (if though FEL 1)</label>
                        <input class="form-control js-upload-attachment js-fel3-attachment_fel1 col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['fel1']))
                            <a target="_blank"
                               href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['fel1'])}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['fel1'])}}
                            </a>
                        @endif
                    </div>
                    <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                    <div class="js-error-file_size js-check-count-error text-danger"></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label>FEL 2 – Engineering Report (if through FEL 2)</label>
                        <input class="form-control js-upload-attachment js-fel3-attachment_fel2 col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['fel2']))
                            <a target="_blank"
                               href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel3']}}&file={{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['fel2'])}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->fel3?->attachment,$setting::FEL3_ATTACHMENT['fel2'])}}
                            </a>
                        @endif
                    </div>
                    <div class="js-error-attachment_extension js-check-count-error text-danger"></div>
                    <div class="js-error-file_size js-check-count-error text-danger"></div>
                </div>
                <hr>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div class="row">
    <input type="hidden" name="validate_check_empty_count" class="js-validate-checkbox-count">
</div>
