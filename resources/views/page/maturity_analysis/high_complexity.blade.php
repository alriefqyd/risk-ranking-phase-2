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
        <td class="table-vertical-center" rowspan="3">Construction</td>
        <td style="width: 20%">
            Constructive Methodology
        </td>
        <td style="width: 60%">
            <li>Logistic plan of the construction.</li>
            <li>Plan of execution of the accesses.</li>
            <li>Execution plan for earthworks, drainage and paving.</li>
            <li>Plan of execution of the foundations.</li>
            <li>Plan for the execution of civil works.</li>
            <li>Execution plan for administrative buildings and industrial support.</li>
            <li>Execution plan of the electromechanical assembly.</li>
            <li>Constructive sequence.</li>
            <li>Construction management plan.</li>
        </td>
        <td style="width: 15%">
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['constructive_methodology'], true) !!}
            @else
                <select name="constructive_methodology"
                        class="js-maturity-analysis js-maturity-analysis_constructive_methodology select2 col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['constructive_methodology'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td style="width: 20%;">
            Construction sites and temporary installations
        </td>
        <td style="width: 60%">
            Plan for the execution of construction sites and temporary installations.
        </td>
        <td>
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['construction_sites'], true) !!}
            @else
                <select name="construction_sites" class="select2
                js-maturity-analysis js-maturity-analysis_construction_sites
                col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['construction_sites'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td style="width: 20%">
            Interference and tie-ins
        </td>
        <td style="width: 60%">
            Plan for the removal of interferences and the execution of tie-ins.
        </td>
        <td style="width: 15%">
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['interference_and_tie_ins'], true) !!}
            @else
                <select name="interference_and_tie_ins" class="select2
                js-maturity-analysis js-maturity-analysis_interference_and_tie_ins col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['interference_and_tie_ins'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td class="table-vertical-center" rowspan="2">Capex</td>
        <td style="width: 20%;">
            Investment Estimate (CapEx)
        </td>
        <td style="width: 60%">
            Reporting of criteria and assumptions used in the elaboration of FEL 3 CapEx,
            including worksheet with Estimation of investment for Execution based on quotations,
            CPUs (unit price compositions) and database, containing all calculation memories (indirect, contingency, escalation, BDI, etc.).
        </td>
        <td>
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['investment_estimate'], true) !!}
            @else
                <select name="investment_estimate" class="select2
                js-maturity-analysis js-maturity-analysis_investment_estimate
                col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['investment_estimate'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td style="width: 20%;">
            Capex Management
        </td>
        <td style="width: 60%">
            Disbursement schedule aligned with the project's physical schedule.
        </td>
        <td style="width: 15%">
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['capex_management'], true) !!}
            @else
                <select name="capex_management" class="select2
                js-maturity-analysis js-maturity-analysis_capex_management
                col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['capex_management'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td class="table-vertical-center" rowspan="3">Engineer</td>
        <td style="width: 20%;">
            Engineering Development
        </td>
        <td style="width: 60%">
            <li>List of basic engineering project documents.</li>
            <li>Basic architecture design.</li>
            <li>Basic design of industrial automation.</li>
            <li>Basic dam design.</li>
            <li>Basic civil / concrete design.</li>
            <li>Basic civil / infrastructure design.</li>
            <li>Basic electrical design.</li>
            <li>Basic design of metal structures.</li>
            <li>Basic geotechnical design.</li>
            <li>Basic mechanical design.</li>
            <li>Basic mine design.</li>
            <li>Basic design of batteries.</li>
            <li>Basic process design.</li>
            <li>Basic design of utility systems.</li>
            <li>Basic telecommunication design.</li>
            <li>Basic piping design.</li>
            <li>List of documents foreseen for detailed engineering design.</li>
        </td>
        <td>
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['engineering_development'], true) !!}
            @else
                <select name="engineering_development" class="select2
                js-maturity-analysis js-maturity-analysis_engineering_development
                col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['engineering_development'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td style="width: 20%;">
            Survey of local conditions and characteristics
        </td>
        <td style="width: 60%">
            Reports of local conditions and characteristics for the basic design phase.
        </td>
        <td style="width: 15%">
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['survey_local_conditions'], true) !!}
            @else
                <select name="survey_local_conditions" class="select2
                js-maturity-analysis js-maturity-analysis_survey_local_conditions
                col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['survey_local_conditions'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td style="width: 20%;">
            Logistics studies
        </td>
        <td style="width: 60%">
            Technical logistic report, containing at least:
            <li> Identification of rotograms for special loads </li>
            <li> Elaboration of strategies to remove bottlenecks from accesses for large equipment </li>
            <li> Identification of potential suppliers of inputs for the works. </li>
        </td>
        <td style="width: 15%">
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['logistic_studies'], true) !!}
            @else
                <select name="logistic_studies" class="select2
                js-maturity-analysis js-maturity-analysis_logistic_studies
                col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['logistic_studies'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td>Changes Management</td>
        <td style="width: 20%;">
            Change Management
        </td>
        <td style="width: 60%">
            Project change management plan for implementation in the Execution phase, aligned with the FEL 2 and Execution team.
        </td>
        <td style="width: 15%">
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['change_management_plan'], true) !!}
            @else
                <select name="change_management_plan" class="select2
                js-maturity-analysis js-maturity-analysis_change_management_plan
                col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['change_management_plan'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td rowspan="2" class="table-vertical-center">Scoping</td>
        <td style="width: 20%;">
            Scope Statement
        </td>
        <td style="width: 60%">
            Detailed project scope statement.
        </td>
        <td style="width: 15%">
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['scope_statement'], true) !!}
            @else
                <select name="scope_statement" class="select2
                js-maturity-analysis js-maturity-analysis_scope_statement
                col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['scope_statement'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td style="width: 20%;">
            Executive Report
        </td>
        <td style="width: 60%">
            Includes all project documentation - technical, contractual, tax and legal.
        </td>
        <td style="width: 15%">
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['executive_report'], true) !!}
            @else
                <select name="executive_report" class="select2
                js-maturity-analysis js-maturity-analysis_executive_report
                col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['executive_report'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td>License</td>
        <td style="width: 20%;">
            Environmental Licensing and Stakeholders
        </td>
        <td style="width: 60%">
            List of licenses, grants and authorizations required for the project for the Execution and Operation phases, with deadlines (protocol and procurement) in the integrated project schedule (eg IPHAN, FCP, FUNAI, IBAMA, ICMBIO).
        </td>
        <td style="width: 15%">
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['environmental_licensing'], true) !!}
            @else
                <select name="environmental_licensing" class="select2
                js-maturity-analysis js-maturity-analysis_environmental_licensing
                col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['environmental_licensing'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td class="table-vertical-center" rowspan="3">Planning and control</td>
        <td style="width: 20%;">
            Work Breakdown Structure (WBS)
        </td>
        <td style="width: 60%">
            WBS defined at least on the third physical level for the Development and Execution phases.
        </td>
        <td style="width: 15%">
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['work_breakdown_structure'], true) !!}
            @else
                <select name="work_breakdown_structure" class="select2
                js-maturity-analysis js-maturity-analysis_work_breakdown_structure
                col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['work_breakdown_structure'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td style="width: 20%;">
            Integrated Project Schedule
        </td>
        <td style="width: 60%">
            Integrated project schedule, containing:
            <li> Activities carried out in FEL 3. </li>
            <li> Detailed activities to be carried out in the Execution </li>
            <li> Definitive histogram for direct labor (according to resources loaded in the schedule), and indirect (through spreadsheets), considering the entire scope of the project.</li>
            <li> Definitive histogram of the main quantitative services for the Execution phase (civil works, earthworks, electromechanical assembly, etc.). </li>
        </td>
        <td style="width: 15%">
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['integrated_project_schedule'], true) !!}
            @else
                <select name="integrated_project_schedule" class="select2
                js-maturity-analysis js-maturity-analysis_integrated_project_schedule
                col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['integrated_project_schedule'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td style="width: 20%;">
            Detailed FTE Schedule
        </td>
        <td style="width: 60%">
            Monthly detailing of the FTES required by the project
        </td>
        <td style="width: 15%">
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['detailed_fte_schedule'], true) !!}
            @else
                <select name="detailed_fte_schedule" class="select2
                js-maturity-analysis js-maturity-analysis_detailed_fte_schedule
                col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['detailed_fte_schedule'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td>Operational readiness</td>
        <td style="width: 20%;">
            Operational readiness
        </td>
        <td style="width: 60%">
            Definitive plan of operational readiness, containing at least:
            <li> Operation plan. </li>
            <li> Maintenance implementation plan.</li>
            <li> Commissioning plan.</li>
            <li> Plan of handover.</li>
            <li> Ramp-up curve (where applicable)</li>
            <li> Operating Costs (where applicable)</li>
        </td>
        <td style="width: 15%">
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['operational_readiness'], true) !!}
            @else
                <select name="operational_readiness" class="select2
                js-maturity-analysis js-maturity-analysis_operational_readiness
                col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['operational_readiness'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td>Quality</td>
        <td style="width: 20%;">
            Quality Plan
        </td>
        <td style="width: 60%">
            Quality Plan
        </td>
        <td style="width: 15%">
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['quality_plan'], true) !!}
            @else
                <select name="quality_plan" class="select2
                js-maturity-analysis js-maturity-analysis_quality_plan
                col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['quality_plan'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td>Risk</td>
        <td style="width: 20%;">
            Risk Plans
        </td>
        <td style="width: 60%">
            Project risk analysis report.
            Report of the analysis of safety and operability (HazOp).
        </td>
        <td style="width: 15%">
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['risk_analysis_report'], true) !!}
            @else
                <select name="risk_analysis_report" class="select2
                js-maturity-analysis js-maturity-analysis_risk_analysis_report
                col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['risk_analysis_report'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td>Sustainability</td>
        <td style="width: 20%;">
            APR
        </td>
        <td style="width: 60%">
            Preliminary analysis of HSE, Human Rights and S & S risks in the Communities for the activities foreseen in the Execution stage.
        </td>
        <td style="width: 15%">
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['apr'], true) !!}
            @else
                <select name="apr" class="select2
                js-maturity-analysis js-maturity-analysis_apr
                col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['apr'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td class="table-vertical-center" rowspan="2">HSE</td>
        <td style="width: 20%;">
            Integrated Management System (EHS)
        </td>
        <td style="width: 60%">
            Critical Health and Safety Analysis of the project engineering.
        </td>
        <td style="width: 15%">
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['integrated_management_system'], true) !!}
            @else
                <select name="integrated_management_system" class="select2
                js-maturity-analysis js-maturity-analysis_integrated_management_system
                col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['integrated_management_system'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td style="width: 20%;">
            PAE
        </td>
        <td style="width: 60%">
            PAE - HSE emergency plan for the Execution stage.
        </td>
        <td style="width: 15%">
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['pae'], true) !!}
            @else
                <select name="pae" class="select2
                js-maturity-analysis js-maturity-analysis_pae
                col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['pae'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td class="table-vertical-center" rowspan="2">Supply</td>
        <td style="width: 20%;">
            Supply Plan (PS)
        </td>
        <td style="width: 60%">
            Consolidated Supply Plan (PS).
        </td>
        <td style="width: 15%">
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['supply_plan'], true) !!}
            @else
                <select name="supply_plan" class="select2
                js-maturity-analysis js-maturity-analysis_supply_plan
                col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['supply_plan'], false) == $key ? 'selected=selected' : '' !!}
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endif
        </td>
    </tr>
    <tr>
        <td style="width: 20%;">
            Procurement Tracking Map (MAS)
        </td>
        <td style="width: 60%">
            Procurement Tracking Map (MAS) for all contracted mapping packages as provided in the Supply Plan.
        </td>
        <td style="width: 15%">
            @if($isView)
                {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['procurement_tracking_map'], true) !!}
            @else
                <select name="procurement_tracking_map" class="select2
                js-maturity-analysis js-maturity-analysis_procurement_tracking_map
                col-md-12">
                    @foreach($maturityOption as $key => $value)
                        <option {!! $project->getMaturityAnalysis($setting::MATURITY_ANALYSIS_ITEM['procurement_tracking_map'], false) == $key ? 'selected=selected' : '' !!}
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
