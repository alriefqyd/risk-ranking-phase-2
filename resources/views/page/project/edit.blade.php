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
                    <div class="card-body p-0 b-b-info-custom">
                        <ul class="nav nav-tabs m-20" id="myTab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="project-tab" data-bs-toggle="tab" href="#project" role="tab" aria-controls="project" aria-selected="true">Project</a></li>
                            <li class="nav-item"><a class="nav-link" id="profile-tabs" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a></li>
                            <li class="nav-item"><a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a></li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="project" role="tabpanel" aria-labelledby="project-tab">
                                <div class="row">
                                    <div class="col-md-3 m-l-10 m-t-15 m-b-10">
                                        <h6 class="font-roboto js-title-detail {{!$errors->any() ? '' : 'd-none'}} title">Project Detail</h6>
                                        <h6 class="font-roboto p-l-10 js-title-form {{!$errors->any() ? 'd-none' : ''}} title">Project Form</h6>
                                    </div>
                                    @can('update')
                                        <div class="col-md-8 m-l-50 m-b-10">
                                            <button class="btn btn-sm btn-success m-t-10 float-end {{!$errors->any() ? '' : 'd-none'}}
                                                js-btn-edit_project">
                                                Edit <i style="width: 20px; height: 15px;" data-feather="edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-success m-t-10 float-end {{!$errors->any() ? 'd-none' : ''}}
                                                js-btn-view_project">
                                                View <i style="width: 20px; height: 15px;" data-feather="eye"></i>
                                            </button>
                                        </div>
                                    @endcan
                                </div>
                                @can('update')
                                    <div class="row js-form-project-edit {{!$errors->any() ? 'd-none' : ''}} m-t-0">
                                        <form method="post" action="/project/{{$project->id}}"
                                              class="theme-form js-project-edit js-project-form">
                                            @csrf
                                            @method('PUT')
                                            <div class="p-4 pt-0">
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
                                <div class="row js-form-project-detail m-b-30 {{!$errors->any() ? '' : 'd-none'}}">
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
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <p class="mb-0 m-t-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <p class="mb-0 m-t-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('page.project.notification')
@endsection
