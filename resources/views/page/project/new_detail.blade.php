<?php $getSubBasket = app(App\Models\CapexInvestment::class); ?>
@inject('setting',App\Models\Setting::class)
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
    <div class="container-fluid js-bc-detail">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-sm-12 col-xl-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="text-primary-template float-start">Project Info</h6>
                                <a data-bs-toggle="modal"
                                   class="modal-note float-start m-l-10 hover-button"
                                   data-original-title="test"
                                   data-note="{{$project->note}}"
                                   data-id="{{$project->id}}"
                                   data-bs-target="#detail_note_project">
                                    {!! $project->getNoteTemplateForm() !!}
                                </a>
                                <div class="btn btn-success js-btn-edit-bc float-end">Update BC</div>
                            </div>

                            <div class="card-body">
                                <table class="table table-striped table-responsive">
                                    <tbody>
                                    <tr>
                                        <td width="200">
                                            <p>Project No :</p>
                                        </td>
                                        <td>
                                            {{$project->project_number}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Project Title :</p>
                                        </td>
                                        <td>
                                            {{$project->project_name}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Directorate :
                                        </td>
                                        <td>
                                            {{$project->directoratesProject?->name}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Department :
                                        </td>
                                        <td>
                                            {{$project->ownersproject->name}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Sponsor :
                                        </td>
                                        <td>
                                            {{$project->sponsorsProject->name}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Owner :
                                        </td>
                                        <td>
                                            {{$project->owner}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Sponsor :</td>
                                        <td>
                                            {{$project->sponsor}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            BC Presenter :
                                        </td>
                                        <td>
                                            {{$project->bc_presenter}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            BC Originator :
                                        </td>
                                        <td>
                                            {{$project->bc_originator}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Finance Analyst :
                                        </td>
                                        <td>
                                            {{$project->finance_analyst}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Email PIC :
                                        </td>
                                        <td>
                                            {{$project->email_pic}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h6 class="text-primary-template">Project Type</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-responsive">
                                    <tbody>
                                    <tr>
                                        <td width="200">
                                            <p>Project Type :</p>
                                        </td>
                                        <td>{{$project->baskets->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Project Sub Type :</td>
                                        <td>
                                            {{$project->subBaskets->name}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h6 class="text-primary-template">Business Case</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-responsive">
                                    <tbody>
                                    <tr>
                                        <td width="200">
                                            <p>Problem Statement :</p>
                                        </td>
                                        <td>{!! $project->business_case?->problem_statement_and_objective_text!!}</td>
                                    </tr>
                                    <tr>
                                        <td>Objective :</td>
                                        <td>
                                            {!! $project->business_case?->objective !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Scope of Work :</td>
                                        <td>
                                            {!! $project->business_case?->project_scope_of_work_text !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>NPV :</td>
                                        <td>
                                            {{$project->business_case?->npv}} USD
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            IRR :
                                        </td>
                                        <td>
                                            {{$project->business_case?->irr}} %
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Payback Period :
                                        </td>
                                        <td>
                                            {{$project->business_case?->payback_period}} Year(s)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            TCO :
                                        </td>
                                        <td>
                                            {{$project->business_case?->tco}} USD
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Cost Estimate :
                                        </td>
                                        <td>
                                            {{$project->business_case?->cost_estimate}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Risk Level residual :
                                        </td>
                                        <td>
                                            {{$project->business_case?->riskAssessment?->risk_level_residual ?? ""}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Risk Level Forecast :
                                        </td>
                                        <td>
                                            {{$project->business_case?->riskAssessment?->risk_level_forecast ?? ""}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Risk Deduction :
                                        </td>
                                        <td>
                                            {{$project->business_case?->riskAssessment?->risk_level_deduction ?? ""}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            KPI Summary :
                                        </td>
                                        <td>
                                            <table>
                                                <thead>
                                                <td width="200">KPI</td>
                                                <td width="100%">Est Time to Benefit</td>
                                                </thead>
                                                <tbody>
                                                @foreach($kpiData as $kpi)
                                                    <tr>
                                                        <td>{{$kpi['description']}}</td>
                                                        <td>{{$kpi['time_to_benefit']}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>

                                            </table>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h6 class="text-primary-template">Business Case</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-responsive">
                                    <tbody>
                                    <tr>
                                        <td width="200">
                                            <p>Preliminary Design :</p>
                                        </td>
                                        <td>
                                            @if($project?->getAllAttachment($project->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['preliminary_design']))
                                                <ul>
                                                    @foreach($project?->getAllAttachment($project->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['preliminary_design']) as $pd)
                                                        <li>
                                                            <a target="_blank"
                                                               href="/preview?id={{$project?->id}}&file={{$pd}}&dir={{urlencode($project?->project_number)}}&category=preliminary_design">
                                                                <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                                {{$pd}}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200">
                                            <p>Hazop Study :</p>
                                        </td>
                                        <td>
                                            @if($project?->getAllAttachment($project?->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['hazop']))
                                                <a target="_blank"
                                                   href="/preview?id={{$project?->id}}&file={{urlencode($project?->getAllAttachment($project?->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['hazop']))}}&dir={{urlencode($project?->project_number)}}&category=hazop">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$project?->getAllAttachment($project?->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['hazop'])}}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200">
                                            <p>MOC Document :</p>
                                        </td>
                                        <td>
                                            @if($project?->getAllAttachment($project?->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['moc_document']))
                                                <a target="_blank"
                                                   href="/preview?id={{$project?->id}}&file={{urlencode($project?->getAllAttachment($project?->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['moc_document']))}}&dir={{urlencode($project?->project_number)}}&category=moc_document">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$project?->getAllAttachment($project?->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['moc_document'])}}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200">
                                            <p>Cost Estimate :</p>
                                        </td>
                                        <td>
                                            @if($project?->getAllAttachment($project?->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['cost_estimate_file']))
                                                <a target="_blank"
                                                   href="/preview?id={{$project?->id}}&file={{urlencode($project?->getAllAttachment($project?->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['cost_estimate_file']))}}&dir={{urlencode($project?->project_number)}}&category=cost_estimate_file">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$project?->getAllAttachment($project?->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['cost_estimate_file'])}}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200">
                                            <p>Quotation of Equipment :</p>
                                        </td>
                                        <td>
                                            @if($project?->getAllAttachment($project?->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['quotation_of_equipment']))
                                                <a target="_blank"
                                                   href="/preview?id={{$project?->id}}&file={{urlencode($project?->getAllAttachment($project?->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['quotation_of_equipment']))}}&dir={{urlencode($project?->project_number)}}&category=quotation_of_equipment">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$project?->getAllAttachment($project?->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['quotation_of_equipment'])}}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200">
                                            <p>LCC Report :</p>
                                        </td>
                                        <td>
                                            @if($project?->getAllAttachment($project?->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['lcc_report']))
                                                <a target="_blank"
                                                   href="/preview?id={{$project?->id}}&file={{urlencode($project?->getAllAttachment($project?->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['lcc_report']))}}&dir={{urlencode($project?->project_number)}}&category=lcc_report">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$project?->getAllAttachment($project?->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['lcc_report'])}}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200">
                                            <p>Financial Evaluation :</p>
                                        </td>
                                        <td>
                                            @if($project?->getAllAttachment($project?->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['financial_evaluation']))
                                                <a target="_blank"
                                                   href="/preview?id={{$project?->id}}&file={{urlencode($project?->getAllAttachment($project?->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['financial_evaluation']))}}&dir={{urlencode($project?->project_number)}}&category=financial_evaluation">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$project?->getAllAttachment($project?->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['financial_evaluation'])}}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200">
                                            <p>Risk Assesment :</p>
                                        </td>
                                        <td>
                                            @if($project?->getAllAttachment($project?->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['risk_assessment']))
                                                <a target="_blank"
                                                   href="/preview?id={{$project?->id}}&file={{urlencode($project?->getAllAttachment($project?->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['risk_assessment']))}}&dir={{urlencode($project?->project_number)}}&category=risk_assessment">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$project?->getAllAttachment($project?->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['risk_assessment'])}}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200">
                                            <p>Business Case :</p>
                                        </td>
                                        <td>
                                            @if($project?->getAllAttachment($project?->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['business_case']))
                                                <a target="_blank"
                                                   href="/preview?id={{$project?->id}}&file={{urlencode($project?->getAllAttachment($project?->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['business_case']))}}&dir={{urlencode($project?->project_number)}}&category=business_case">
                                                    <i class="mt-2 fa fa-file-text-o txt-info"></i>
                                                    {{$project?->getAllAttachment($project?->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['business_case'])}}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h6 class="text-primary-template">Document Log Revision</h6>
                            </div>
                            <div class="card-body">
                                @include('page.project.activity_log')
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid js-bc-form d-none">
        <div class="row">
            <div class="col-sm-12 col-xl-12">
                <div class="row">
                    <form method="post" action="/project/{{$project?->id}}"
                          class="theme-form js-project-edit js-project-form">
                        @csrf
                        @method('PUT')
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="text-primary-template float-start">Project Info</h6>
                                    <button class="btn btn-danger js-btn-cancel-edit-bc float-end">Edit BC</button>
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
                </div>
            </div>
        </div>
    </div>
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
    @include('components.modal')

    @include('page.project.notification')
@endsection

