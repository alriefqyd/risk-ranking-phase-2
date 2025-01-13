@extends('main')
@section('main')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-8">
                    <h3>BC Form</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/project">BC list</a></li>
                        <li class="breadcrumb-item active">Create BC</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <form method="post" action="/project" class="theme-form
    {{ count($errors) > 0 ? 'isError' : ''}}
    js-project-form">
    @csrf
        <div class="container-fluid js-capex-investment-form">
            <div class="row">
                <div class="col-sm-12 col-xl-12">
                       <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    Project Info
                                </div>
                                <div class="card-body">
                                    @include('page.project.form',[
                                            'subDepartment' => $subDepartment,
                                            'department' => $department,
                                            'user_department' => $userDepartment,
                                            'errors' => $errors
                                        ])
                                </div>
{{--                                <div class="card-footer">--}}
{{--                                    <button class="btn btn-primary js-next-capex-investment-form">Next</button>--}}
{{--                                </div>--}}
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    Business Case
                                </div>
                                <div class="card-body">
                                    @include('page.business_case.form')
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    Document Attachment
                                </div>
                                <div class="card-body">
                                    
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    Document Revision Log
                                </div>
                                <div class="card-body">

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
                                    @include('page.project.capex_investment_form',[
                                       'subDepartment' => $subDepartment,
                                       'department' => $department,
                                       'user_department' => $userDepartment,
                                       'errors' => $errors
                                    ])
                                </div>
                                <div class="card-footer">
                                    <p class="mb-0"><small class="text-danger js-text-validation-basket"></small></p>
                                    <button type="submit" class="btn btn-primary js-button-investment_category" disabled="disabled">Save</button>
                                    <button class="btn btn-secondary">Cancel</button>
                                    <button class="btn btn-secondary js-back-capex-investment-form">Back To Project Detail Form</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal js-modal-loading" id="modal-loading" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="loading-spinner mb-2"></div>
                    <div>Loading....</div>
                </div>
            </div>
        </div>
    </div>
    @include('page.project.notification')
@endsection
