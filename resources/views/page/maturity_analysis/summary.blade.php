@inject('setting',App\Models\Setting::class)
<td colspan="4">
    <h6 class="float-end m-r-5
                badge
                {!! $project?->fel3?->maturityAnalysis?->summary == 'Not Ready' ? 'badge-danger' : 'badge-primary'  !!}
                js-maturity-status"
        data-not-ready="{{$setting::MATURITY_ANALYSIS_SUMMARY['Not Ready']}}"
        data-ready="{{$setting::MATURITY_ANALYSIS_SUMMARY['Ready']}}">{{$dataMaturity?->summary}}</h6>
</td>
