<form method="post" action="/assessment/"
      enctype="multipart/form-data"
      id="form-assessment-data"
      data-name="{{$project->project_name}}"
      class="theme-form js-assessment-create js-assessment-form form-wizard">
        @csrf
        @include('page.assessment.form',[
            'subDepartment' => $subDepartment,
            'department' => $department,
            'user_department' => $userDepartment,
            'errors' => $errors,
            'isEdit' => false
        ])

    <div class="card-footer js-button-submit-assessment {{empty($project->investment_strategy) ? 'd-none' : ''}}">
        <button class="btn btn-secondary  js-create-assessment"  data-status="draft">
           <span class="text-button loader-box loader-box-custom"  style="height: 21px">
                Save As Draft <span class="m-l-5 loader-34 loader-34-custom d-none"></span>
            </span>
        </button>
        <button class="btn btn-primary js-save-button js-create-assessment" disabled="disabled" data-status="publish">
           <span class="text-button loader-box loader-box-custom"  style="height: 21px">
                Publish <span class="m-l-5 loader-34 loader-34-custom d-none"></span>
            </span>
        </button>
        <p class="text-danger js-error-attachment">Please upload all attachment</p>
        <p class="error-msg-checkbox"></p>

    </div>
</form>

