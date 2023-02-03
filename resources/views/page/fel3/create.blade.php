<form method="post" action="/fel3/"
      enctype="multipart/form-data"
      data-name="{{$project->project_name}}"
      class="theme-form js-fel3-form form-wizard js-parent-detail">
    @csrf
    @if($project?->assessment?->complexity_analysis_type)
        <div class="tab">
            <input type="hidden" class="js-maturity-analysis-type" name="maturity_type" value="{{$project?->assessment?->complexity_analysis_type}}"/>
            @include('page.maturity_analysis.template',
                ['isView' => false]
            )
        </div>
    @endif
    <div class="tab">
        @include('page.fel3.form',[
            'subDepartment' => $subDepartment,
            'department' => $department,
            'user_department' => $userDepartment,
            'errors' => $errors,
            'isView' => false
        ])
    </div>
    @include('page.fel3.fel3_submit_btn')

    <!-- Circles which indicates the steps of the form:-->
    @if($project?->assessment?->complexity_analysis_type)
        <div class="text-center"><span class="step"></span><span class="step"></span></div>
    @endif
    <!-- Circles which indicates the steps of the form:-->
</form>
