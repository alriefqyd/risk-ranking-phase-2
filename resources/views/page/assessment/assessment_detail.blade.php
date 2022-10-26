<div class="row js-form-project-detail m-b-30 {{!$errors->any() ? '' : 'd-none'}}">
    @if($project->assessment)
        <div class="table-responsive">
            <table class="table table-striped js-table-assessment">
                <tbody>
                <tr>
                    <td style="width: 200px">Problem Statement : </td>
                    <td style="width: 100px">{!! $project->getCheckTemplate($project->assessment->problems_statement) !!}</td>
                    <td>
                        {!! $project->getTemplateExpandChar($project->assessment->problem_statement_text) !!}
                    </td>
                </tr>
                <tr>
                    <td>Objective : </td>
                    <td>{!! $project->getCheckTemplate($project->assessment->objective) !!}</td>
                    <td>
                        {!! $project->getTemplateExpandChar($project->assessment->objective_text) !!}
                    </td>
                </tr>
                <tr>
                    <td>Project Scope : </td>
                    <td>{!! $project->getCheckTemplate($project->assessment->project_scope) !!}</td>
                    <td>
                        {!! $project->getTemplateExpandChar($project->assessment->project_scope_text) !!}
                    </td>
                </tr>
                <tr>
                    <td>Key Performance Metric :</td>
                    <td>{!! $project->getCheckTemplate($project->assessment->key_performance_metric) !!}</td>
                    <td>
                        {!! $project->getTemplateExpandChar($project->assessment->key_performance_metric_text) !!}
                    </td>
                </tr>
                <tr>
                    <td>Key Project Risk Mitigants :</td>
                    <td>{!! $project->getCheckTemplate($project->assessment->key_project_risk_mitigants) !!}</td>
                    <td>
                        {!! $project->getTemplateExpandChar($project->assessment->key_project_risk_and_mitigants_text) !!}
                    </td>
                </tr>
                <tr>
                    <td>Impact If Not <br/>Executed :</td>
                    <td>{!! $project->getCheckTemplate($project->assessment->impact_if_not_executed) !!}</td>
                    <td>
                        {!! $project->getTemplateExpandChar($project->assessment->impact_if_not_executed_text) !!}
                    </td>
                </tr>
                <tr>
                    <td>Alternative To <br/> Proposal :</td>
                    <td>{!! $project->getCheckTemplate($project->assessment->alternative_to_proposal) !!}</td>
                    <td>
                        {!! $project->getTemplateExpandChar($project->assessment->alternatives_to_proposal_text) !!}
                    </td>
                </tr>
                <tr>
                    <td>Cost Estimate :</td>
                    <td>{!! $project->getCheckTemplate($project->assessment->cost_estimate) !!}</td>
                    <td>
                        $ {{ number_format($project->assessment->cost_estimate_text , 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td>Complexity Score Assessment :</td>
                    <td>
                        {!! $project->assessment->complexity_score_assessment !!}
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>Level Project :</td>
                    <td>{!! $project->getCheckTemplate($project->assessment->level_project) !!}</td>
                    <td>
                        {!! $project->getTemplateExpandChar($project->assessment->level_project_text) !!}
                    </td>
                </tr>
                <tr>
                    <td>Detail Estimate Cost :</td>
                    <td>{!! $project->getCheckTemplate($project->assessment->detail_estimate_cost) !!}</td>
                    <td>
                        {!! $project->getTemplateExpandChar($project->assessment->detail_estimate_cost_text) !!}
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
