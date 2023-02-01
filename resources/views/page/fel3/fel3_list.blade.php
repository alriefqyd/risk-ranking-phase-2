@extends('main')
@section('main')
    <h6 class="font-roboto js-title-detail {{!$errors->any() ? '' : 'd-none'}} title m-l-5 m-b-0">FEL 3 Detail</h6>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-4">
                    <h3>FEL 3 list</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">FEL 3 list</li>
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
                            <form method="get" action="fel3">
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
                                        <th>Executive Summary</th>
                                        <th>Problem Statement</th>
                                        <th>Project Scope</th>
                                        <th>Alternatives And Best Option</th>
                                        <th>Project Schedule</th>
                                        <th>List Of Equipment And Specification </th>
                                        <th>HAZOP Study</th>
                                        <th>Cost Estimate</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(sizeof($fels3) > 0)
                                        @foreach($fels3 as $fel3)
                                            <tr>
                                                <td class="text-center">
                                                    <a class="js-set-session" data-id="{{$fel3?->project->id}}" href="/project/{{$fel3?->project->id}}">
                                                        <p class="alert-color-green">{{$fel3?->project->project_name}}</p>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    {!! $fel3?->project?->project_type !!}
                                                </td>
                                                <td class="text-center">
                                                    {!! $fel3?->project?->getCheckTemplate($fel3?->executive_summary) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {!! $fel3?->project?->getCheckTemplate($fel3?->problem_statement) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {!! $fel3?->project?->getCheckTemplate($fel3?->project_scope) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {!! $fel3?->project?->getCheckTemplate($fel3?->alternatives_and_best_option) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {!! $fel3?->project?->getCheckTemplate($fel3?->project_schedule) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {!! $fel3?->project?->getCheckTemplate($fel3?->list_of_equipment_and_specification) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {!! $fel3?->project?->getCheckTemplate($fel3?->hazop_study) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {!! $fel3?->project?->getCheckTemplate($fel3?->cost_estimate) !!}
                                                </td>
                                                <td class="text-center js-row-bc_status">
                                                    {{$fel3->status}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="11" class="text-center">Empty Data</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(sizeof($fels3) > 10)
                <div class="col-sm-12">
                    <div class="card p-2">
                        <nav aria-label="...">
                            <ul class="pagination pagination-primary justify-content-end">
                                {{$fels3->onEachSide(1)->links()}}
                            </ul>
                        </nav>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
