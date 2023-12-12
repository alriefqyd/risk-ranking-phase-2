<form method="post" action="/fel3/{{$project->id}}/"
      data-method="put"
      enctype="multipart/form-data"
      data-name="{{$project->project_name}}"
      class="theme-form js-fel3-form form-wizard js-parent-detail">
        @csrf
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
</form>
