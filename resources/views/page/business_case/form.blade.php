<div class="table-responsive">
    <input type="hidden" class="js-project-id" value="{{$project->id}}">
    <table class="table table-striped js-table-assessment">
        <tbody>
        <tr>
            <td style="width: 170px">Problem Statement And Objective : </td>
            <td style="width: 270px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-problem_and_objective"
                           {{$project?->business_case?->problem_statement_and_objective == 1 ? 'checked' : ''}}
                            class="js-checkbox-business_case" type="checkbox">
                    <label for="checkbox-problem_and_objective"></label>
                </div>
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
            <td>Additional Information :</td>
            <td style="width: 100px">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-additional_information"
                           {{$project?->business_case?->additional_information == 1 ? 'checked' : ''}}
                           class="js-checkbox-business_case" type="checkbox">
                    <label for="checkbox-additional_information"></label>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
