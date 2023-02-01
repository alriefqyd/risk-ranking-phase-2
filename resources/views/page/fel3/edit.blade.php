<form method="post" action="/fel3/{{$project->id}}/"
      data-method="put"
      enctype="multipart/form-data"
      data-name="{{$project->project_name}}"
      class="theme-form js-fel3-form form-wizard js-parent-detail">
        @csrf
      <div class="tab">
        <input type="hidden" class="js-maturity-analysis-type" name="maturity_type" value="{{$project?->assessment?->complexity_analysis_type}}"/>
        @include('page.maturity_analysis.template',[
            'isView' => false
        ])
      </div>
      <div class="tab">
            @include('page.fel3.form',[
            'subDepartment' => $subDepartment,
            'department' => $department,
            'user_department' => $userDepartment,
            'errors' => $errors,
            'isView' => false
        ])
      </div>

    <div class="m-t-15">
        <div class="text-end btn-mb">
            <button class="btn btn-secondary" id="prevBtn" type="button" onclick="nextPrev(-1)">Previous</button>
            <button class="btn btn-primary" id="nextBtn" type="button" onclick="nextPrev(1)">Next</button>
            <button class="btn btn-secondary js-create-fel3">
                           <span class="text-button loader-box loader-box-custom" style="height: 21px">
                                Save As Draft <span class="m-l-5 loader-34 loader-34-custom d-none"></span>
                            </span>
            </button>
            <button class="btn btn-primary js-create-fel3" data-status="publish">
                           <span class="text-button loader-box loader-box-custom" style="height: 21px">
                                Publish <span class="m-l-5 loader-34 loader-34-custom d-none"></span>
                            </span>
            </button>
            <p class="error-msg-checkbox"></p>
        </div>
    </div>

    <!-- Circles which indicates the steps of the form:-->
    <div class="text-center"><span class="step"></span><span class="step"></span></div>
    <!-- Circles which indicates the steps of the form:-->
</form>
