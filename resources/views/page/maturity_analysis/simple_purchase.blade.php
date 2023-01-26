@inject('setting',App\Models\Setting::class)
<div class="col-md-12">
    <h6 class="font-roboto float-start">Maturity Analysis</h6>
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
                <select name="{{$setting::MATURITY_ANALYSIS_ITEM['investment_estimate']}}"
                        data-idx="0"
                        class="js-maturity-analysis select2 js-maturity-analysis_investment_estimate col-md-12">
                    <option value="not_available">N/A</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
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
                <select name="scope"
                        data-idx="1"
                        class="js-maturity-analysis select2
                        js-maturity-analysis_scope col-md-12">
                    <option value="not_available">N/A</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
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
                <select name="integrated_project_timeline"
                        data-idx="2"
                        class="js-maturity-analysis
                        js-maturity-analysis_integrated_project_timeline
                         select2 col-md-12">
                    <option value="not_available">N/A</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
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
                <select name="supply_plan"
                        data-idx="3"
                        class="js-maturity-analysis
                        js-maturity-analysis_supply_plan select2 col-md-12">
                    <option value="not_available">N/A</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <h6 class="float-end m-r-5
                badge badge-primary
                js-maturity-status"
                    data-not-ready="{{$setting::MATURITY_ANALYSIS_SUMMARY['Not Ready']}}"
                    data-ready="{{$setting::MATURITY_ANALYSIS_SUMMARY['Ready']}}"></h6>
            </td>
        </tr>
    </tbody>
</table>
