@extends('main')
@section('main')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-4">
                    <h3>project list</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">project list</li>
                    </ol>
                </div>
                <div class="col-sm-8">
                    @can('create')
                        <a href="/project/create">
                            <button class="btn btn-outline-primary-2x m-l-5 float-end" type="button">Create New Project</button>
                        </a>
                    @endcan
                    @can('export')
                        <a href="/export">
                            <button class="btn btn-export btn-outline-primary-2x float-end"
                            data-storage="{{storage_path()}}"
                            >
                                <span class="text-button loader-box" style="height: 21px">
                                    Download <span class="m-l-5 loader-34 d-none"></span>
                                    <span class="js-icon-download">
                                        <i style="width: 20px; height: 15px;" data-feather="download"></i>
                                    </span>
                                </span>
                            </button>
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 project-list">
                @canany(['create','export'])
                <div class="card">
                    <div class="row mt-3 mb-0 ">
                        <h6>Filter Project</h6>
                    </div>
                    <form method="get" action="project">
                        <div class="row mt-0 mb-1">
                            <div class="col-md-4 p-0">
                                <div class="mb-2">
                                    <select name="owner" data-placeholder="Select Owner Area" class="js-example-basic-single col-sm-12 select2">
                                        <option></option>
                                        @foreach($department as $d)
                                            <option {{$d->id == request('owner') ? 'selected' : ''}} value="{{$d->id}}">{{$d->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 m-l-5 p-0">
                                <div class="mb-2">
                                    <select name="sponsor" data-placeholder="Select Sponsor" class="js-example-basic-single col-sm-12 select2">
                                        <option></option>
                                        @foreach($subDepartment as $sd)
                                            <option {{$sd->id == request('sponsor') ? 'selected' : ''}} value="{{$sd->id}}">{{$sd->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 m-l-5 p-0">
                                <div class="mb-2">
                                    <select name="category" data-placeholder="Select Project Category" class="js-example-basic-single col-sm-12 select2">
                                        <option></option>
                                        @foreach($projectCategory as $key=>$value)
                                            <option {{$key == request('category') ? 'selected' : ''}} value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-0">
                            <div class="col-md-4 p-0">
                                <div class="mb-2">
                                    <select name="type" data-placeholder="Select Project Type" class="js-example-basic-single col-sm-12 select2">
                                        <option></option>
                                        @foreach($projectType as $pt)
                                            <option {{$pt->id == request('type') ? 'selected' : ''}} value="{{$pt->id}}">{{$pt->setting_value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5 m-l-5 p-0">
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
                @endcan
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block row">
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead class="bg-primary">
                                    <tr class="text-center">
                                        <th scope="col">BC Status</th>
                                        <th scope="col">Priority Level</th>
                                        <th scope="col" >Project No</th>
                                        <th scope="col" >Project Name</th>
                                        <th scope="col">Project Level Assessment</th>
                                        <th scope="col">FEL 1</th>
                                        <th scope="col">FEL 2</th>
                                        <th scope="col">FEL 3</th>
                                        <th scope="col">Business Case</th>
                                        <th scope="col">Owner Area</th>
                                        <th scope="col">Sponsor</th>
                                        <th scope="col">Project Category</th>
                                        <th scope="col">Project Type</th>
                                        <th scope="col">Note</th>
                                        @can('delete')
                                            <th scope="col">Action</th>
                                        @endcan
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($projectList as $project)
                                        <tr>
                                            <td class="text-center js-row-bc_status">
                                                {!! $project->getBcStatus() !!}
                                            </td>
                                            <td>
                                                {!! $project?->getPriorityTemplate($project?->business_case?->riskAssessment?->priority_level)!!}
                                            </td>
                                            <td>
                                                {{$project->project_number ?: '-'}}
                                            </td>
                                            <td>
                                                <a href="/project/{{$project->id}}">
                                                    <p class="alert-color-green">{{$project->project_name}}</p>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                {!! $project->getRelatedDataProjectAssessment() !!}
                                            </td>
                                            <td class="text-center">
                                                {!! $project->getRelatedDataProjectFel1() !!}
                                            </td>
                                            <td class="text-center">
                                                {!! $project->getRelatedDataProjectFel2() !!}
                                            </td>
                                            <td class="text-center">
                                                {!! $project->getRelatedDataProjectFel3() !!}
                                            </td>
                                            <td class="text-center">
                                                {!! $project->getRelatedDataProjectBusinessCase() !!}
                                            </td>
                                            <td>{{$project->owners->name}}</td>
                                            <td>{{$project->sponsors->name}}</td>
                                            <td>{{$project->getProjectCategory()}}</td>
                                            <td>{{$project->project_type}}</td>
                                            <td>
                                                <a data-bs-toggle="modal"
                                                   class="modal-note"
                                                   data-original-title="test"
                                                   data-note="{{$project->note}}"
                                                   data-id="{{$project->id}}"
                                                   data-bs-target="#detail_note_project">
                                                    {!! $project->getNoteTemplateForm() !!}
                                                </a>
                                            </td>
                                            @can('delete')
                                            <td>
                                                <a data-bs-toggle="modal" data-original-title="test"
                                                   data-id="{{$project->id}}"
                                                   data-bs-target="#projectDelete">
                                                <span class="alert-note alert-color-red">
                                                     <x-feathericon-trash-2/>
                                                </span>
                                                </a>
                                            </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card p-2">
                    <nav aria-label="...">
                        <ul class="pagination pagination-primary justify-content-end">
                            {{$projectList->onEachSide(1)->links()}}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        @include('components.modal')
    </div>
@endsection
