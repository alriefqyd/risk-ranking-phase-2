<form method="post" action="/fel1/{{$project->id}}/"
      enctype="multipart/form-data"
      data-name="{{$project->project_name}}"
      data-method="put"
      class="theme-form js-fel1-form">
        @csrf
        @include('page.fel1.form',[
            'subDepartment' => $subDepartment,
            'department' => $department,
            'user_department' => $userDepartment,
            'errors' => $errors
        ])
    <div class="card-footer">
        <button class="btn btn-secondary js-create-fel1">
           <span class="text-button loader-box loader-box-custom"  style="height: 21px">
                Save As Draft <span class="m-l-5 loader-34 loader-34-custom d-none"></span>
            </span>
        </button>
        <button class="btn btn-primary js-save-button js-create-fel1" data-status="publish">
           <span class="text-button loader-box loader-box-custom"  style="height: 21px">
                Publish <span class="m-l-5 loader-34 loader-34-custom d-none"></span>
            </span>
        </button>
        <p class="error-msg-checkbox"></p>
    </div>
</form>
