<form method="post" action="/fel2/"
      enctype="multipart/form-data"
      data-name="{{$project->project_name}}"
      class="theme-form js-fel2-form">
        @csrf
        @include('page.fel2.form',[
            'subDepartment' => $subDepartment,
            'department' => $department,
            'user_department' => $userDepartment,
            'errors' => $errors
        ])
    <div class="card-footer">
        <button class="btn btn-secondary js-create-fel2">
           <span class="text-button loader-box loader-box-custom"  style="height: 21px">
                Save As Draft <span class="m-l-5 loader-34 loader-34-custom d-none"></span>
            </span>
        </button>
        <button class="btn btn-primary js-create-fel2" data-status="publish">
           <span class="text-button loader-box loader-box-custom"  style="height: 21px">
                Publish <span class="m-l-5 loader-34 loader-34-custom d-none"></span>
            </span>
        </button>
        <p class="error-msg-checkbox"></p>
    </div>
</form>
