@inject('setting',App\Models\Setting::class)
<div class="row js-form-project-detail m-b-30 {{!$errors->any() ? '' : 'd-none'}}">
    @if($project?->assessment)
        <div class="table-responsive">
            <table class="table table-striped js-table-assessment">
                <tbody>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Executive Summary :</label>
                            </div>
                            <div class="col-md-8 float-start">
                                {!! $project?->getCheckTemplate($project?->assessment->executive_summary) !!}
                            </div>
                            <div class="col-md-12">
                                {!! $project?->getTemplateExpandChar($project?->assessment->executive_summary_text) !!}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Problem Statement :</label>
                            </div>
                            <div class="col-md-8 float-start">
                                {!! $project?->getCheckTemplate($project?->assessment->problems_statement) !!}
                            </div>
                            <div class="col-md-12">
                                {!! $project?->getTemplateExpandChar($project?->assessment->problem_statement_text) !!}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Objective :</label>
                            </div>
                            <div class="col-md-8 float-start">
                                {!! $project?->getCheckTemplate($project?->assessment->objective) !!}
                            </div>
                            <div class="col-md-12">
                                {!! $project?->getTemplateExpandChar($project?->assessment->objective_text) !!}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Project Scope :</label>
                            </div>
                            <div class="col-md-8 float-start">
                                {!! $project?->getCheckTemplate($project?->assessment->project_scope) !!}
                            </div>
                            <div class="col-md-12">
                                {!! $project?->getTemplateExpandChar($project?->assessment->project_scope_text) !!}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Alternatives and <br/> Best Option :</label>
                            </div>
                            <div class="col-md-8 float-start">
                                {!! $project?->getCheckTemplate($project?->assessment->alternative_to_proposal) !!}
                            </div>
                            <div class="col-md-12">
                                {!! $project?->getTemplateExpandChar($project?->assessment->alternatives_to_proposal_text) !!}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Project Schedule :</label>
                            </div>
                            <div class="col-md-8 float-start">
                                {!! $project?->getCheckTemplate($project?->assessment->project_schedule) !!}
                            </div>
                            <div class="col-md-12">
                                {!! $project?->getTemplateExpandChar($project?->assessment->project_schedule_text) !!}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>List of Equipment and Specification :</label>
                            </div>
                            <div class="col-md-8 float-start">
                                {!! $project?->getCheckTemplate($project?->assessment->list_equipment_specification) !!}
                            </div>
                            <div class="col-md-12">
                                {!! $project?->getTemplateExpandChar($project?->assessment->list_equipment_specification_text) !!}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Key Performance Metric :</label>
                            </div>
                            <div class="col-md-8 float-start">
                                {!! $project?->getCheckTemplate($project?->assessment->key_performance_metric) !!}
                            </div>
                            <div class="col-md-12">
                                <div class="table table-striped js-table-kpm-kpi {{$project->assessment?->key_performance_metric == 0 ? 'd-none' : ''}}">
                                    <table style="width: 100%">
                                        <thead>
                                        <th colspan="5" class="text-center">KPI - Key Performance Indicator <br> (KPI will be measured upon project completion)</th>
                                        </thead>
                                        <thead>
                                        <th style="width: 30px">No</th>
                                        <th class="">KPI Description</th>
                                        <th style="width: 100px">UoM</th>
                                        <th>Time to Benfit</th>
                                        <th>Remarks</th>
                                        <th></th>
                                        </thead>
                                        <tbody>
                                        @if($project->assessment->isKpiJson())
                                            @foreach($project->assessment?->getKpiList() as $kpi)
                                                <tr>
                                                    <td>1</td>
                                                    <td>{{$kpi->description}}</td>
                                                    <td>{{$kpi->uom}}</td>
                                                    <td>{{$kpi->time_benefit}}</td>
                                                    <td>{{$kpi->remarks}}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <p>{{$project->assessment->getKpiList()}}</p>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Key Project Risk Mitigants :</label>
                            </div>
                            <div class="col-md-8 float-start">
                                {!! $project?->getCheckTemplate($project?->assessment->key_project_risk_mitigants) !!}
                            </div>
                            <div class="col-md-12">
                                {!! $project?->getTemplateExpandChar($project?->assessment->key_project_risk_and_mitigants_text) !!}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Impact If Not <br/>Executed :</label>
                            </div>
                            <div class="col-md-8 float-start">
                                {!! $project?->getCheckTemplate($project?->assessment->impact_if_not_executed) !!}
                            </div>
                            <div class="col-md-12">
                                {!! $project?->getTemplateExpandChar($project?->assessment->impact_if_not_executed_text) !!}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>HAZOP Study :</label>
                            </div>
                            <div class="col-md-8 float-start">
                                {!! $project?->getCheckTemplate($project?->assessment->hazop_study) !!}
                            </div>
                            <div class="col-md-12">
                                {!! $project?->getTemplateExpandChar($project?->assessment->hazop_study_text) !!}
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
                            <div class="col-md-8 float-start">
                                {!! $project?->getCheckTemplate($project?->assessment->cost_estimate) !!}
                            </div>
                            <div class="col-md-12">
                                $ <span class="js-currency-format-text"> {{$project?->assessment->cost_estimate_text }}</span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Economic Evaluation :</label>
                            </div>
                            <div class="col-md-8 float-start">
                                {!! $project?->getCheckTemplate($project?->assessment->economic_evaluation) !!}
                            </div>
                            <div class="col-md-12">
                                {!! $project?->getTemplateExpandChar($project?->assessment->economic_evaluation_text) !!}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Complexity Score :</label>
                            </div>
                            <div class="col-md-8 float-start">
                                {!! $project?->getCheckTemplate($project?->assessment->complexity_assessment_checkbox) !!}
                            </div>
                            <div class="col-md-12">
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
                                <label class="m-t-3 js-assessment-message-mandatory-form-fels"></label>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Assessment of Level Project :</label>
                            </div>
                            <div class="col-md-8 float-start">
                                {!! $project?->getCheckTemplate($project?->assessment->level_project_text ? 1 : 0) !!}
                            </div>
                            <div class="col-md-12">
                                <small>(According to cost estimate $
                                    <span class="text-danger js-cost-estimate-label-assessment">
                                        <span class="js-currency-format-text"> {{$project?->assessment?->cost_estimate_text}} </span>
                                        </span> and complexity score
                                        <span class="text-danger js-complexity-score-label-assessment">
                                        {{$project?->assessment?->complexity_score_assessment}}
                                        </span> , that this categorize as
                                    <span class="text-danger text-large-custom js-assessment-level-status-auto">{{$project?->assessment?->level_project_text}}</span>
                                    project). </small>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Complexity Analyzes Questions :</label>
                            </div>
                            <div class="col-md-8 float-start">
                                {!! $project?->getCheckTemplate($project?->assessment->level_project_text ? 1 : 0) !!}
                            </div>
                            <div class="col-md-12">
                                <p>Score : {!! $project?->assessment->complexity_analyzis_score !!}</p>
                                <p>Complexity : {!! $project?->assessment?->complexity_analysis_type !!}</p>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Document Attachment :</label>
                            </div>
                            <div class="col-md-8 float-start">
                                {!! $project?->getCheckTemplate($project?->assessment?->attachment ? 1 : 0) !!}
                            </div>
                            <div class="col-md-12">
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
                                    <tr>
                                        <td>
                                            Preliminary Design :
                                        </td>
                                        <td>
                                            @if($project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['preliminary_design']))
                                                <a target="_blank"
                                                   href="/preview?id={{$project?->id}}&category={{$setting::FOLDER_TYPE['assessment']}}&file={{urlencode($project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['preliminary_design']))}}&dir={{urlencode($project?->project_name)}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['preliminary_design'])}}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Utility/Infrastructure/Facilities Diagram :
                                        </td>
                                        <td>
                                            @if($project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['utility_infrastructure_facilities_diagram']))
                                                <a target="_blank"
                                                   href="/preview?id={{$project?->id}}&category={{$setting::FOLDER_TYPE['assessment']}}&file={{urlencode($project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['utility_infrastructure_facilities_diagram']))}}&dir={{urlencode($project?->project_name)}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['utility_infrastructure_facilities_diagram'])}}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            HAZOP Study :
                                        </td>
                                        <td>
                                            @if($project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['hazop_study']))
                                                <a target="_blank"
                                                   href="/preview?id={{$project?->id}}&category={{$setting::FOLDER_TYPE['assessment']}}&file={{urlencode($project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['hazop_study']))}}&dir={{urlencode($project?->project_name)}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['hazop_study'])}}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            MOC Document :
                                        </td>
                                        <td>
                                            @if($project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['moc_document']))
                                                <a target="_blank"
                                                   href="/preview?id={{$project?->id}}&category={{$setting::FOLDER_TYPE['assessment']}}&file={{urlencode($project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['moc_document']))}}&dir={{urlencode($project?->project_name)}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['moc_document'])}}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Cost Estimate with rough of magnitude 15-20% :
                                        </td>
                                        <td>
                                            @if($project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['cost_estimate_with_rough_of_magnitude']))
                                                <a target="_blank"
                                                   href="/preview?id={{$project?->id}}&category={{$setting::FOLDER_TYPE['assessment']}}&file={{urlencode($project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['cost_estimate_with_rough_of_magnitude']))}}&dir={{urlencode($project?->project_name)}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['cost_estimate_with_rough_of_magnitude'])}}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Quotation of Equipment :
                                        </td>
                                        <td>
                                            @if($project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['quotation_of_equipment']))
                                                <a target="_blank"
                                                   href="/preview?id={{$project?->id}}&category={{$setting::FOLDER_TYPE['assessment']}}&file={{urlencode($project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['quotation_of_equipment']))}}&dir={{urlencode($project?->project_name)}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['quotation_of_equipment'])}}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Project Assessment Level :
                                        </td>
                                        <td>
                                            @if($project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['project_assessment_level']))
                                                <a target="_blank"
                                                   href="/preview?id={{$project?->id}}&category={{$setting::FOLDER_TYPE['assessment']}}&file={{urlencode($project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['project_assessment_level']))}}&dir={{urlencode($project?->project_name)}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['project_assessment_level'])}}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            FEL 1 :
                                        </td>
                                        <td>
                                            @if($project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['fel1']))
                                                <a target="_blank"
                                                   href="/preview?id={{$project?->id}}&category={{$setting::FOLDER_TYPE['assessment']}}&file={{urlencode($project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['fel1']))}}&dir={{urlencode($project?->project_name)}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['fel1'])}}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            FEL 2 :
                                        </td>
                                        <td>
                                            @if($project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['fel2']))
                                                <a target="_blank"
                                                   href="/preview?id={{$project?->id}}&category={{$setting::FOLDER_TYPE['assessment']}}&file={{urlencode($project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['fel2']))}}&dir={{urlencode($project?->project_name)}}">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$project?->getAllAttachment($project?->assessment?->attachment,$setting::ASSESSMENT_ATTACHMENT['fel2'])}}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Location of Asset Capitalization :</label>
                            </div>
                            <div class="col-md-8 float-start">
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
                            </div>
                        </div>
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
