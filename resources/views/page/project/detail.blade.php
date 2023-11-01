@extends('main')
@section('main')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3>{{$project?->project_name}}</h3>
                    <smal>{{$project?->project_type}}</smal>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/project">project list</a></li>
                        <li class="breadcrumb-item">project Detail</li>
                        <li class="breadcrumb-item active">{{$project?->project_name}}</li>
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
                            @if(isset($project->categories))
                                <li class="nav-item">
                                    <a class="nav-link js-reset-check-count {{Session::get('page-tab') == 'budget_tool_training' ? 'active' : ''}}" id="budget_tool_training-tabs" data-bs-toggle="tab" href="#budget_tool_training" role="tab" aria-controls="budget_tool_training" aria-selected="false">
                                        Budget Tool {!!sizeof($project?->criterias) > 0 ? '<i class="fa fa-check-circle-o"></i>' : '' !!}
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link js-reset-check-count {!! isset($project->categories) && sizeof($project->criterias) < 1? 'disabled' : '' !!} {{Session::get('page-tab') == 'assessment' ? 'active' : ''}}" id="assessment-tabs" data-bs-toggle="tab" href="#assessment" role="tab" aria-controls="assessment" aria-selected="false">
                                    Assessment {!!$project?->assessment ? '<i class="fa fa-check-circle-o"></i>' : '' !!}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link js-reset-check-count  {!! !isset($project->assessment) ? 'disabled' : '' !!} {{Session::get('page-tab') == 'fel1' ? 'active' : ''}}" id="fel1-tabs" data-bs-toggle="tab" href="#fel1" role="tab" aria-controls="fel1" aria-selected="false">FEL 1
                                    {!! $project?->fel1 ? '<i class="fa fa-check-circle-o"></i>' : '' !!}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link js-reset-check-count  {!! !isset($project->assessment) ? 'disabled' : '' !!} {{Session::get('page-tab') == 'fel2' ? 'active' : ''}}" id="fel2-tabs" data-bs-toggle="tab" href="#fel2" role="tab" aria-controls="fel2" aria-selected="false">FEL 2
                                    {!!$project?->fel2 ? '<i class="fa fa-check-circle-o"></i>' : '' !!}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link js-reset-check-count {!! !isset($project->assessment) ? 'disabled' : '' !!} {{Session::get('page-tab') == 'fel3' ? 'active' : ''}}" id="fel3-tabs" data-bs-toggle="tab" href="#fel3" role="tab" aria-controls="fel3" aria-selected="false">
                                    FEL 3 {!!$project?->fel3 ? '<i class="fa fa-check-circle-o"></i>' : '' !!}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link js-reset-check-count {!! !isset($project->fel3) && !isset($project->fel2) && !isset($project->fel1) ? 'disabled' : '' !!} {{Session::get('page-tab') == 'business-case' ? 'active' : ''}}" id="business-case-tabs" data-bs-toggle="tab" href="#business-case" role="tab" aria-controls="business-case" aria-selected="false">
                                    Business Case {!!$project?->business_case ? '<i class="fa fa-check-circle-o"></i>' : '' !!}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link js-reset-check-count {!! !isset($project->business_case) ? 'disabled' : '' !!} {{Session::get('page-tab') == 'cost-benefit' ? 'active' : ''}}" id="cost-benefit-tabs" data-bs-toggle="tab" href="#cost-benefit" role="tab" aria-controls="cost-benefit" aria-selected="false">
                                    Cost Benefit {!!$project?->cost_benefits ? '<i class="fa fa-check-circle-o"></i>' : '' !!}
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane js-tab-parent fade show {{!Session::has('page-tab') ? 'active show' : ''}}" id="project" role="tabpanel" aria-labelledby="project-tab">
                                @include('page.project.project_tab')
                            </div>
                            <div class="tab-pane js-tab-parent fade show" id="budget_tool_training" role="tabpanel" aria-labelledby="project-tab">
                                @include('page.project.budget_tool')
                            </div>

                            @if(!isset($project->categories) || isset($project->categories) && sizeof($project->criterias) > 0)
                                <div class="tab-pane fade js-tab-parent show" id="assessment" role="tabpanel" aria-labelledby="assessment-tab">
                                    @include('page.assessment.assessment_tab')
                                </div>
                            @endif
                            @if(isset($project->assessment))
                                <div class="tab-pane fade js-tab-parent show" id="fel1" role="tabpanel" aria-labelledby="fel1-tab">
                                    @include('page.fel1.fel1_tab')
                                </div>
                            @endif
                            @if(isset($project->assessment))
                                <div class="tab-pane fade js-tab-parent show" id="fel2" role="tabpanel" aria-labelledby="fel2-tab">
                                    @include('page.fel2.fel2_tab')
                                </div>
                            @endif
                            @if(isset($project->assessment))
                                <div class="tab-pane fade js-tab-parent show" id="fel3" role="tabpanel" aria-labelledby="fel3-tab">
                                    @include('page.fel3.fel3_tab')
                                </div>
                            @endif
                            @if(isset($project->fel3) || isset($project->fel2) || isset($project->fel1))
                                <div class="tab-pane fade js-tab-parent show" id="business-case" role="tabpanel" aria-labelledby="business-case-tab">
                                    @include('page.business_case.bc_tab')
                                </div>
                            @endif
                            @if(isset($project->business_case))
                                <div class="tab-pane fade js-tab-parent show" id="cost-benefit" role="tabpanel" aria-labelledby="cost-benefit-tab">
                                    @include('page.cost_benefit.cost_benefit_tab')
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(!$isAdmin)
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>Remark</h6>
                        </div>
                        <hr>
                        <div class="card-body">
                            <p>{!! $project?->note !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @include('page.project.notification')
@endsection
