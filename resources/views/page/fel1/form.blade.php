@inject('setting',App\Models\Setting::class)
<div class="table-responsive">
    <input type="hidden" class="js-project-id" value="{{$project->id}}">
    <table class="table table-striped js-table-assessment">
        <tbody>
        <tr>
            <td style="width: 100px">Project Scope Statement : </td>
            <td style="width: 10px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-project_scope"
                           {{$project?->fel1?->project_scope == 1 ? 'checked' : ''}}
                           name="project_scope" class="js-checkbox-fel1" type="checkbox">
                    <label for="checkbox-project_scope"></label>
                </div>
            </td>
            <td style="width: 69%">
                <small>(Identify the scopes of project as complete as this stage can. More complete scope at this stage that will useful to get several alternatives). </small>
                <textarea class="tinymce js-fel1-text-project-scope"
                          name="project_scope_text"
                          {!! $project?->fel1?->project_scope != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->fel1?->project_scope_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_fel1_project_scope">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Identified Parameter, <br>Requirement & Regulation : </td>
            <td style="width: 10px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-identified_parameter"
                           {{$project?->fel1?->identified_parameter_requirement_regulation == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel1" type="checkbox">
                    <label for="checkbox-identified_parameter"></label>
                </div>
            </td>
            <td style="width: 69%">
                <small>(Highlighted what parameter, requirement & regulation should fulfilled/refer to, for detail/document put as attachment). </small>
                <textarea class="tinymce js-text-identified_parameter_text"
                          name="identified_parameter_text"
                          {!! $project?->fel1?->identified_parameter_requirement_regulation != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->fel1?->identified_parameter_requirement_regulation_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_fel1_identified">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Alternatives : </td>
            <td style="width: 10px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-alternatives"
                           {{$project?->fel1?->alternatives == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel1" type="checkbox">
                    <label for="checkbox-alternatives"></label>
                </div>
            </td>
            <td style="width: 69%">
                <small>(Take several options that can take as options to meet objectives of project. Highlight each options, described cost of investment & operation/maintenance with rough of magnitude 40 – 50%. Put the breakdown of data each option at attachment).</small>
                <textarea class="tinymce js-text-alternatives_text"
                          name="alternatives_text"
                          {!! $project?->fel1?->alternatives != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->fel1?->alternatives_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_fel1_alternatives">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>List of Stakeholder :</td>
            <td style="width: 10px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-list_of_stakeholder"
                           {{$project?->fel1?->list_of_stakeholder == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel1" type="checkbox">
                    <label for="checkbox-list_of_stakeholder"></label>
                </div>
            </td>
            <td style="width: 69%">
                <small>(Identify & listed the stakeholder that should involving at this project. More detail stakeholder list, this would beneficial for project to identify their influence).</small>
                <textarea class="tinymce js-text-list_of_stakeholder_text"
                          name="list_of_stakeholder_text"
                          {!! $project?->fel1?->list_of_stakeholder != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->fel1?->list_of_stakeholder_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_fel1_list_stakeholder">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Schedule Project :</td>
            <td style="width: 10px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-schedule"
                           {{$project?->fel1?->schedule_project == 1 ? 'checked' : ''}}
                           class="js-checkbox-fel1" type="checkbox">
                    <label for="checkbox-schedule"></label>
                </div>
            </td>
            <td style="width: 69%">
                <small>(According several information such as scope, experience please develop schedule of project at least until level 1). </small>
                <textarea class="tinymce js-text-schedule_project_text"
                          name="schedule_project_text"
                          {!! $project?->fel1?->schedule_project != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->fel1?->schedule_project_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_fel1_schedule">
                <div class="col-md-12 txt-danger js-error-message"></div>
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
                        <label>Parameter, Regulation, Requirement</label>
                        <input class="form-control js-fel1-attachment_parameter_regulation_requirement col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['parameter_regulation_requirement']))
                            <a target="_blank"
                               href="/preview?id={{$project->id}}&dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel1']}}&file={{$project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['parameter_regulation_requirement'])}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['parameter_regulation_requirement'])}}
                            </a>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label>Initial Process Diagram (Alur)</label>
                        <input class="form-control js-fel1-attachment_initial_progress_diagram col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['initial_process_diagram']))
                            <a target="_blank"
                               href="/preview?id={{$project->id}}&dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['fel1']}}&file={{$project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['initial_process_diagram'])}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['initial_process_diagram'])}}
                            </a>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label>Data of Alternatives (drawing/figure, cost of investment & operation, maintenance, etc.)</label>
                        <input class="form-control js-fel1-attachment_data_of_alternatives col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['data_of_alternatives']))
                            <a target="_blank"
                               href="/preview?dir={{$project->project_name}}&category={{$setting::FOLDER_TYPE['fel1']}}&file={{$project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['data_of_alternatives'])}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['data_of_alternatives'])}}
                            </a>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label>Initial schedule until level 1</label>
                        <input class="form-control js-fel1-attachment_initial_schedule col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['initial_schedule']))
                            <a target="_blank"
                               href="/preview?dir={{$project->project_name}}&category={{$setting::FOLDER_TYPE['fel1']}}&file={{$project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['initial_schedule'])}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['initial_schedule'])}}
                            </a>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label>Project level assessment</label>
                        <input class="form-control js-fel1-attachment_project_level_assessment col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['project_level_assessment']))
                            <a target="_blank"
                               href="/preview?id={{$project->id}}&category={{$setting::FOLDER_TYPE['fel1']}}&file={{$project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['project_level_assessment'])}}&dir={{$project->project_name}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['project_level_assessment'])}}
                            </a>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label>Stakeholder list </label>
                        <input class="form-control js-fel1-attachment_stakeholder_list col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                        @if($project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['stakeholder_list']))
                            <a target="_blank"
                               href="/preview?id={{$project->id}}&category={{$setting::FOLDER_TYPE['fel1']}}&file={{$project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['stakeholder_list'])}}&dir={{$project->project_name}}">
                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                {{$project?->getAllAttachment($project->fel1?->attachment,$setting::FEL1_ATTACHMENT['stakeholder_list'])}}
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
