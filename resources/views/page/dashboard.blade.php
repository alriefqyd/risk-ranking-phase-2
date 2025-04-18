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
            @if(auth()->user()->role == "Administrator")
            <div class="col-lg-7 col-sm-7 box-col-7">
                <div class="card">
                    <div class="card-header pb-0" style="border: 0px !important">
                        <h5>Risk Matrix</h5>
                    </div>
                    <div class="card-body">
                        <div class="tabbed-card" style="">
                            <ul class="pull-right nav nav-pills nav-primary" id="pills-clrtab1" role="tablist" style="top:9px !important;">
                                <li class="nav-item"><a class="nav-link active" id="pills-clrhome-tab1" data-bs-toggle="pill" href="#pills-clrhome1" role="tab" aria-controls="pills-clrhome1" aria-selected="true">Residual</a></li>
                                <li class="nav-item"><a class="nav-link" id="pills-clrprofile-tab1" data-bs-toggle="pill" href="#pills-clrprofile1" role="tab" aria-controls="pills-clrprofile1" aria-selected="false">Forecast</a></li>
                            </ul>
                            <div class="tab-content" id="pills-clrtabContent1">
                                <div class="tab-pane fade show active" id="pills-clrhome1" role="tabpanel" aria-labelledby="pills-clrhome-tab1">
                                    <div class="flex justify-center items-center js-risk-level-residual mt-3">
                                        <div class="text-center">
                                            <div class="grid grid-cols-6 grid-rows-6 gap-1 text-center font-semibold">
                                                <!-- Top Header -->
                                                <div class="col-span-1 row-span-1"></div>
                                                <div class="bg-gray-300 p-1">Very Remote</div>
                                                <div class="bg-gray-300 p-1">Remote</div>
                                                <div class="bg-gray-300 p-1">Possible</div>
                                                <div class="bg-gray-300 p-1">Likely</div>
                                                <div class="bg-gray-300 p-1">Very Likely</div>

                                                <!-- Risk Matrix 5x5 with Left Header -->
                                                <div class="bg-gray-300 p-1">Very Critical</div>
                                                <div class="bg-orange-400 cursor-pointer p-1 text-white">$ {{number_format($budgetRiskLevelResidual[7],'2','.',',')}}</div>
                                                <div class="bg-orange-400 p-1 text-white">$ {{number_format($budgetRiskLevelResidual[6],'2','.',',')}}</div>
                                                <div class="bg-red-500 p-1 text-white">$ {{number_format($budgetRiskLevelResidual[2],'2','.',',')}}</div>
                                                <div class="bg-red-500 p-1 text-white">$ {{number_format($budgetRiskLevelResidual[1],'2','.',',')}}</div>
                                                <div class="bg-red-500 p-1 text-white">$ {{number_format($budgetRiskLevelResidual[0],'2','.',',')}}</div>

                                                <div class="bg-gray-300 p-1">Critical</div>
                                                <div class="bg-orange-400 p-1 text-white">$ {{number_format($budgetRiskLevelResidual[10],'2','.',',')}}</div>
                                                <div class="bg-orange-400 p-1 text-white">$ {{number_format($budgetRiskLevelResidual[9],'2','.',',')}}</div>
                                                <div class="bg-orange-400 p-1 text-white">$ {{number_format($budgetRiskLevelResidual[8],'2','.',',')}}</div>
                                                <div class="bg-red-500 p-1 text-white p-1">$ {{number_format($budgetRiskLevelResidual[4],'2','.',',')}}</div>
                                                <div class="bg-red-500 p-1 text-white">$ {{number_format($budgetRiskLevelResidual[3],'2','.',',')}}</div>

                                                <div class="bg-gray-300 p-1">Significant</div>
                                                <div class="bg-yellow-400 p-1 text-white">$ {{number_format($budgetRiskLevelResidual[14],'2','.',',')}}</div>
                                                <div class="bg-yellow-400 p-1 text-white">$ {{number_format($budgetRiskLevelResidual[13],'2','.',',')}}</div>
                                                <div class="bg-orange-400 p-1 text-white">$ {{number_format($budgetRiskLevelResidual[12],'2','.',',')}}</div>
                                                <div class="bg-orange-400 p-1 text-white">$ {{number_format($budgetRiskLevelResidual[11],'2','.',',')}}</div>
                                                <div class="bg-red-500 p-1 text-white">$ {{number_format($budgetRiskLevelResidual[5],'2','.',',')}}</div>

                                                <div class="bg-gray-300 p-1">Moderate</div>
                                                <div class="bg-green-400 p-1 text-white">$ {{number_format($budgetRiskLevelResidual[21],'2','.',',')}}</div>
                                                <div class="bg-green-400 p-1 text-white">$ {{number_format($budgetRiskLevelResidual[20],'2','.',',')}}</div>
                                                <div class="bg-yellow-400 p-1 text-white">$ {{number_format($budgetRiskLevelResidual[17],'2','.',',')}}</div>
                                                <div class="bg-yellow-400 p-1 text-white">$ {{number_format($budgetRiskLevelResidual[16],'2','.',',')}}</div>
                                                <div class="bg-yellow-400 p-1 text-white">$ {{number_format($budgetRiskLevelResidual[15],'2','.',',')}}</div>

                                                <div class="bg-gray-300 p-1">Low</div>
                                                <div class="bg-green-400 p-1 text-white">$ {{number_format($budgetRiskLevelResidual[24],'2','.',',')}}</div>
                                                <div class="bg-green-400 p-1 text-white">$ {{number_format($budgetRiskLevelResidual[23],'2','.',',')}}</div>
                                                <div class="bg-green-400 p-1 text-white">$ {{number_format($budgetRiskLevelResidual[22],'2','.',',')}}</div>
                                                <div class="bg-yellow-400 p-1 text-white">$ {{number_format($budgetRiskLevelResidual[19],'2','.',',')}}</div>
                                                <div class="bg-yellow-400 p-1 text-white">$ {{number_format($budgetRiskLevelResidual[18],'2','.',',')}}</div>
                                            </div>

                                            <!-- Axis Labels -->
                                            <div class="flex justify-between items-center mt-4">
                                                <span class="rotate-[-90deg] absolute p-b-40 text-sm" style="right: 85%; top:10rem; width:150px">Impact of Risk</span>
                                                <span class="text-sm center-content">Probability of Risk</span>
                                            </div>
                                            <!-- Legend -->
                                            <div class="flex gap-4 mt-2">
                                                <h3 class="font-semibold text-gray-800 mt-5">Priority Legend:</h3>
                                            </div>
                                            <div class="flex gap-4 mt-2">
                                                <span class="flex items-center"><span class="w-4 h-4 bg-red-500 rounded inline-block mr-2"></span> Very High</span>
                                                <span class="flex items-center"><span class="w-4 h-4 bg-orange-500 rounded inline-block mr-2"></span> High</span>
                                                <span class="flex items-center"><span class="w-4 h-4 bg-yellow-400 rounded inline-block mr-2"></span> Medium</span>
                                                <span class="flex items-center"><span class="w-4 h-4 bg-green-500 rounded inline-block mr-2"></span> Low</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-clrprofile1" role="tabpanel" aria-labelledby="pills-clrprofile-tab1">
                                    <div class="mt-3 flex justify-center items-center js-risk-">
                                        <div class="text-center">
                                            <div class="grid grid-cols-6 grid-rows-6 gap-1 text-center font-semibold">
                                                <!-- Top Header -->
                                                <div class="col-span-1 row-span-1"></div>
                                                <div class="bg-gray-300 p-1">Very Remote</div>
                                                <div class="bg-gray-300 p-1">Remote</div>
                                                <div class="bg-gray-300 p-1">Possible</div>
                                                <div class="bg-gray-300 p-1">Likely</div>
                                                <div class="bg-gray-300 p-1">Very Likely</div>

                                                <!-- Risk Matrix 5x5 with Left Header -->
                                                <div class="bg-gray-300 p-1">Very Critical</div>
                                                <div class="bg-orange-400 cursor-pointer p-1 text-white">$ {{number_format($budgetRiskLevelForecast[7],'2','.',',')}}</div>
                                                <div class="bg-orange-400 p-1 text-white">$ {{number_format($budgetRiskLevelForecast[6],'2','.',',')}}</div>
                                                <div class="bg-red-500 p-1 text-white">$ {{number_format($budgetRiskLevelForecast[2],'2','.',',')}}</div>
                                                <div class="bg-red-500 p-1 text-white">$ {{number_format($budgetRiskLevelForecast[1],'2','.',',')}}</div>
                                                <div class="bg-red-500 p-1 text-white">$ {{number_format($budgetRiskLevelForecast[0],'2','.',',')}}</div>

                                                <div class="bg-gray-300 p-1">Critical</div>
                                                <div class="bg-orange-400 p-1 text-white">$ {{number_format($budgetRiskLevelForecast[10],'2','.',',')}}</div>
                                                <div class="bg-orange-400 p-1 text-white">$ {{number_format($budgetRiskLevelForecast[9],'2','.',',')}}</div>
                                                <div class="bg-orange-400 p-1 text-white">$ {{number_format($budgetRiskLevelForecast[8],'2','.',',')}}</div>
                                                <div class="bg-red-500 p-1 text-white p-1">$ {{number_format($budgetRiskLevelForecast[4],'2','.',',')}}</div>
                                                <div class="bg-red-500 p-1 text-white">$ {{number_format($budgetRiskLevelForecast[3],'2','.',',')}}</div>

                                                <div class="bg-gray-300 p-1">Significant</div>
                                                <div class="bg-yellow-400 p-1 text-white">$ {{number_format($budgetRiskLevelForecast[14],'2','.',',')}}</div>
                                                <div class="bg-yellow-400 p-1 text-white">$ {{number_format($budgetRiskLevelForecast[13],'2','.',',')}}</div>
                                                <div class="bg-orange-400 p-1 text-white">$ {{number_format($budgetRiskLevelForecast[12],'2','.',',')}}</div>
                                                <div class="bg-orange-400 p-1 text-white">$ {{number_format($budgetRiskLevelForecast[11],'2','.',',')}}</div>
                                                <div class="bg-red-500 p-1 text-white">$ {{number_format($budgetRiskLevelForecast[5],'2','.',',')}}</div>

                                                <div class="bg-gray-300 p-1">Moderate</div>
                                                <div class="bg-green-400 p-1 text-white">$ {{number_format($budgetRiskLevelForecast[21],'2','.',',')}}</div>
                                                <div class="bg-green-400 p-1 text-white">$ {{number_format($budgetRiskLevelForecast[20],'2','.',',')}}</div>
                                                <div class="bg-yellow-400 p-1 text-white">$ {{number_format($budgetRiskLevelForecast[17],'2','.',',')}}</div>
                                                <div class="bg-yellow-400 p-1 text-white">$ {{number_format($budgetRiskLevelForecast[16],'2','.',',')}}</div>
                                                <div class="bg-yellow-400 p-1 text-white">$ {{number_format($budgetRiskLevelForecast[15],'2','.',',')}}</div>

                                                <div class="bg-gray-300 p-1">Low</div>
                                                <div class="bg-green-400 p-1 text-white">$ {{number_format($budgetRiskLevelForecast[24],'2','.',',')}}</div>
                                                <div class="bg-green-400 p-1 text-white">$ {{number_format($budgetRiskLevelForecast[23],'2','.',',')}}</div>
                                                <div class="bg-green-400 p-1 text-white">$ {{number_format($budgetRiskLevelForecast[22],'2','.',',')}}</div>
                                                <div class="bg-yellow-400 p-1 text-white">$ {{number_format($budgetRiskLevelForecast[19],'2','.',',')}}</div>
                                                <div class="bg-yellow-400 p-1 text-white">$ {{number_format($budgetRiskLevelForecast[18],'2','.',',')}}</div>
                                            </div>

                                            <!-- Axis Labels -->
                                            <div class="flex justify-between items-center mt-4">
                                                <span class="rotate-[-90deg] absolute p-b-40 text-sm" style="right: 85%; top:10rem; width:150px">Impact of Risk</span>
                                                <span class="text-sm center-content">Probability of Risk</span>
                                            </div>
                                            <!-- Legend -->
                                            <div class="flex gap-4 mt-2">
                                                <h3 class="font-semibold text-gray-800 mt-5">Priority Legend:</h3>
                                            </div>
                                            <div class="flex gap-4 mt-2">
                                                <span class="flex items-center"><span class="w-4 h-4 bg-red-500 rounded inline-block mr-2"></span> Very High</span>
                                                <span class="flex items-center"><span class="w-4 h-4 bg-orange-500 rounded inline-block mr-2"></span> High</span>
                                                <span class="flex items-center"><span class="w-4 h-4 bg-yellow-400 rounded inline-block mr-2"></span> Medium</span>
                                                <span class="flex items-center"><span class="w-4 h-4 bg-green-500 rounded inline-block mr-2"></span> Low</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-clrcontact1" role="tabpanel" aria-labelledby="pills-clrcontact-tab1">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-sm-5 box-col-5">
                <div class="card" style="height: 495px">
                    <div class="card-header pb-0" style="border: 0px !important">
                        <h5>Risk Priority</h5>
                    </div>
                    <div class="card-body">
                        <div class="tabbed-card">
                            <ul class="pull-right nav nav-pills nav-primary" id="pills-clrtab21" role="tablist" style="top:9px !important;">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-clrhome-tab21" data-bs-toggle="pill" href="#pills-clrhome21" role="tab" aria-controls="pills-clrhome21" aria-selected="true">Residual</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-clrprofile-tab21" data-bs-toggle="pill" href="#pills-clrprofile21" role="tab" aria-controls="pills-clrprofile21" aria-selected="false">Forecast</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="pills-clrtabContent21">
                                <div class="tab-pane fade show active" id="pills-clrhome21" role="tabpanel" aria-labelledby="pills-clrhome-tab21">
                                    <canvas class="flot-chart-placeholder" width="800" height="700" id="stacked-bar-chart-priority_risk"></canvas>
                                </div>
                                <div class="tab-pane fade" id="pills-clrprofile21" role="tabpanel" aria-labelledby="pills-clrprofile-tab21">
                                    <canvas class="flot-chart-placeholder" style="" id="stacked-bar-chart-priority_risk-forecast"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
