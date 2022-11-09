<form method="post" action="/assessment/{{$project->id}}/"
      enctype="multipart/form-data"
      data-name="{{$project->project_name}}"
      data-method="put"
      class="theme-form js-assessment-create js-assessment-form">
        @csrf
        @include('page.assessment.form',[
            'subDepartment' => $subDepartment,
            'department' => $department,
            'user_department' => $userDepartment,
            'errors' => $errors
        ])
    <div class="card-footer">
        <button class="btn btn-secondary js-create-assessment">
           <span class="text-button loader-box loader-box-custom"  style="height: 21px">
                Save As Draft <span class="m-l-5 loader-34 loader-34-custom d-none"></span>
            </span>
        </button>
        <button class="btn btn-primary js-create-assessment" data-status="publish">
           <span class="text-button loader-box loader-box-custom"  style="height: 21px">
                Publish <span class="m-l-5 loader-34 loader-34-custom d-none"></span>
            </span>
        </button>
    </div>
</form>
