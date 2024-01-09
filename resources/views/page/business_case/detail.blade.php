@inject('setting',App\Models\Setting::class)
<div class="row js-form-project-detail m-b-30 {{!$errors->any() ? '' : 'd-none'}}">
    @if($project?->business_case)
        <div class="table-responsive">
            <table class="table table-striped js-table-assessment">
                <tbody>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Project Scope of Work :</label>
                            </div>
                            <div class="col-md-8 float-start">
                                {!! $project->getCheckTemplate($project?->business_case?->project_scope_of_work) !!}
                            </div>
                            <div class="col-md-12">
                                {!! $project?->business_case?->project_scope_of_work_text !!}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Financial Evaluation :</label>
                            </div>
                            <div class="col-md-8 float-start">
                                {!! $project->getCheckTemplate($project?->business_case?->financial_evaluation) !!}
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6 js-financial_evaluation_detail d-none">
                                    <div>
                                        <label class="col-form-label">NPV : </label>
                                        $ <span class="js-currency-format-text">{{$project?->business_case?->npv}}</span>
                                    </div>
                                    <div>
                                        <label class="col-form-label">IRR :</label>
                                        @if($project?->business_case?->irr == 0)
                                            N/A
                                        @else
                                            {{$project?->business_case?->irr}} %
                                        @endif

                                    </div>
                                    <div>
                                        <label class="col-form-label">Payback Period :</label>
                                        {{$project?->business_case?->payback_period}} {{$project?->business_case?->payback_period > 1 ? 'Years' : 'Year'}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Risk Assessment :</label>
                            </div>
                            <div class="col-md-2 float-start">
                                {!! $project->getCheckTemplate($project?->business_case?->risk_assessment) !!}
                            </div>
                            <div class="col-md-7">
                                @if($project?->business_case?->risk_assessment == 1)
                                    <a class="js-bc-risk-assessment-expand alert-note d-none">
                                        View Detail <i class="fa fa-arrow-right"></i>
                                    </a>
                                @endif
                                <a class="js-bc-risk-assessment-hide alert-note
                                    {{$project?->business_case?->risk_assessment != 1 ? 'd-none' : ''}}">
                                    Hide Detail
                                    <i class="fa fa-arrow-left"></i></a>
                                    <ul class="{{$project?->business_case?->risk_assessment != 1 ? 'd-none' : ''}}" style="margin-left: 0px ;">
                                        <li>
                                            <div class="rating-container">
                                                People :
                                                <select id="u-rating-movie"
                                                        data-readonly="true"
                                                        class="rating-custom js-risk-people js-risk-assessment-field" name="rating" autocomplete="off">
                                                    @foreach($riskLevel as $index => $value)
                                                        <option value></option>
                                                        @if($index > 0)
                                                            <option {{$project?->business_case?->riskAssessment?->people == $index ? 'selected' : ''}} value="{{$index}}">{{$value}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rating-container">
                                                Environment :
                                                <select id="u-rating-movie" data-readonly="true" class="rating-custom js-risk-environment js-risk-assessment-field" name="rating" autocomplete="off">
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
                                                <select id="u-rating-movie" data-readonly="true" class="rating-custom js-risk-human-rights" autocomplete="off">
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
                                            <select id="u-rating-movie" data-readonly="true" class="rating-custom js-risk-reputation" autocomplete="off">
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
                                            <select id="u-rating-movie" data-readonly="true" class="rating-custom js-risk-finance" autocomplete="off">
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
                                                <select class="u-rating-1to10" data-readonly="true" class="js-risk-final-impact" autocomplete="off">
                                                    @for($i=1;$i<6;$i++)
                                                        <option value="{{$i}}" {{$i == $project?->business_case?->riskAssessment?->final_impact_score ? 'selected' : ''}}>{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </li>
                                        <li>
                                            Probability :
                                            <select id="u-rating-movie" data-readonly="true" class="rating-custom js-risk-probability" name="rating" autocomplete="off">
                                                <option value></option>
                                                @foreach($probability as $index => $value)
                                                    <option {{$index == $project?->business_case?->riskAssessment?->probability ? 'selected' : ''}} value="{{$index}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </li>
                                        <li class="mt-2">
                                            <p>Severity :
                                                <span class="js-set-label-severity">
                                                    {{$project?->business_case?->riskAssessment?->severity}}
                                                </span>
                                            </p>
                                        </li>
                                        <li>
                                            Priority Level :
                                            <span class="js-set-label-priority-level setting-primary">
                                                {{$project?->business_case?->riskAssessment?->priority_level}}
                                            </span>
                                        </li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Cost Estimate :</label>
                            </div>
                            <div class="col-md-8">
                                USD {!! $project?->business_case?->cost_estimate !!}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Attachment :</label>
                            </div>

                            <div class="col-md-12">
                                <table style="width: 100%">
                                    <tr>
                                        <td>
                                            FEL 3 Approved Document :
                                        </td>
                                        <td>
                                            @if($project?->getAllAttachment($project->business_case?->attachment, 'fel3'))
                                                <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['bc']}}&file={{urlencode($project?->getAllAttachment($project->business_case?->attachment,'fel3'))}}">
                                                    <i class="fa mb-2 fa-file-text-o txt-info"></i>
                                                    {{$project?->getAllAttachment($project->business_case?->attachment,'fel3')}}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Change Management Request</td>
                                        <td>
                                            @if($project->business_case?->change_management_request)
                                                <a target="_blank" href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['bc']}}&file={{urlencode($project->business_case?->change_management_request)}}">
                                                    <i class="fa mb-2 fa-file-text-o txt-info"></i>
                                                    {{$project->business_case?->change_management_request}}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Additional Attachment</td>
                                        <td>
                                            @if($project?->getAllAttachment($project->business_case?->attachment, 'business_case'))
                                                  <a target="_blank"
                                                       href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['bc']}}&file={{urlencode($project?->getAllAttachment($project->business_case?->attachment,'business_case'))}}">
                                                        <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                        {{$project?->getAllAttachment($project->business_case?->attachment,'business_case')}}
                                                 </a>
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
            No Data Business Case
        </div>
    @endif
</div>
