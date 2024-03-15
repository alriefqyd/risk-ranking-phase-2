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
                <div class="col-sm-4 offset-md-4 mt-2">
                    <select class="select2 js-select-rr-project-list" data-allowClear="false" style="width: 100%">
                        <option value="2022" {{request()->year == '2022' ? 'selected' : ''}}>Risk Ranking Project List 2023 - 2027 (Presented 2022)</option>
                        <option value="2023" {{request()->year == '2023' ? 'selected' : ''}}>Risk Ranking Project List 2024 - 2028 (Presented 2023)</option>
                        <option value="" {{!request()->year ? 'selected' : ''}}>Risk Ranking Project List 2025-2029</option>
                    </select>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row project-cards">
            @if(session('message'))
                @include('flash')
            @endif
            <div class="card">
                <div class="card-body m-0 card-body-custom">
                    <div class="col-md-12 m-l-15 m-b-15">
                        @canany(['create','export','read'])
                            @if(!request()->year)
                                <div class="col-md-12 col-sm-6 p-r-10 float-end">
                                    @if(auth()->user()->role == \App\Models\User::ROLE['admin'])
                                        @can('create')
                                            <a href="/project/create">
                                                <button class="btn btn-outline-primary-2x m-l-5 float-end" style="font-size: 12px" type="button">Create New Project</button>
                                            </a>
                                        @endcan
                                    @endif
                                    @can('export')
                                        <a href="/export">
                                            <button class="btn btn-export btn-outline-primary-2x float-end"
                                                    data-storage="{{storage_path()}}"
                                            >
                                        <span class="text-button loader-box" style="height: 19px; font-size: 12px">
                                            Download <span class="m-l-5 loader-34 d-none"></span>
                                            <span class="js-icon-download">
                                                <i style="width: 20px; height: 15px;" data-feather="download"></i>
                                            </span>
                                        </span>
                                            </button>
                                        </a>
                                    @endcan
                                </div>
                            @endif
                            <div class="row mt-3 mb-0 ">
                                <p class="f-14 f-w-600">Filter Project</p>
                            </div>
                            <form method="get" action="{{isset(request()->year) ? request()->year : 'project'}}">
                                <div class="row mt-0 mb-1">
                                    <div class="col-md-4 m-l-5 p-0">
                                        <div class="mb-2">
                                            <input type="text" name="q" value="{{request('q')}}" style="height: 40px" class="form-control js-search-project" placeholder="Search By Project Name">
                                        </div>
                                    </div>
                                    <div class="col-md-2 m-l-5 p-0">
                                        <div class="mb-2">
                                            @if(isset(request()->year) && request()->year <= config('constants.project_presented_year'))
                                                <select name="owner" data-placeholder="Select Operation Area" class="js-example-basic-single js-search-project col-sm-12 select2">
                                                    <option></option>
                                                    @foreach($department as $d)
                                                        <option {{$d->id == request('owner') ? 'selected' : ''}} value="{{$d->id}}">{{$d->name}}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <select name="operation_area" data-placeholder="Select Operation Area" class="js-example-basic-single js-search-project col-sm-12 select2">
                                                    <option></option>
                                                    @foreach($department as $d)
                                                        <option {{$d->id == request('operation_area') ? 'selected' : ''}} value="{{$d->id}}">{{$d->name}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-0">
                                    <div class="col-md-2 m-l-5 p-0">
                                        <div class="mb-2">
                                            @if(isset(request()->year) && request()->year <= config('constants.project_presented_year'))
                                            <select name="sponsor" data-placeholder="Select Sponsor Area" class="js-search-project js-example-basic-single col-sm-12 select2">
                                                <option></option>
                                                @foreach($subDepartment as $sd)
                                                    <option {{$sd->id == request('sponsor') ? 'selected' : ''}} value="{{$sd->id}}">{{$sd->name}}</option>
                                                @endforeach
                                            </select>
                                            @else
                                                <select name="sponsor_area" data-placeholder="Select Sponsor Area" class="js-search-project js-example-basic-single col-sm-12 select2">
                                                    <option></option>
                                                    @foreach($subDepartment as $sd)
                                                        <option {{$sd->id == request('sponsor_area') ? 'selected' : ''}} value="{{$sd->id}}">{{$sd->name}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-2 m-l-5 p-0">
                                        <div class="mb-2">
                                            <select name="type" data-placeholder="Select Project Type" class="js-search-project js-example-basic-single col-sm-12 select2">
                                                <option></option>
                                                @foreach($projectType as $pt)
                                                    <option {{$pt->id == request('type') ? 'selected' : ''}} value="{{$pt->id}}">{{$pt->setting_value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 m-l-5 p-0">
                                        <div class="mb-2">
                                            <select name="category" data-placeholder="Select Project Category" class="js-search-project js-example-basic-single col-sm-12 select2">
                                                <option></option>
                                                @foreach($projectCategory as $key=>$value)
                                                    <option {{$key == request('category') ? 'selected' : ''}} value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endcan
                    </div>
                    <div class="col-sm-12 m-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="bg-primary">
                                <tr class="text-center f-12">
                                    <th scope="col">Priority Level</th>
                                    {{--<th scope="col" >Project No</th>--}}
                                    <th scope="col" >Project Name</th>
                                    <th scope="col">Project Level Assessment</th>
                                    <th scope="col">FEL 1</th>
                                    <th scope="col">FEL 2</th>
                                    <th scope="col">FEL 3</th>
                                    <th scope="col">Business Case</th>
                                    <th scope="col">Owner Area</th>
                                    <th scope="col">Sponsor</th>
                                    <th scope="col">Note</th>
                                    @can('delete')
                                        <th scope="col">Action</th>
                                    @endcan
                                    <th>

                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(sizeof($projectList) > 0)
                                    @foreach($projectList as $project)
                                        <tr>
                                            <td>
                                                {!! $project?->getPriorityTemplate($project?->business_case?->riskAssessment?->priority_level)!!}
                                            </td>
                                            {{--<td>
                                                {{$project->project_number ?: '-'}}
                                            </td>--}}
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
                                            <td>{{$project->ownersProject?->name ?? $project->getOldDepartment($project->owner)}}</td>
                                            <td>{{$project?->sponsorsProject?->name ?? $project->getOldDepartment($project->sponsor)}}</td>
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
                                            <td>
                                                <button class="example-popover btn" data-bs-trigger="hover" data-container="body" data-bs-toggle="popover" data-bs-placement="bottom" title="" data-offset="-20px -20px" data-bs-original-title="Duplicate">
                                                    <a class="js-duplicate-project" data-bs-toggle="modal" data-original-title="test"
                                                       data-id="{{$project->id}}"
                                                       data-bs-target="#projectDuplicate">
                                                            <i class="cursor-pointer" style="color: #246a5d" data-feather="copy"></i>
                                                    </a>
                                                </button>

                                            </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="text-center">
                                        <td colspan="15">Empty Data</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if($projectList->total() > 19)
                        <div class="col-sm-12 mt-3">
                            <nav aria-label="..." class="p-2">
                                <ul class="pagination pagination-primary justify-content-end">
                                    {{$projectList->onEachSide(1)->links()}}

                                </ul>
                                <small class="pagination justify-content-end mt-2"> showing {{$projectList->firstItem()}} -
                                    {{$projectList->lastItem()}} of {{$projectList->total()}} records</small>

                            </nav>

                        </div>
                    @endif
                </div>
            </div>
        </div>
        @include('components.modal')
    </div>
@endsection
