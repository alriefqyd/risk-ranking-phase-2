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
    <form method="post" action="/project" class="theme-form js-project-form">
    @csrf
        <div class="container-fluid js-capex-investment-form">
            <div class="row">
                <div class="col-sm-12 col-xl-12">
                       <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    @include('page.project.capex_investment_form',[
                                        'subDepartment' => $subDepartment,
                                        'department' => $department,
                                        'user_department' => $userDepartment,
                                        'errors' => $errors
                                    ])
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary js-next-capex-investment-form" disabled="disabled">Submit and Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid js-project-form-card d-none">
            <div class="row">
                <div class="col-sm-12 col-xl-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
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
                                    <button class="btn btn-secondary js-back-capex-investment-form">Back To Capex Investment</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @include('page.project.notification')
@endsection
