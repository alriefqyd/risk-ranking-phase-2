@extends('main')
@section('main')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3>{{$project->project_name}}</h3>
                    <smal>{{$project->project_type}}</smal>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/project">project list</a></li>
                        <li class="breadcrumb-item">project Detail</li>
                        <li class="breadcrumb-item active">{{$project->project_name}}</li>
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
                            <li class="nav-item"><a class="nav-link js-reset-check-count {{!Session::has('page-tab') ? 'active' : ''}}" id="project-tab" data-bs-toggle="tab" href="#project" role="tab" aria-controls="project" aria-selected="true">Project</a></li>
                            <li class="nav-item"><a class="nav-link js-reset-check-count {{Session::get('page-tab') == 'assessment' ? 'active' : ''}}" id="assessment-tabs" data-bs-toggle="tab" href="#assessment" role="tab" aria-controls="assessment" aria-selected="false">Assessment</a></li>
                            <li class="nav-item"><a class="nav-link js-reset-check-count {{Session::get('page-tab') == 'fel1' ? 'active' : ''}}" id="fel1-tabs" data-bs-toggle="tab" href="#fel1" role="tab" aria-controls="fel1" aria-selected="false">FEL 1</a></li>
                            <li class="nav-item"><a class="nav-link js-reset-check-count {{Session::get('page-tab') == 'fel2' ? 'active' : ''}}" id="fel2-tabs" data-bs-toggle="tab" href="#fel2" role="tab" aria-controls="fel2" aria-selected="false">FEL 2</a></li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane js-tab-parent fade show {{!Session::has('page-tab') ? 'active show' : ''}}" id="project" role="tabpanel" aria-labelledby="project-tab">
                                @include('page.project.project_tab')
                            </div>
                            <div class="tab-pane fade js-tab-parent {{Session::get('page-tab') == 'assessment' ? 'active show' : ''}}" id="assessment" role="tabpanel" aria-labelledby="assessment-tab">
                                @include('page.assessment.assessment_tab')
                            </div>
                            <div class="tab-pane fade js-tab-parent {{Session::get('page-tab') == 'fel1' ? 'active show' : ''}}" id="fel1" role="tabpanel" aria-labelledby="fel1-tab">
                                @include('page.fel1.fel1_tab')
                            </div>
                            <div class="tab-pane fade js-tab-parent {{Session::get('page-tab') == 'fel2' ? 'active show' : ''}}" id="fel2" role="tabpanel" aria-labelledby="fel2-tab">
                                @include('page.fel2.fel2_tab')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('page.project.notification')
@endsection
