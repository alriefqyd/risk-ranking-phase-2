@extends('main')
@section('main')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-4">
                    <h3>Assessment list</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Assessment list</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block row">
                        <div class="col-md-12 project-list">
                            <div class="row mt-3 mb-0 ">
                                <h6>Search By Project Name</h6>
                            </div>
                            <form method="get" action="assessment">
                                <div class="row mt-0">
                                    <div class="col-md-9 m-l-5 p-0">
                                        <div class="mb-2">
                                            <input type="text" name="q" value="{{request('q')}}" style="height: 40px" class="form-control" placeholder="Search By Project Name">
                                        </div>
                                    </div>
                                    <div class="col-md-2 p-0">
                                        <div class="form-group mb-0 me-0">
                                            <button class="btn btn-primary " type="submit">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead class="bg-primary">
                                    <tr class="text-center f-12">
                                        <th>Project Name</th>
                                        <th>Project Type</th>
                                        <th>Problem Statement</th>
                                        <th>Objective</th>
                                        <th>Project Scope</th>
                                        <th>Key Performance Metric</th>
                                        <th>Key Project Risk Mitigants</th>
                                        <th>Impact if Not Executed</th>
                                        <th>Alternatives to Proposal</th>
                                        <th>Cost Estimate</th>
                                        <th>Complexity Score Assessment</th>
                                        <th>Level Project</th>
                                        <th>Detail Estimate Cost</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(sizeof($assessments) > 0)
                                        @foreach($assessments as $assessment)
                                            <tr>
                                                <td class="text-center">
                                                    <a class="js-set-session" data-id="{{$assessment?->project->id}}" href="/project/{{$assessment?->project->id}}">
                                                        <p class="alert-color-green">{{$assessment?->project->project_name}}</p>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    {!! $assessment?->project?->project_type !!}
                                                </td>
                                                <td class="text-center">
                                                    {!! $assessment?->project?->getCheckTemplate($assessment?->problems_statement) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {!! $assessment?->project?->getCheckTemplate($assessment?->objective) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {!! $assessment?->project?->getCheckTemplate($assessment?->project_scope) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {!! $assessment?->project?->getCheckTemplate($assessment?->key_performance_metric) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {!! $assessment?->project?->getCheckTemplate($assessment?->key_project_risk_mitigants) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {!! $assessment?->project?->getCheckTemplate($assessment?->impact_if_not_executed) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {!! $assessment?->project?->getCheckTemplate($assessment?->alternative_to_proposal) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {!! $assessment?->project?->getCheckTemplate($assessment?->cost_estimate) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {{$assessment?->complexity_score_assessment}}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {!! $assessment?->project?->getCheckTemplate($assessment?->level_project) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {!! $assessment?->project?->getCheckTemplate($assessment?->detail_estimate_cost) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {{$assessment->status}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="14" class="text-center">Empty Data</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(sizeof($assessments) > 10)
                <div class="col-sm-12">
                    <div class="card p-2">
                        <nav aria-label="...">
                            <ul class="pagination pagination-primary justify-content-end">
                                {{$assessments->onEachSide(1)->links()}}
                            </ul>
                        </nav>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
