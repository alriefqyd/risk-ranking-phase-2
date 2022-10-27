<form method="post" action="/cost_benefit/"
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
           <span class="text-button loader-box loader-box-custom"  style="height: 21px">
                Save <span class="m-l-5 loader-34 loader-34-custom d-none"></span>
            </span>
        </button>
    </div>
</form>
