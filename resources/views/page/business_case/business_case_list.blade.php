@extends('main')
@section('main')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-4">
                    <h3>Business Case list</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Business Case list</li>
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
                            <form method="get" action="business-case">
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
                                    <tr class="text-center">
                                        <th>Project Name</th>
                                        <th>Project Scope of Work</th>
                                        <th>Cost Estimate</th>
                                        <th>Financial Evaluation</th>
                                        <th>Risk Assessment</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(sizeof($business_cases) > 0)
                                        @foreach($business_cases as $business_case)
                                            <tr>
                                                <td class="text-center">
                                                    <a class="js-set-session" data-id="{{$business_case?->project->id}}" href="/project/{{$business_case?->project->id}}">
                                                        <p class="alert-color-green">{{$business_case?->project->project_name}}</p>
                                                    </a>
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {!! $business_case?->project?->getCheckTemplate($business_case?->project_scope_of_work) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {!! $business_case?->project?->getCheckTemplate($business_case?->cost_estimate > 0 ? 1 : 0) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {!! $business_case?->project?->getCheckTemplate($business_case?->financial_evaluation) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {!! $business_case?->project?->getCheckTemplate($business_case?->risk_assessment) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {{$business_case->status}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="17" class="text-center">Empty Data</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(sizeof($business_cases) > 10)
                <div class="col-sm-12">
                    <div class="card p-2">
                        <nav aria-label="...">
                            <ul class="pagination pagination-primary justify-content-end">
                                {{$business_cases->onEachSide(1)->links()}}
                            </ul>
                        </nav>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
