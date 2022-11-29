@inject('setting',App\Models\Setting::class)
<div class="table-responsive js-table-cost-benefit">
    <input type="hidden" class="js-project-id" value="{{$project->id}}">
    <table class="table table-striped js-table-assessment">
        <tbody>
        <tr>
            <td style="width: 23%">Problem Statement And Objective : </td>
            <td style="width: 270px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-problem_and_objective"
                           {{$project?->business_case?->problem_statement_and_objective == 1 ? 'checked' : ''}}
                            class="js-checkbox-business_case" type="checkbox">
                    <label for="checkbox-problem_and_objective"></label>
                </div>
            </td>
            <td style="width: 68%">
                <textarea class="tinymce js-bc_problem_and_objective"
                          name="executive_summary_text"
                    {!! $project?->business_case?->problem_statement_and_objective != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->business_case?->problem_statement_and_objective_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_bc_problem_and_objective">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Project Alternatives </td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-project_alternative"
                           {{$project?->business_case?->project_alternatives == 1 ? 'checked' : ''}}
                           class="js-checkbox-business_case" type="checkbox">
                    <label for="checkbox-project_alternative"></label>
                </div>
            </td>
            <td style="width: 65%">
                <textarea class="tinymce js-bc_project_alternative_text"
                          name="project_alternative_text"
                    {!! $project?->business_case?->project_alternatives != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->business_case?->project_alternatives_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_bc_project_alternative">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Project Scope of Work  : </td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-scope_of_work"
                           {{$project?->business_case?->project_scope_of_work == 1 ? 'checked' : ''}}
                           class="js-checkbox-business_case" type="checkbox">
                    <label for="checkbox-scope_of_work"></label>
                </div>
            </td>
            <td style="width: 65%">
                <textarea class="tinymce js-bc_scope_of_work"
                    {!! $project?->business_case?->project_scope_of_work != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->business_case?->project_scope_of_work_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_bc_project_scope_of_work">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Major Equipment :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-major_equipment"
                           {{$project?->business_case?->major_equipment == 1 ? 'checked' : ''}}
                           class="js-checkbox-business_case" type="checkbox">
                    <label for="checkbox-major_equipment"></label>
                </div>
            </td>
            <td style="width: 65%">
                <textarea class="tinymce js-bc_major_equipment_text"
                          name="major_equipment_text"
                    {!! $project?->business_case?->major_equipment != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->business_case?->major_equipment_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_bc_major_equipment">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Utility Requirements :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-utility_requirement"
                           {{$project?->business_case?->utility_requirements == 1 ? 'checked' : ''}}
                           class="js-checkbox-business_case" type="checkbox">
                    <label for="checkbox-utility_requirement"></label>
                </div>
            </td>
            <td style="width: 65%">
                <textarea class="tinymce js-bc_utility_requirement_text"
                          name="utility_requirement_text"
                    {!! $project?->business_case?->utility_requirements != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->business_case?->utility_requirements_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_bc_utility_requirement">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Permitting :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-permitting"
                           {{$project?->business_case?->permitting == 1 ? 'checked' : ''}}
                           class="js-checkbox-business_case" type="checkbox">
                    <label for="checkbox-permitting"></label>
                </div>
            </td>
            <td style="width: 65%">
                <textarea class="tinymce js-bc_permitting"
                          name="permitting_text"
                    {!! $project?->business_case?->permitting != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->business_case?->permitting_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_bc_permitting">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Social Community And Government :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-social_community"
                           {{$project?->business_case?->social_community_and_government == 1 ? 'checked' : ''}}
                           class="js-checkbox-business_case" type="checkbox">
                    <label for="checkbox-social_community"></label>
                </div>
            </td>
            <td style="width: 65%">
                <textarea class="tinymce js-bc_social_community"
                          name="social_community_text"
                    {!! $project?->business_case?->social_community_and_government != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->business_case?->social_community_and_government_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_bc_social_community_and_government">
                <div class="col-md-12 txt-danger js-error-message"></div>
            </td>
        </tr>
        <tr>
            <td>Financial Evaluation :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-financial_evaluation"
                           {{$project?->business_case?->financial_evaluation == 1 ? 'checked' : ''}}
                           class="js-checkbox-business_case" type="checkbox">
                    <label for="checkbox-financial_evaluation"></label>
                </div>
            </td>
            <td style="width: 65%">
                <table class="js-table-financial-evaluation
                    {!! $project?->business_case?->financial_evaluation != 1 ? 'd-none' : '' !!}">
                    <tr>
                        <td style="width: 20%">NPV</td>
                        <td>
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
            </td>
        </tr>
        <tr>
            <td>Risk Assessment :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-risk_assessment"
                           {{$project?->business_case?->risk_assessment == 1 ? 'checked' : ''}}
                           class="js-checkbox-business_case js-checkbox-risk_assessment" type="checkbox">
                    <label for="checkbox-risk_assessment"></label>
                </div>
            </td>
            <td>
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
            </td>
        </tr>
        <tr>
            <td>Cost Estimate :<br/></td>
            <td></td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <div class="input-group">
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
            </td>
        </tr>
        <tr>
            <td>Additional Information :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-additional_information"
                           {{$project?->business_case?->additional_information == 1 ? 'checked' : ''}}
                           class="js-checkbox-business_case" type="checkbox">
                    <label for="checkbox-additional_information"></label>
                </div>
            </td>
            <td style="width: 65%">
                <textarea class="tinymce js-bc_additional_information"
                          name="additional_information"
                    {!! $project?->business_case?->additional_information != 1 ? 'style="display: none"' : '' !!}>
                    {!! $project?->business_case?->additional_information_text !!}
                </textarea>
                <input type="hidden" class="js-hidden-validate" name="validate_bc_additional_information">
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
                <div class="col-md-12">
                    <input class="form-control js-bc-attachment_file col-md-10" value="{{$project?->project_name}}" name="document" id="inputFile" multiple type="file">
                    @if($project?->getAllAttachment($project->business_case?->attachment,'business_case'))
                        <a target="_blank"
                           href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['bc']}}&file={{$project?->getAllAttachment($project->business_case?->attachment,'business_case')}}">
                            <i class="mt-2 fa fa-file-text-o txt-info"></i>
                            {{$project?->getAllAttachment($project->business_case?->attachment,'business_case')}}
                        </a>
                    @endif
                </div>
            </td>
        </tr>
        </tbody>
    </table>

</div>
<div class="row">
    <input type="hidden" name="validate_check_empty_count" class="js-validate-checkbox-count">
</div>
