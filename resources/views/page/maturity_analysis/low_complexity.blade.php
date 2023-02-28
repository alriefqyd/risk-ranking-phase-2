<h6 class="font-roboto float-start m-l-15">Maturity Analysis</h6>
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
            Answer
        </td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="table-vertical-center" rowspan="2">Budgeting </td>
        <td style="width: 50px">
            Investment Estimate (CapEx)
        </td>
        <td style="width: 70%">
            Define budget for project execution containing, if applicable:
            <li>Values relating to civil works, assembly, supplies, leases, spare parts, systems and equipment</li>
            <li>Values for engineering, supervision, personnel, environment, S & S, land management, insurance, communities, sustainability, communication, administrative apportionment, pre-operational expenses, escalation and contingencies</li>
            <li>Criteria, currencies, exchange rates and other assumptions used in the preparation of the budget</li>
        </td>
        <td>
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['investment_estimate'], true) !!}
            @else
                <select name="investment_estimate" class="js-maturity-analysis
                js-maturity-analysis_investment_estimate select2 col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['investment_estimate'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td style="width: 100px;">
            Physical and financial monthly disbursement curve
        </td>
        <td style="width: 65%">
            Elaborate the monthly disbursement curves in the economic and financial visions
        </td>
        <td>
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['physical_and_financial'], true) !!}
            @else
                <select name="physical_and_financial"
                        class="js-maturity-analysis
                        js-maturity-analysis_physical_and_financial select2 col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['physical_and_financial'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td class="table-vertical-center" rowspan="5">Scope</td>
        <td style="width: 100px;">
            Scope Statement
        </td>
        <td style="width: 65%">
            Main Purpose and Deliveries, Major Equipment and Facilities, Exclusions from Scope, Assumptions and Battery Limit
        </td>
        <td>
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['scope_statement'], true) !!}
            @else
                <select name="scope_statement" class="js-maturity-analysis
                js-maturity-analysis_scope_statement select2 col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['scope_statement'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td style="width: 100px;">
            Project Opening Term (TAP)
        </td>
        <td style="width: 65%">
            Key project macro information such as, Lead Team and Project Definition, Preliminary Budget, Summary Scope, Macro Deadlines and Costs.
        </td>
        <td>
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['project_opening_term'], true) !!}
            @else
                <select name="project_opening_term"
                        class="js-maturity-analysis js-maturity-analysis_project_opening_term select2 col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['project_opening_term'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td style="width: 100px;">
            Integrated Project Timeline
        </td>
        <td style="width: 65%">
            Integrated project schedule, containing:
            <li>EAP structured according to the complexity of the project</li>
            <li>Relationship of interdependence and sequencing of activities</li>
            <li>Productivity. Service fronts</li>
            <li>Availability of equipment and labor</li>
            <li>Definitive and temporary access</li>
            <li>Infrastructure and utilities for the work and flowerbeds</li>
            <li>Logistics and storage of materials / equipment</li>
            <li>Tie-ins</li>
            <li>Integration of interface areas (environment, licenses and authorizations, land management, health and safety, among others) that are applicable to the project</li>
        </td>
        <td>
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['integrated_project_timeline'], true) !!}
            @else
                <select name="integrated_project_timeline"
                        class="js-maturity-analysis
                        js-maturity-analysis_integrated_project_timeline select2 col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['integrated_project_timeline'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td style="width: 100px;">
            Save baseline
        </td>
        <td style="width: 65%">
            Record baseline and generate S-curve for future comparative analysis
        </td>
        <td>
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['save_baseline'], true) !!}
            @else
                <select name="save_baseline" class="js-maturity-analysis
                js-maturity-analysis_save_baseline select2 col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['save_baseline'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td style="width: 100px;">
            Definition of physical advance criterion
        </td>
        <td style="width: 65%">
            Establish criteria for physical advancement and consideration of activities
        </td>
        <td>
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['definition_of_physical'], true) !!}
            @else
                <select name="definition_of_physical" class="js-maturity-analysis
                js-maturity-analysis_definition_of_physical select2 col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['definition_of_physical'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td>
            Engineer
        </td>
        <td style="width: 100px;">
            Develop basic engineering
        </td>
        <td style="width: 65%">
            The basic design consists of the elaboration, from the information resulting from the feasibility study, of all activities and engineering documents
            (flowcharts, descriptive memorials, local conditions, quantity worksheets, equipment and material lists, technical requisitions, etc.)
            that allow the purchase process of the equipment and services, as well as the planning and budgeting of the Execution phase.
        </td>
        <td>
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['develop_basic_engineering'], true) !!}
            @else
                <select name="develop_basic_engineering" class="js-maturity-analysis
                js-maturity-analysis_develop_basic_engineering select2 col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['develop_basic_engineering'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td>
            License
        </td>
        <td style="width: 100px;">
            Identification of all licenses and local authorizations required to implement
        </td>
        <td style="width: 65%">
            Identify the licenses, grants and authorizations required for the stages of project development and implementation, including them in Integrated Planning
            (eg, drafting, submitting and obtaining permits from city halls, state bodies, fire brigades, regulatory agencies, etc.)
        </td>
        <td>
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['identification_all_licenses'], true) !!}
            @else
                <select name="identification_all_license" class="js-maturity-analysis
                js-maturity-analysis_identification_all_license select2 col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['identification_all_licenses'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td>
            Supply
        </td>
        <td style="width: 100px;">
            Supply Plan
        </td>
        <td style="width: 65%">
            <li>Set packaging</li>
            <li>Define contractual arrangements</li>
            <li>Define scheduling of hiring packages</li>
            <li>Elaborate the map of monitoring of supplies (MAS)</li>
        </td>
        <td>
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['supply_plan'], true) !!}
            @else
                <select name="supply_plan" class="js-maturity-analysis
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
        <td rowspan="3">
            Local Factors
        </td>
        <td style="width: 100px;">
            On - Site Conditions
        </td>
        <td style="width: 65%">
            Specific soil data and existing conditions are not available, but general conditions are known and considered in development.
        </td>
        <td>
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['on_site_conditions'], true) !!}
            @else
                <select name="on_site_conditions" class="js-maturity-analysis
                js-maturity-analysis_on_site_conditions select2 col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['on_site_conditions'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td style="width: 100px;">
            Rental plants / equipment configurations
        </td>
        <td style="width: 65%">
            Layout and requirements derived from similar processes.
        </td>
        <td>
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['rental_plants'], true) !!}
            @else
                <select name="rental_plants" class="js-maturity-analysis
                js-maturity-analysis_rental_plants select2 col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['rental_plants'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td style="width: 100px;">
            Health and safety requirements
        </td>
        <td style="width: 65%">
            No formal analysis, but generic norms and standards for the site and process were identified and incorporated into the project.
        </td>
        <td>
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['health_and_safety'], true) !!}
            @else
                <select name="health_and_safety" class="js-maturity-analysis
                js-maturity-analysis_health_and_safety select2 col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['health_and_safety'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
    <tr>
        @include('page.maturity_analysis.summary')
    </tr>
    </tr>
    </tbody>
</table>
