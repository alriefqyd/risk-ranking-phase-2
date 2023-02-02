@inject('setting',App\Models\Setting::class)
<div class="col-md-12">
    <h6 class="font-roboto float-start {{$isView ? 'm-l-15' : ''}}">Maturity Analysis</h6>
</div>
<table class="table table-striped js-table-assessment m-b-35">
    <thead>
        <tr>
            <td class="table-vertical-center">
                Topic
            </td>
            <td>
                Product
            </td>
            <td class="table-vertical-center">
                Description
            </td>
            <td>
                <p>Answer</p>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="table-vertical-center" style="width: 200px">Budgeting </td>
            <td style="width: 100px">
                Investment Estimate (CapEx)
            </td>
            <td style="width: 65%">
                Report of criteria and assumptions used in the elaboration of CapEx,
                including worksheet with the Investment Estimate for Execution based on quotations,
                CPUs (unit price compositions) and database, containing all calculation memories.
            </td>
            <td>
                @if($isView)
                    {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['investment_estimate'], true) !!}
                @else
                    <select name="{{$setting::MATURITY_ANALYSIS_ITEM['investment_estimate']}}"
                            data-idx="0"
                            class="js-maturity-analysis select2 js-maturity-analysis_investment_estimate col-md-12">
                        @foreach($maturityOption as $key => $value)
                            <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['investment_estimate'], false) == $key ? 'selected=selected' : '' !!}
                                    value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                @endif
            </td>
        </tr>
        <tr>
            <td class="table-vertical-center" style="width: 200px;" rowspan="2">Scope </td>
            <td style="width: 100px;">
                Scope
            </td>
            <td style="width: 65%">
                Detailed project scope statement (purchase specifications and definition of motif as well as trailer benefit)
            </td>
            <td>
                @if($isView)
                    {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['scope'], true) !!}
                @else
                    <select name="scope"
                            data-idx="1"
                            class="js-maturity-analysis select2
                        js-maturity-analysis_scope col-md-12">
                        @foreach($maturityOption as $key => $value)
                            <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['scope'], false) == $key ? 'selected=selected' : '' !!}
                                    value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                @endif
            </td>
        </tr>
        <tr>
            <td style="width: 150px">
                Integrated Project Timeline
            </td>
            <td style="width: 65%">
                Project detailing schedule (indicating order shipment to supplies, OS release, receipt of equipment, commissioning, installation)
            </td>
            <td>
                @if($isView)
                    {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['integrated_project_timeline'], true) !!}
                @else
                    <select name="integrated_project_timeline"
                            data-idx="2"
                            class="js-maturity-analysis
                        js-maturity-analysis_integrated_project_timeline
                         select2 col-md-12">
                        @foreach($maturityOption as $key => $value)
                            <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['integrated_project_timeline'], false) == $key ? 'selected=selected' : '' !!}
                                    value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                @endif
            </td>
        </tr>
        <tr>
            <td class="table-vertical-center" style="width: 200px;" >Supply </td>
            <td style="width: 150px">
                Supply Plan
            </td>
            <td style="width: 65%">
                Internal Process Tracking Worksheet for Procurement Led by Supplies
            </td>
            <td>
                @if($isView)
                    {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['supply_plan'], true) !!}
                @else
                    <select name="supply_plan"
                            data-idx="3"
                            class="js-maturity-analysis
                        js-maturity-analysis_supply_plan select2 col-md-12">
                        @foreach($maturityOption as $key => $value)
                            <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['supply_plan'], false) == $key ? 'selected=selected' : '' !!}
                                    value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                @endif
            </td>
        </tr>
        <tr>
            @include('page.maturity_analysis.summary')
        </tr>
    </tbody>
</table>
