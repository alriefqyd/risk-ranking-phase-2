@inject('setting',App\Models\Setting::class)
@switch($project?->assessment?->complexity_analysis_type)
    @case($setting::SIMPLE_PURCHASE)
        @include('page.maturity_analysis.simple_purchase', [
            'isView' => $isView
        ])
    @break
    @case($setting::LOW)
        @include('page.maturity_analysis.low_complexity', [
            'isView' => $isView
        ])
    @break
    @case($setting::MODERATE)
        @include('page.maturity_analysis.moderate_complexity', [
            'isView' => $isView
        ])
    @break
    @case($setting::HIGH)
        @include('page.maturity_analysis.high_complexity', [
            'isView' => $isView
        ])
    @break
@endswitch
