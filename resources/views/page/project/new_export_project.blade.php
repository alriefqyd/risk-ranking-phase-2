<table class="tg">
    <thead>
    <tr>
        <th>Project Number</th>
        <th>Project Name</th>
        <th>Directorate</th>
        <th>Department</th>
        <th>Sponsor</th>
        <th>Owner</th>
        <th>Project Sponsor</th>
        <th>BC Presenter</th>
        <th>BC Originator</th>
        <th>Finance Analyst</th>
        <th>Project Type</th>
        <th>Project Sub Type</th>
        <th>Status</th>
        <th>Note From Reviewer</th>
        <th>Problem Statement</th>
        <th>Objective</th>
        <th>Scope of Work</th>
        <th>NPV</th>
        <th>IRR</th>
        <th>Payback Period</th>
        <th>TCO</th>
        <th>Cost Estimate</th>
        <th>Risk Level Residual</th>
        <th>Risk Level Forecast</th>
        <th>Risk Deduction</th>
        <th>KPI Summary</th>
    </tr>
    </thead>
    <tbody>
    @foreach($project ?? [] as $p)
        <tr>
            <td>{{ $p->project_number ?? 'N/A' }}</td>
            <td>{{ $p->project_name ?? 'N/A' }}</td>
            <td>{{ $p->directoratesProject?->name ?? 'N/A' }}</td>
            <td>{{ $p->ownersproject?->name ?? 'N/A' }}</td>
            <td>{{ $p->sponsorsProject?->name ?? 'N/A' }}</td>
            <td>{{ $p->owner ?? 'N/A' }}</td>
            <td>{{ $p->sponsor ?? 'N/A' }}</td>
            <td>{{ $p->bc_presenter ?? 'N/A' }}</td>
            <td>{{ $p->bc_originator ?? 'N/A' }}</td>
            <td>{{ $p->finance_analyst ?? 'N/A' }}</td>
            <td>{{ $p->baskets?->name ?? 'N/A' }}</td>
            <td>{{ $p->subBaskets?->name ?? 'N/A' }}</td>
            <td style="background-color: {{$p->getStatus() == "DRAFT" ? "#e2c636" : "#198754"}} ">{{ $p->getStatus() }}</td>
            <td>{!! $p->note !!}</td>
            <td>{{ strip_tags($p->business_case?->problem_statement_and_objective_text ?? 'N/A') }}</td>
            <td>{{ strip_tags($p->business_case?->objective ?? 'N/A') }}</td>
            <td>{{ strip_tags($p->business_case?->project_scope_of_work_text ?? 'N/A') }}</td>
            <td>{{ $p->business_case?->npv ?? 0 }}</td>
            <td>{{ number_format((int) $p->business_case?->irr ?? 0, 2) }}</td>
            <td>{{ number_format((int) $p->business_case?->payback_period ?? 0, 2) }}</td>
            <td>{{ $p->business_case?->tco ?? 0  }} USD</td>
            <td>{{ str_replace('.','',$p->business_case?->cost_estimate) ?? 'N/A' }}</td>
            <td>{{ $p->business_case?->riskAssessment?->risk_level_residual ?? 'N/A' }}</td>
            <td>{{ $p->business_case?->riskAssessment?->risk_level_forecast ?? 'N/A' }}</td>
            <td>{{ $p->business_case?->riskAssessment?->risk_level_deduction ?? 'N/A' }}</td>
            <td>
            @php($kpiData = json_decode($p->business_case->kpi_summary, true))
                <ol>
                @foreach($kpiData as $kpi)
                    <li>{{ $kpi['description'] }} - {{ $kpi['time_to_benefit'] }}</li>
                @endforeach
                </ol>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
