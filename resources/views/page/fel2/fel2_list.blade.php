@extends('main')
@section('main')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-4">
                    <h3>FEL 2 list</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">FEL 1 list</li>
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
                            <form method="get" action="fel2">
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
                                        <th>Project Type</th>
                                        <th>Project Scope</th>
                                        <th>Identify Main Equipment</th>
                                        <th>Boundary and Assumption</th>
                                        <th>Analysis of Option</th>
                                        <th>Permit List</th>
                                        <th>Schedule Project </th>
                                        <th>Cost Estimate </th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(sizeof($fels2) > 0)
                                        @foreach($fels2 as $fel2)
                                            <tr>
                                                <td class="text-center">
                                                    <a class="js-set-session" data-id="{{$fel2?->project->id}}" href="/project/{{$fel2?->project->id}}">
                                                        <p class="alert-color-green">{{$fel2?->project->project_name}}</p>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    {!! $fel2?->project?->project_type !!}
                                                </td>
                                                <td class="text-center">
                                                    {!! $fel2?->project?->getCheckTemplate($fel2?->project_scope) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {!! $fel2?->project?->getCheckTemplate($fel2?->identify_main_equipment) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {!! $fel2?->project?->getCheckTemplate($fel2?->boundary_and_assumption) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {!! $fel2?->project?->getCheckTemplate($fel2?->analysis_of_option) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {!! $fel2?->project?->getCheckTemplate($fel2?->permit_list) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {!! $fel2?->project?->getCheckTemplate($fel2?->schedule_project) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {!! $fel2?->project?->getCheckTemplate($fel2?->cost_estimate) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {{$fel2->status}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        @else
                                            <tr>
                                                <td colspan="10" class="text-center">Empty Data</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(sizeof($fels2) > 10)
                <div class="col-sm-12">
                    <div class="card p-2">
                        <nav aria-label="...">
                            <ul class="pagination pagination-primary justify-content-end">
                                {{$fels2->onEachSide(1)->links()}}
                            </ul>
                        </nav>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
