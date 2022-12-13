@extends('main')
@section('main')
    <div class="container-fluid dashboard-default-sec">
        <div class="col-sm-12">
{{--            @foreach($notifications as $notification)--}}
{{--                <li>{{$notification->data['note']}}</li>--}}
{{--            @endforeach--}}
        </div>
        <div class="col-sm-12 col-xl-12">
            <div class="card card-absolute">
                <div class="card-header bg-primary">
                    <h5 class="text-white">Welcome</h5>
                </div>
                <div class="card-body">
                    <p style="font-size: 15px" class="mt-4">Risk Ranking Capital Investment and R&D Budget Cycle 2024 - 2027</p>
                </div>
            </div>
        </div>
        <div class="row mt-2" >
            <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card rounded-3 bg-primary b-primary">
                    <div class="card-body text-white" style="height: 136px">
                        <div class="row">
                            <div class="col-md-7">
                                <i data-feather="activity" class="ml-2" style="font-size:25px"></i>
                            </div>
                            <div class="col-md-5">
                                <div class="text-end">
                                    <h5 class="float-right mb-1" style="font-size: 17px">Project</h5>
                                </div>
                                <div class="col mb-3 text-end">
                                    <b class="float-right mb-2 text-center" style="font-size: 17px">{{$projectCount}}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card rounded-3 bg-primary b-primary">
                    <div class="card-body text-white">
                        <div class="row b-b-light">
                            <div class="col-md-5">
                                <i data-feather="list"></i>
                            </div>
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12 text-end">
                                        <h5 class="float-right mb-1" style="font-size: 17px">Assessment</h5>
                                    </div>
                                    <div class="col mb-3 text-end">
                                        <b class="float-right mb-2 text-center" style="font-size: 17px">{{$countAssessment}}</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6 b-r-light text-center">
                                Draft {{$countAssessmentDraft}}
                            </div>
                            <div class="col-md-6 text-center">
                                Publish {{$countAssessmentPublish}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card rounded-3 bg-primary b-primary">
                    <div class="card-body text-white">
                        <div class="row b-b-light">
                            <div class="col-md-8">
                                <i data-feather="file"></i>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="float-right mb-1 text-end" style="font-size: 17px">FEL 1</h5>
                                    </div>
                                    <div class="col mb-3 text-end">
                                        <b class="float-right mb-2" style="font-size: 17px">{{$countFel1}}</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6 b-r-light text-center">
                                Draft {{$countFel1Draft}}
                            </div>
                            <div class="col-md-6 text-center">
                                Publish {{$countFel1Publish}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card rounded-3 bg-primary b-primary">
                    <div class="card-body text-white">
                        <div class="row b-b-light">
                            <div class="col-md-8">
                                <i class="fa fa-files-o" style="font-size: 25px"></i>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12 text-end">
                                        <h5 class="float-right mb-1 text-end" style="font-size: 17px">FEL 2</h5>
                                    </div>
                                    <div class="col mb-3 text-end">
                                        <b class="float-right mb-2" style="font-size: 17px">{{$countFel2}}</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6 b-r-light text-center">
                                Draft {{$countFel2Draft}}
                            </div>
                            <div class="col-md-6 text-center">
                                Publish {{$countFel2Publish}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card rounded-3 bg-primary b-primary">
                    <div class="card-body text-white">
                        <div class="row b-b-light">
                            <div class="col-md-8">
                                <i data-feather="layers"></i>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12 text-end">
                                        <h5 class="float-right mb-1" style="font-size: 17px">FEL 3</h5>
                                    </div>
                                    <div class="col text-end mb-3">
                                        <b class="float-right mb-2" style="font-size: 17px">{{$countFel3}}</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6 b-r-light text-center">
                                Draft {{$countFel3Draft}}
                            </div>
                            <div class="col-md-6 text-center">
                                Publish {{$countFel3Publish}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card rounded-3 bg-primary b-primary">
                    <div class="card-body text-white">
                        <div class="row b-b-light">
                            <div class="col-md-4">
                                <i data-feather="dollar-sign"></i>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12 text-end">
                                        <h5 class="float-right mb-1" style="font-size: 17px">Business Case</h5>
                                    </div>
                                    <div class="mb-3 text-end">
                                        <b class="float-right mb-2" style="font-size: 17px">{{$countBC}}</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6 b-r-light text-center">
                                Draft {{$countBCDraft}}
                            </div>
                            <div class="col-md-6 text-center">
                                Publish {{$countBCPublish}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12 box-col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Summary Chart</h5>
                    </div>
                    <div class="card-body chart-block" >
                        <div class="flot-chart-container" style="height: auto">
                            <canvas class="flot-chart-placeholder" id="stacked-bar-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
