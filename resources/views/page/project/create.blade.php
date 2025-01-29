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
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="/project" enctype="multipart/form-data" class="theme-form
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
                                    <h6 class="text-primary-template">Project Info</h6>
                                </div>
                                <div class="card-body">
                                    @include('page.project.form',[
                                            'subDepartment' => $subDepartment,
                                            'department' => $department,
                                            'user_department' => $userDepartment,
                                            'errors' => $errors
                                        ])
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="text-primary-template"> Project Type</h6>
                                </div>
                                <div class="card-body">
                                    @include('page.project.capex_investment_form',[
                                       'subDepartment' => $subDepartment,
                                       'department' => $department,
                                       'user_department' => $userDepartment,
                                       'errors' => $errors
                                    ])
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="text-primary-template">Business Case</h6>
                                </div>
                                <div class="card-body">
                                    @include('page.business_case.form')
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="text-primary-template">Document Attachment</h6>
                                </div>
                                <div class="card-body">
                                    @include('page.project.attachment')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body p-2">
                        <div class="float-end">
                            <p class="mb-0"><small class="text-danger js-text-validation-basket"></small></p>
                            <button class="btn btn-danger">Cancel</button>
                            <button type="submit" class="btn btn-secondary js-save-project-bc" data-status="DRAFT">Save as Draft</button>
                            <button class="btn btn-success js-open-modal" type="button" data-bs-toggle="modal" data-bs-target="#modal-confirm">
                                Submit
                            </button>
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

    <!-- Modal -->
    <div class="modal fade" id="modal-confirm" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Confirm Submit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to submit this project?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary js-confirm-publish">Yes, Submit</button>
                </div>
            </div>
        </div>
    </div>
    @include('page.project.notification')
@endsection
