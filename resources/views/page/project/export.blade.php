<table class="tg">
    <thead>
    <tr>
        <th class="tg-c3ow" colspan="2" rowspan="2">Project Name</th>
        <th class="tg-c3ow" rowspan="2">Cost Benefit</th>
        <th class="tg-c3ow" colspan="31">Year</th>
        <th class="tg-c3ow" rowspan="2">Total</th>
    </tr>
    <tr>
        @for($i=2020;$i<2051;$i++)
            <th class="tg-c3ow">{{$i}}</th>
        @endfor
    </tr>
    </thead>
    <tbody>
    @foreach($project as $p)
        <tr>
            <td class="tg-c3ow" colspan="2" rowspan="5">{{$p->project_name}}</td>
            <td class="tg-bn54">Initial and Sustaining CapEx</td>
            @if($p->getCostBenefit(true))
                @foreach($p->getCostBenefit(true) as $cost)
                    <td class="tg-c3ow">{{$cost['initial_and_sustaining_capex']}}</td>
                @endforeach
            @endif
        </tr>
        <tr>
            <td class="tg-bn54">Additional Revenue (positive)</td>
            @if($p->getCostBenefit(true))
                @foreach($p->getCostBenefit(true) as $cost)
                    <td class="tg-c3ow">{{$cost['additional_revenue']}}</td>
                @endforeach
            @endif
        </tr>
        <tr>
            <td class="tg-gd2f">Incremental Operating costs (negative)</td>
            @if($p->getCostBenefit(true))
                @foreach($p->getCostBenefit(true) as $cost)
                    <td class="tg-c3ow">{{$cost['increment_operating_cost']}}</td>
                @endforeach
            @endif
        </tr>
        <tr>
            <td class="tg-gd2f">Cost savings (positive if relevant)</td>
            @if($p->getCostBenefit(true))
                @foreach($p->getCostBenefit(true) as $cost)
                    <td class="tg-c3ow">{{$cost['cost_savings']}}</td>
                @endforeach
            @endif
        </tr>
        <tr>
            <td class="tg-bn54">Net Incremental Benefits</td>
            @if($p->getCostBenefit(true))
                @foreach($p->getCostBenefit(true) as $cost)
                    <td class="tg-c3ow">{{$cost['net_incremental_benefits'] == 'NaN' ? '' : $cost['net_incremental_benefits']}}</td>
                @endforeach
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
