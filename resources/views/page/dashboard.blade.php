@extends('main')
@section('main')
    <div class="container-fluid dashboard-default-sec">
        <div class="col-sm-12">
{{--            @foreach($notifications as $notification)--}}
{{--                <li>{{$notification->data['note']}}</li>--}}
{{--            @endforeach--}}
        </div>

        <div class="row mt-2" >
            <div class="col-sm-8 col-xl-8">
                <div class="card card-absolute">
                    <div class="card-header bg-primary">
                        <h5 class="text-white">Welcome</h5>
                    </div>
                    <div class="card-body">
                        <p style="font-size: 15px" class="mt-4">Risk Ranking Capital Investment and R&D Budget Cycle {{$years}}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4 col-lg-6 mt-4">
                <div class="card o-hidden border-0">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg></div>
                            <div class="media-body"><span class="m-0">Num of BC</span>
                                <h4 class="mb-0 counter">{{$projectCount}}</h4><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database icon-bg"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

{{--            <div class="col-sm-6 col-xl-4 col-lg-6">--}}
{{--                <div class="card rounded-3 bg-primary b-primary">--}}
{{--                    <div class="card-body text-white">--}}
{{--                        <div class="row b-b-light">--}}
{{--                            <div class="col-md-5">--}}
{{--                                <i data-feather="list"></i>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-7">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-md-12 text-end">--}}
{{--                                        <h5 class="float-right mb-1" style="font-size: 17px">Assessment</h5>--}}
{{--                                    </div>--}}
{{--                                    <div class="col mb-3 text-end">--}}
{{--                                        <b class="float-right mb-2 text-center" style="font-size: 17px">{{$countAssessment}}</b>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row mt-2">--}}
{{--                            <div class="col-md-6 b-r-light text-center">--}}
{{--                                Draft {{$countAssessmentDraft}}--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6 text-center">--}}
{{--                                Publish {{$countAssessmentPublish}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-sm-6 col-xl-4 col-lg-6">--}}
{{--                <div class="card rounded-3 bg-primary b-primary">--}}
{{--                    <div class="card-body text-white">--}}
{{--                        <div class="row b-b-light">--}}
{{--                            <div class="col-md-8">--}}
{{--                                <i data-feather="file"></i>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        <h5 class="float-right mb-1 text-end" style="font-size: 17px">FEL 1</h5>--}}
{{--                                    </div>--}}
{{--                                    <div class="col mb-3 text-end">--}}
{{--                                        <b class="float-right mb-2" style="font-size: 17px">{{$countFel1}}</b>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row mt-2">--}}
{{--                            <div class="col-md-6 b-r-light text-center">--}}
{{--                                Draft {{$countFel1Draft}}--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6 text-center">--}}
{{--                                Publish {{$countFel1Publish}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-sm-6 col-xl-4 col-lg-6">--}}
{{--                <div class="card rounded-3 bg-primary b-primary">--}}
{{--                    <div class="card-body text-white">--}}
{{--                        <div class="row b-b-light">--}}
{{--                            <div class="col-md-8">--}}
{{--                                <i class="fa fa-files-o" style="font-size: 25px"></i>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-md-12 text-end">--}}
{{--                                        <h5 class="float-right mb-1 text-end" style="font-size: 17px">FEL 2</h5>--}}
{{--                                    </div>--}}
{{--                                    <div class="col mb-3 text-end">--}}
{{--                                        <b class="float-right mb-2" style="font-size: 17px">{{$countFel2}}</b>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row mt-2">--}}
{{--                            <div class="col-md-6 b-r-light text-center">--}}
{{--                                Draft {{$countFel2Draft}}--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6 text-center">--}}
{{--                                Publish {{$countFel2Publish}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-sm-6 col-xl-4 col-lg-6">--}}
{{--                <div class="card rounded-3 bg-primary b-primary">--}}
{{--                    <div class="card-body text-white">--}}
{{--                        <div class="row b-b-light">--}}
{{--                            <div class="col-md-8">--}}
{{--                                <i data-feather="layers"></i>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-md-12 text-end">--}}
{{--                                        <h5 class="float-right mb-1" style="font-size: 17px">FEL 3</h5>--}}
{{--                                    </div>--}}
{{--                                    <div class="col text-end mb-3">--}}
{{--                                        <b class="float-right mb-2" style="font-size: 17px">{{$countFel3}}</b>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row mt-2">--}}
{{--                            <div class="col-md-6 b-r-light text-center">--}}
{{--                                Draft {{$countFel3Draft}}--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6 text-center">--}}
{{--                                Publish {{$countFel3Publish}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-sm-6 col-xl-4 col-lg-6">--}}
{{--                <div class="card rounded-3 bg-primary b-primary">--}}
{{--                    <div class="card-body text-white">--}}
{{--                        <div class="row b-b-light">--}}
{{--                            <div class="col-md-4">--}}
{{--                                <i data-feather="dollar-sign"></i>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-8">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-md-12 text-end">--}}
{{--                                        <h5 class="float-right mb-1" style="font-size: 17px">Business Case</h5>--}}
{{--                                    </div>--}}
{{--                                    <div class="mb-3 text-end">--}}
{{--                                        <b class="float-right mb-2" style="font-size: 17px">{{$countBC}}</b>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row mt-2">--}}
{{--                            <div class="col-md-6 b-r-light text-center">--}}
{{--                                Draft {{$countBCDraft}}--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6 text-center">--}}
{{--                                Publish {{$countBCPublish}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
        {{--<div class="row mt-2" >
            @foreach($countBasketCategory as $key => $value)
                <div class="col-sm-14 col-md-6 col-lg-4">
                    <div class="ribbon-wrapper card">
                        <div class="card-body">
                            <div class="ribbon ribbon-clip ribbon-primary"><p class="text-2xl">{{$key}}</p></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped">
                                        @foreach($value as $k => $v)
                                            <tr>
                                                <td><p class="text-2xl">{{$k}}</p></td>
                                                <td><span class="badge badge-primary counter"><p class="text-2xl">{{$v}}</p></span></td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>--}}
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>BC Submitted</h5>
                    </div>
                    <div class="card-body chart-block m-t-30 p-1" >
                        <div class="flot-chart-container" style="height:auto">
                            <canvas class="flot-chart-placeholder" width="800" height="500" id="project-stacked-bar-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
{{--            <div class="col-lg-7 col-sm-6 box-col-6">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header pb-0">--}}
{{--                        <h5>Project Basket</h5>--}}
{{--                    </div>--}}
{{--                    <div class="card-body chart-block m-t-30" >--}}
{{--                        <div class="flot-chart-container" style="height:650px">--}}
{{--                            <canvas class="flot-chart-placeholder" width="800" height="400" id="stacked-bar-chart"></canvas>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="col-lg-6 col-sm-6 box-col-6">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Investment Type</h5>
                    </div>
                    <div class="card-body chart-block m-t-30" >
                        <div class="flot-chart-container" style="height:auto">
                            <canvas class="flot-chart-placeholder" width="800" height="480" id="stacked-bar-chart-investment-strategy"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
