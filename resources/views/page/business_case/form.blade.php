@inject('setting',App\Models\Setting::class)
<div class="table-responsive js-table-cost-benefit">
    <input type="hidden" class="js-project-id" value="{{$project->id}}">
    <table class="table table-striped js-table-assessment">
        <tbody>

        <tr>
            <td colspan="3">
                <div class="row">
                    <div class="col-md-3 mb-3 padding-right-0 w-20">
                        <label class="float-start">Specific Scope of Work <span class="text-danger f-w-550">*</span> : </label>
                    </div>
                    <div class="col-md-3 m-t-5 float-start padding-left-0">
                        <div class="checkbox-rect">
                            <input id="checkbox-scope_of_work"
                                   {{$project?->business_case?->project_scope_of_work == 1 ? 'checked' : ''}}
                                   class="js-checkbox-business_case" type="checkbox">
                            <label for="checkbox-scope_of_work"></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <small>(Identify the scopes of project as complete as this stage can. More complete scope at this stage that will useful to get several alternatives). </small>
                        <textarea class="tinymce js-bc_scope_of_work"
                            {!! $project?->business_case?->project_scope_of_work != 1 ? 'style="display: none"' : '' !!}>
                            {!! $project?->business_case?->project_scope_of_work_text !!}
                        </textarea>
                        <input type="hidden" class="js-hidden-validate" name="validate_bc_project_scope_of_work">
                        <div class="col-md-12 txt-danger js-error-message"></div>
                    </div>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="3">
                <div class="row">
                    <div class="col-md-3 mb-3 padding-right-0 w-20">
                        <label class="float-start">Financial Evaluation <span class="text-danger f-w-550">*</span> : </label>
                    </div>
                    <div class="col-md-3 m-t-5 float-start padding-left-0">
                        <div class="checkbox-rect">
                            <input id="checkbox-financial_evaluation"
                                   {{$project?->business_case?->financial_evaluation == 1 ? 'checked' : ''}}
                                   class="js-checkbox-business_case" type="checkbox">
                            <label for="checkbox-financial_evaluation"></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table class="js-table-financial-evaluation
                            {!! $project?->business_case?->financial_evaluation != 1 ? 'd-none' : '' !!}"
                        style="width: 100%">
                            <tr>
                                <td style="width: 20%">NPV</td>
                                <td >
                                    <div class="input-group">
                                        <span class="input-group-text">$  </span>
                                        <input type="text" value="{{$project?->business_case?->npv}}" name="cost_estimate" class="js-currency-format form-control js_bc_npv" data-default="{{$project?->assessment?->cost_estimate_text}}">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 20%">IRR</td>
                                <td>
                                    <div class="input-group">
                                        <input type="number" value="{{$project?->business_case?->irr}}" name="cost_estimate" class="form-control js_bc_irr" data-default="{{$project?->assessment?->cost_estimate_text}}">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 20%">Payback Period</td>
                                <td>
                                    <div class="input-group">
                                        <input type="number" value="{{$project?->business_case?->payback_period}}" name="cost_estimate" class="form-control js_bc_payback_period" data-default="{{$project?->assessment?->cost_estimate_text}}">
                                        <span class="input-group-text">Years</span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="3">
                <div class="row">
                    <div class="col-md-3 mb-3 padding-right-0 w-20">
                        <label class="float-start">Risk Assessment <span class="text-danger f-w-550">*</span> : </label>
                    </div>
                    <div class="col-md-2 m-t-5 float-start padding-left-0">
                        <div class="checkbox-rect">
                            <input id="checkbox-risk_assessment"
                                   {{$project?->business_case?->risk_assessment == 1 ? 'checked' : ''}}
                                   class="js-checkbox-business_case js-checkbox-risk_assessment" type="checkbox">
                            <label for="checkbox-risk_assessment"></label>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="loader-box d-none">
                            <div class="loader-2"
                                 style="width: 25px !important;
                                height: 25px !important;
                                 border-right-color: #24695c ;
                                border-left-color: #24695c ">
                            </div>
                        </div>
                        <ul class="mt-4 js-risk-assessment-bc {{$project?->business_case?->risk_assessment != 1 ? 'd-none' : ''}}" style="margin-left: 0px ;">
                            <li>
                                <div class="rating-container">
                                    People :
                                    <select id="u-rating-movie" class="rating-custom js-risk-people js-risk-assessment-field" name="rating" autocomplete="off">
                                        @foreach($riskLevel as $index => $value)
                                            <option value></option>
                                            @if($index > 0)
                                                <option {{$index == $project?->business_case?->riskAssessment?->people ? 'selected' : ''}} value="{{$index}}">{{$value}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="rating-container">
                                    Environment :
                                    <select id="u-rating-movie" class="rating-custom js-risk-environment js-risk-assessment-field" name="rating" autocomplete="off">
                                        <option value></option>
                                        @foreach($riskLevel as $index => $value)
                                            @if($index > 0)
                                                <option {{$index == $project?->business_case?->riskAssessment?->environment ? 'selected' : ''}} value="{{$index}}">{{$value}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="rating-container">
                                    Social and Human Rights :
                                    <select id="u-rating-movie" class="rating-custom js-risk-human-rights js-risk-assessment-field" name="rating" autocomplete="off">
                                        <option value></option>
                                        @foreach($riskLevel as $index => $value)
                                            @if($index > 0)
                                                <option {{$index == $project?->business_case?->riskAssessment?->social_and_human_rights ? 'selected' : ''}} value="{{$index}}">{{$value}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                            <li>
                                Reputation
                                <select id="u-rating-movie" class="rating-custom js-risk-reputation js-risk-assessment-field" name="rating" autocomplete="off">
                                    <option value></option>
                                    @foreach($riskLevel as $index => $value)
                                        @if($index > 0)
                                            <option {{$index == $project?->business_case?->riskAssessment?->reputation ? 'selected' : ''}} value="{{$index}}">{{$value}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </li>
                            <li>
                                Finance :
                                <select id="u-rating-movie" class="rating-custom js-risk-finance js-risk-assessment-field" name="rating" autocomplete="off">
                                    <option value></option>
                                    @foreach($riskLevel as $index => $value)
                                        @if($index > 0)
                                            <option {{$index == $project?->business_case?->riskAssessment?->finance ? 'selected' : ''}} value="{{$index}}">{{$value}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </li>
                            <li>
                                Final Impact Score :
                                <div class="rating-container digits">
                                    <select class="u-rating-1to10" data-readonly="true" class="js-risk-final-impact js-risk-assessment-field" name="rating" autocomplete="off">
                                        @for($i=1;$i<7;$i++)
                                            <option value="{{$i}}" {{$i == $project?->business_case?->riskAssessment?->final_impact_score ? 'selected' : ''}}>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </li>
                            <li>
                                Probability :
                                <select id="u-rating-movie" class="rating-custom js-risk-probability js-risk-assessment-field" name="rating" autocomplete="off">
                                    <option value></option>
                                    @foreach($probability as $index => $value)
                                        @if($index > 0)
                                            <option {{$index == $project?->business_case?->riskAssessment?->probability ? 'selected' : ''}} value="{{$index}}">{{$value}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </li>
                            <li class="mt-2">
                                <p>Priority Level :
                                    <span class="js-set-label-priority-level setting-primary">
                                {{$project?->business_case?->riskAssessment?->priority_level}}
                            </span>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="3">
                <div class="row">
                    <div class="col-md-3 mb-3 padding-right-0 w-20">
                        <label class="float-start">Cost Estimate <span class="text-danger f-w-550">*</span> : </label>
                    </div>
                    <div class="col-md-9 m-t-5 float-start padding-left-0">
                        <div class="checkbox-rect">
                            <div class="input-group mb-3">
                                <span class="input-group-text">$  </span>
                                <input type="text" value="{{$project?->business_case?->cost_estimate}}" name="cost_estimate"
                                       class="form-control js-cost_estimate_bc js-currency-format"
                                       data-default="{{$project?->assessment?->cost_estimate_text}}">
                            </div>
                            @if($project?->assessment?->cost_estimate_text)
                                <input id="checkbox-same-cost-estimate" type="checkbox">
                                <label for="checkbox-same-cost-estimate">same as cost estimate project level assessment</label>
                            @endif
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
                        <table class="table-striped" style="width: 100%">
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @php($attachmentFel3 = $project?->getAllAttachment($project->business_case?->attachment,'fel3'))
                                            <label>FEL 3 Approved Document <span class="text-danger f-w-550">*</span> </label>
                                            <input class="form-control js-attachment-mandatory js-upload-attachment js-business_case-fel3_approved col-md-10"
                                                   value="{{$project?->project_name}}" name="document" id="inputFile" data-idx="0" multiple type="file">
                                            @if($project?->getAllAttachment($project->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['fel3']))
                                                <a target="_blank"
                                                   class="js-attachment-existing-assessment"
                                                   href="/preview?id={{$project->id}}&category={{$setting::FOLDER_TYPE['bc']}}&file={{urlencode($project?->getAllAttachment($project->assessment?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['fel3']))}}&dir={{$project->project_name}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$attachmentFel3}}
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
                                            @php($attachmentChangeRequest= $project?->business_case?->change_management_request)
                                            <label>Change Management Request </label>
                                            <input class="form-control js-upload-attachment js-bc-change_management_request col-md-10"
                                                   data-validated="true"
                                                   name="document" id="inputFile" multiple type="file">
                                            @if($attachmentChangeRequest)
                                                <a target="_blank"
                                                   href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['bc']}}&file={{urlencode($attachmentChangeRequest)}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$attachmentChangeRequest}}
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
                                            @php($attachmentAdditional = $project?->getAllAttachment($project->business_case?->attachment,'business_case'))
                                            <label>Additional Attachment  </label>
                                            <input class="form-control js-upload-attachment js-upload-zip js-bc-attachment_file col-md-10"
                                                   data-validated="true"
                                                   value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                                            @if($project?->getAllAttachment($project->business_case?->attachment,'business_case'))
                                                <a target="_blank"
                                                   href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['bc']}}&file={{urlencode($project?->getAllAttachment($project->business_case?->attachment,'business_case'))}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$project?->getAllAttachment($project->business_case?->attachment,'business_case')}}
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
