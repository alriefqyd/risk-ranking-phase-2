<form method="post" action="/cost_benefit/"
      enctype="multipart/form-data"
      class="theme-form js-cb-form">
        @csrf
        @include('page.cost_benefit.form',[
            'subDepartment' => $subDepartment,
            'department' => $department,
            'user_department' => $userDepartment,
            'errors' => $errors
        ])
    <input type="hidden" name="project_id" value="{{$project->id}}">
    <div class="card-footer">
        <button class="btn btn-primary js-create-cb" data-status="publish">
            Continue
        </button>
    </div>
</form>
