@inject('setting',App\Models\Setting::class)
<div class="table-responsive">
    <input type="hidden" class="js-project-id" value="{{$project->id}}">
    <table class="table table-striped js-table-assessment">
        <tbody>
        <tr>
            <td colspan="3">
                <div class="row">
                    <div class="col-md-3 mb-3 padding-right-0 w-20">
                        <label class="float-start">Project Scope <span class="text-danger f-w-550">*</span> : </label>
                    </div>
                    <div class="col-md-3 m-t-5 float-start padding-left-0">
                        <div class="checkbox-rect">
                            <input id="checkbox-project-scope-fel1"
                                   {{$project?->fel1?->project_scope == 1 ? 'checked' : ''}}
                                   class="js-checkbox-assessment js-checkbox-fel1 js-check-project-scope" type="checkbox">
                            <label for="checkbox-project-scope-fel1"></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <small>(Identify the scopes of project as complete as this stage can. More complete scope at this stage that will useful to get several alternatives). </small>
                        <textarea class="tinymce js-fel1-text-project-scope"
                                  name="project_scope_text"
                                  {!! $project?->fel1?->project_scope != 1 ? 'style="display: none"' : '' !!}>
                                {!! $project?->fel1?->project_scope_text !!}
                        </textarea>
                        <input type="hidden" class="js-hidden-validate" name="validate_fel1_project_scope">
                        <div class="col-md-12 txt-danger js-error-message"></div>
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
                        <table class="table-striped" style="width: 100%">
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @php($attachmentParameterRegulation = $project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['parameter_regulation_requirement']))
                                            <label>Parameter, Regulation, Requirement <span class="text-danger f-w-550">*</span> </label>
                                            <input class="form-control js-upload-attachment js-attachment-mandatory js-fel1-attachment_parameter_regulation_requirement col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                                            @if(isset($attachmentParameterRegulation))
                                                <a target="_blank"
                                                   class="js-attachment-existing-assessment"
                                                   href="/preview?id={{$project->id}}&dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel1']}}&file={{urlencode($project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['parameter_regulation_requirement']))}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$attachmentParameterRegulation}}
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
                                            @php($attachmentProcessDiagram = $project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['initial_process_diagram']))
                                            <label>Initial Process Diagram (Alur)<span class="text-danger f-w-550">*</span> </label>
                                            <input class="form-control js-upload-attachment js-attachment-mandatory js-fel1-attachment_initial_progress_diagram col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                                            @if(isset($attachmentProcessDiagram))
                                                <a target="_blank"
                                                   class="js-attachment-existing-assessment"
                                                   href="/preview?id={{$project->id}}&dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel1']}}&file={{urlencode($project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['initial_process_diagram']))}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$attachmentProcessDiagram}}
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
                                            @php($attachmentDataOfAlternative = $project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['data_of_alternatives']))
                                            <label>Data of Alternatives (drawing/figure, cost of investment & operation, maintenance, etc.)<span class="text-danger f-w-550">*</span> </label>
                                            <input class="form-control js-upload-attachment js-attachment-mandatory js-fel1-attachment_data_of_alternatives col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                                            @if(isset($attachmentDataOfAlternative))
                                                <a target="_blank"
                                                   class="js-attachment-existing-assessment"
                                                   href="/preview?id={{$project->id}}&dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel1']}}&file={{urlencode($project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['data_of_alternatives']))}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$attachmentDataOfAlternative}}
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
                                            @php($attachmentInitialSchedule = $project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['initial_schedule']))
                                            <label>Initial schedule until level 1 </label>
                                            <input class="form-control js-upload-attachment js-fel1-attachment_initial_schedule col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                                            @if(isset($attachmentInitialSchedule))
                                                <a target="_blank"
                                                   class="js-attachment-existing-assessment"
                                                   href="/preview?id={{$project->id}}&dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel1']}}&file={{urlencode($project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['initial_schedule']))}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$attachmentInitialSchedule}}
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
                                            @php($projectLevelAssessment = $project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['project_level_assessment']))
                                            <label>Project Level Assessment<span class="text-danger f-w-550">*</span> </label>
                                            <input class="form-control js-upload-attachment js-attachment-mandatory js-fel1-attachment_project_level_assessment col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                                            @if(isset($projectLevelAssessment))
                                                <a target="_blank"
                                                   class="js-attachment-existing-assessment"
                                                   href="/preview?id={{$project->id}}&dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel1']}}&file={{urlencode($project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['project_level_assessment']))}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$projectLevelAssessment}}
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
                                            @php($stakeholderList = $project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['stakeholder_list']))
                                            <label>Stakeholder List </label>
                                            <input class="form-control js-upload-attachment js-fel1-attachment_stakeholder_list col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                                            @if(isset($stakeholderList))
                                                <a target="_blank"
                                                   class="js-attachment-existing-assessment"
                                                   href="/preview?id={{$project->id}}&dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel1']}}&file={{urlencode($project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['stakeholder_list']))}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$stakeholderList}}
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
                                            @php($attachmentFel1Approve = $project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['fel1_approve']))
                                            <label>FEL 1 Approve<span class="text-danger f-w-550">*</span> </label>
                                            <input class="form-control js-upload-attachment js-attachment-mandatory js-fel1-attachment_fel1_approve col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                                            @if(isset($attachmentFel1Approve))
                                                <a target="_blank"
                                                   class="js-attachment-existing-assessment"
                                                   href="/preview?id={{$project->id}}&dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel1']}}&file={{urlencode($project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['fel1_approve']))}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$attachmentFel1Approve}}
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
