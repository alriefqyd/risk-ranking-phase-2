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
                        <li class="breadcrumb-item active">project list</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-xl-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <form method="post" action="/project" class="theme-form js-project-form">
                                @csrf
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('page.project.notification')
@endsection
