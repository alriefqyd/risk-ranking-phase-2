<form method="post" action="/business-case/{{$project->id}}/"
      enctype="multipart/form-data"
      data-method="put"
      data-name="{{$project->project_name}}"
      class="theme-form js-bc-form">
        @csrf
        @include('page.business_case.form',[
            'subDepartment' => $subDepartment,
            'department' => $department,
            'user_department' => $userDepartment,
            'errors' => $errors
        ])
    <div class="card-footer">
        <button class="btn btn-secondary js-create-bc float-start ml-5 m-b-30">
           <span class="text-button loader-box loader-box-custom"  style="height: 21px">
                Save As Draft <span class="m-l-5 loader-34 loader-34-custom d-none"></span>
            </span>
        </button>
        <button class="btn btn-primary js-save-button js-create-bc float-start m-l-5 m-b-30" data-status="publish">
           <span class="text-button loader-box loader-box-custom"  style="height: 21px">
                Publish <span class="m-l-5 loader-34 loader-34-custom d-none"></span>
            </span>
        </button>
        <p class="error-msg-checkbox"></p>
    </div>
</form>
