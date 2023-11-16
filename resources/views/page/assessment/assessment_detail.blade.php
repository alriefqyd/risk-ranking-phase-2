@inject('setting',App\Models\Setting::class)
<div class="row js-form-project-detail m-b-30 {{!$errors->any() ? '' : 'd-none'}}">
    @if($project?->assessment)
        <div class="table-responsive">
            <table class="table table-striped js-table-assessment">
                <tbody>
                <tr>
                    <td style="width: 17%">Problem Statement :</td>
                    <td style="width: 8%">{!! $project?->getCheckTemplate($project?->assessment->problems_statement) !!}</td>
                    <td style="width: 75%">
                        {!! $project?->getTemplateExpandChar($project?->assessment->problem_statement_text) !!}
                    </td>
                </tr>
                <tr>
                    <td>Objective :</td>
                    <td>{!! $project?->getCheckTemplate($project?->assessment->objective) !!}</td>
                    <td>
                        {!! $project?->getTemplateExpandChar($project?->assessment->objective_text) !!}
                    </td>
                </tr>
                <tr>
                    <td>Project Scope :</td>
                    <td>{!! $project?->getCheckTemplate($project?->assessment->project_scope) !!}</td>
                    <td>
                        {!! $project?->getTemplateExpandChar($project?->assessment->project_scope_text) !!}
                    </td>
                </tr>
                <tr>
                    <td>Key Performance Metric :</td>
                    <td>{!! $project?->getCheckTemplate($project?->assessment->key_performance_metric) !!}</td>
                    <td>
                        {!! $project?->getTemplateExpandChar($project?->assessment->key_performance_metric_text) !!}
                    </td>
                </tr>
                <tr>
                    <td>Key Project Risk Mitigants :</td>
                    <td>{!! $project?->getCheckTemplate($project?->assessment->key_project_risk_mitigants) !!}</td>
                    <td>
                        {!! $project?->getTemplateExpandChar($project?->assessment->key_project_risk_and_mitigants_text) !!}
                    </td>
                </tr>
                <tr>
                    <td>Impact If Not <br/>Executed :</td>
                    <td>{!! $project?->getCheckTemplate($project?->assessment->impact_if_not_executed) !!}</td>
                    <td>
                        {!! $project?->getTemplateExpandChar($project?->assessment->impact_if_not_executed_text) !!}
                    </td>
                </tr>
                <tr>
                    <td>Alternative To <br/> Proposal :</td>
                    <td>{!! $project?->getCheckTemplate($project?->assessment->alternative_to_proposal) !!}</td>
                    <td>
                        {!! $project?->getTemplateExpandChar($project?->assessment->alternatives_to_proposal_text) !!}
                    </td>
                </tr>
                <tr>
                    <td>Cost Estimate :</td>
                    <td>{!! $project?->getCheckTemplate($project?->assessment->cost_estimate) !!}</td>
                    <td>
                        $ <span class="js-currency-format-text"> {{$project?->assessment->cost_estimate_text }}</span>
                    </td>
                </tr>
                <tr>
                    <td>Detail Estimate Cost :</td>
                    <td>{!! $project?->getCheckTemplate($project?->assessment->detail_estimate_cost) !!}</td>
                    <td>
                        {!! $project?->getTemplateExpandChar($project?->assessment->detail_estimate_cost_text) !!}
                    </td>
                </tr>
                <tr>
                    <td>Complexity Analysis :</td>
                    <td>

                    </td>
                    <td>
                        <p>Score : {!! $project?->assessment->complexity_analyzis_score !!}</p>
                        <p>Complexity : {!! $project?->assessment?->complexity_analysis_type !!}</p>
                    </td>
                </tr>
                <tr>
                    <td>Complexity Score Assessment :</td>
                    <td>
                        {!! $project?->getCheckTemplate($project?->assessment->complexity_assessment_checkbox) !!}</td>
                    </td>
                    <td>
                        <table style="width: 100%">
                            <tr>
                                <td>
                                    Technology Characteristic
                                </td>
                                <td>
                                    <select data-readonly="true" id="u-rating-movie" data-idx="0"
                                            class="rating-custom js-complexity-assessment-technology js-complexity-assessment-score"
                                            name="rating" autocomplete="off">
                                        @for($i=1;$i<6;$i++)
                                            <option value></option>
                                            @if($i > 0)
                                                <option
                                                    {{$project?->getProjectAssessmentComplexity('complexity_assessment_technology') == $i ? 'selected' : ''}}
                                                    value="{{$i}}">{{$i}}</option>
                                            @endif
                                        @endfor
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Engineering Characteristic
                                </td>
                                <td>
                                    <select data-readonly="true" id="u-rating-movie" data-idx="1"
                                            class="rating-custom js-complexity-assessment-engineering js-complexity-assessment-score"
                                            name="rating" autocomplete="off">
                                        @for($i=1;$i<6;$i++)
                                            <option value></option>
                                            @if($i > 0)
                                                <option
                                                    {{$project?->getProjectAssessmentComplexity('complexity_assessment_engineering') == $i ? 'selected' : ''}}
                                                    value="{{$i}}">{{$i}}</option>
                                            @endif
                                        @endfor
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Owner Business Impact Characteristic
                                </td>
                                <td>
                                    <select data-readonly="true" id="u-rating-movie" data-idx="2"
                                            class="rating-custom js-complexity-assessment-owner_business js-complexity-assessment-score"
                                            name="rating" autocomplete="off">
                                        @for($i=1;$i<6;$i++)
                                            <option value></option>
                                            @if($i > 0)
                                                <option
                                                    {{$project?->getProjectAssessmentComplexity('complexity_assessment_owner_business') == $i ? 'selected' : ''}}
                                                    value="{{$i}}">{{$i}}</option>
                                            @endif
                                        @endfor
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    External Approval Characteristic
                                </td>
                                <td>
                                    <select data-readonly="true" id="u-rating-movie" data-idx="3"
                                            class="rating-custom js-complexity-assessment-external-approval js-complexity-assessment-score"
                                            name="rating" autocomplete="off">
                                        @for($i=1;$i<6;$i++)
                                            <option value></option>
                                            @if($i > 0)
                                                <option
                                                    {{$project?->getProjectAssessmentComplexity('complexity_assessment_external_approval') == $i ? 'selected' : ''}}
                                                    value="{{$i}}">{{$i}}</option>
                                            @endif
                                        @endfor
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>
                                    <p class="f-w-700 js-label-project-complexity-score">{{$project?->assessment?->complexity_score_assessment ?: 0}}</p>
                                    <input type="hidden" class="js-hidden-project-level-assessment-score"
                                           value="{{$project?->assessment?->complexity_score_assessment ?: 0}}">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>Assessment of Level Project :</td>
                    <td>{!! $project?->getCheckTemplate($project?->assessment->level_project_text ? 1 : 0) !!}</td>
                    <td>
                        <small>(According to cost estimate $ <span
                                class="text-danger js-cost-estimate-label-assessment">
                                <span
                                    class="js-currency-format-text"> {{$project?->assessment?->cost_estimate_text}} </span>
                            </span> and complexity score
                            <span class="text-danger js-complexity-score-label-assessment">
                                {{$project?->assessment?->complexity_score_assessment}}
                            </span> , that this categorize as
                            <span
                                class="text-danger text-large-custom js-assessment-level-status-auto">{{$project?->assessment?->level_project_text}}</span>
                            project). </small>
                    </td>
                </tr>
                <tr>
                    <td>Document <br/>Attachment :</td>
                    <td>{!! $project?->getCheckTemplate($project?->assessment?->attachment ? 1 : 0) !!}</td>
                    <td>
                        <table style="width: 100%">
                            <tr>
                                <td>
                                    Initial Cost Estimate :
                                </td>
                                <td>
                                    @if($project?->getAllAttachment($project?->assessment?->attachment, $setting::ASSESSMENT_ATTACHMENT['initial_cost_estimate']))
                                        <a target="_blank"
                                           href="/preview?id={{$project?->id}}&category={{$setting::FOLDER_TYPE['assessment']}}&file={{urlencode($project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['initial_cost_estimate']))}}&dir={{urlencode($project?->project_name)}}">
                                            <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                            {{$project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['initial_cost_estimate'])}}
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Complexity Matrix :
                                </td>
                                <td>
                                    @if($project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['complexity_matrix']))
                                        <a target="_blank"
                                           href="/preview?id={{$project?->id}}&category={{$setting::FOLDER_TYPE['assessment']}}&file={{urlencode($project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['complexity_matrix']))}}&dir={{urlencode($project?->project_name)}}">
                                            <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                            {{$project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['complexity_matrix'])}}
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        </table>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        Location of Asset Capitalization
                    </td>
                    <td>
                        @if($project->assessment->getAllAreaAssetCapitalization() !== null)
                            <div class="table table-hover">
                                <table>
                                    <thead>
                                    <th>
                                        Area
                                    </th>
                                    <th>Cost Center</th>
                                    <th></th>
                                    </thead>
                                    <tbody>
                                    @foreach($project->assessment->getAllAreaAssetCapitalization() as $area)
                                        <tr>
                                            <td>
                                                {{$area->area}}
                                            </td>
                                            <td>
                                                {{$area->cost_center}}
                                            </td>
                                            <td></td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p> - </p>
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center">
            No Data Assessment
        </div>
    @endif
</div>
