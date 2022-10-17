@extends('main')
@section('main')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-8">
                    <h3>project Form</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/project">project list</a></li>
                        <li class="breadcrumb-item active">project Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-xl-12">
                <div class="card">
                    <div class="card-header p-0 b-b-info-custom">
                        <div class="row">
                            <div class="col-md-3 m-l-10 m-t-15 m-b-10">
                                <h6 class="font-roboto title">Project Detail</h6>
                            </div>
                            @can('update')
                                <div class="col-md-8 m-l-50 m-b-10">
                                    <button class="btn btn-sm btn-success m-t-10 float-end js-btn-edit_project">
                                        Edit <i style="width: 20px; height: 15px;" data-feather="edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-success m-t-10 float-end d-none js-btn-view_project">
                                        View <i style="width: 20px; height: 15px;" data-feather="eye"></i>
                                    </button>
                                </div>
                            @endcan
                        </div>
                    </div>

                    @can('update')
                    <div class="row js-form-project-edit d-none">
                        <form method="post" action="/project/{{$project->id}}"
                              class="theme-form js-project-edit js-project-form">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                @include('page.project.form',[
                                    'subDepartment' => $subDepartment,
                                    'department' => $department,
                                    'user_department' => $userDepartment,
                                    'errors' => $errors
                                ])
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button class="btn btn-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                    @endcan

                    <div class="row js-form-project-detail m-b-30">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td style="width: 200px">Project Number : </td>
                                    <td>{{$project->project_number}}</td>
                                </tr>
                                <tr>
                                    <td>Project Name : </td>
                                    <td>{{$project->project_name}}</td>
                                </tr>
                                <tr>
                                    <td>Project Type : </td>
                                    <td>{{$project->project_type}}</td>
                                </tr>
                                <tr>
                                    <td>Owner Area :</td>
                                    <td>{{$project->owners->name}}</td>
                                </tr>
                                <tr>
                                    <td>Project Sponsor :</td>
                                    <td>{{$project->sponsors->name}}</td>
                                </tr>
                                <tr>
                                    <td>BC Presenter :</td>
                                    <td>{{$project->bc_presenter}}</td>
                                </tr>
                                <tr>
                                    <td>Finance Analyst :</td>
                                    <td>{{$project->finance_analyst}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row m-b-50">
                    <div class="default-according style-1" id="accordionoc">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0 p-0">
                                    <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapseicon" aria-expanded="true" aria-controls="collapse11">
                                        <i class="icofont icofont-briefcase-alt-2"></i>
                                        Project Level Assessment</button>
                                </h5>
                            </div>
                            <div class="collapse show" id="collapseicon" aria-labelledby="collapseicon" data-bs-parent="#accordionoc">
                                <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header bg-primary">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed text-white" data-bs-toggle="collapse" data-bs-target="#collapseicon1" aria-expanded="false"><i class="icofont icofont-support"></i> Collapsible Group Item #<span>2</span></button>
                                </h5>
                            </div>
                            <div class="collapse" id="collapseicon1" aria-labelledby="headingeight" data-bs-parent="#accordionoc">
                                <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header bg-primary">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed text-white" data-bs-toggle="collapse" data-bs-target="#collapseicon2" aria-expanded="false" aria-controls="collapseicon2"><i class="icofont icofont-tasks-alt"></i> Collapsible Group Item #<span>3</span></button>
                                </h5>
                            </div>
                            <div class="collapse" id="collapseicon2" data-bs-parent="#accordionoc">
                                <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('page.project.notification')
@endsection
