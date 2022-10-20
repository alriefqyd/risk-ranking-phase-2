<form method="post" action="/assessment/{{$project->id}}/"
      class="theme-form js-project-edit js-project-form">
        @csrf
        @include('page.assessment.form',[
            'subDepartment' => $subDepartment,
            'department' => $department,
            'user_department' => $userDepartment,
            'errors' => $errors
        ])
    <div class="card-footer">
        <button class="btn btn-primary">Submit</button>
        <button class="btn btn-secondary">Cancel</button>
    </div>
</form>
