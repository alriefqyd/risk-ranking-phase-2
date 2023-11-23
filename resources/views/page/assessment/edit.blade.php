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
            'errors' => $errors,
            'isEdit' => true
        ])
    <div class="card-footer">
        <button class="btn btn-secondary js-save-button js-btn-submit-assessment-non-confirm js-btn-submit-assessment
         js-create-assessment"
                disabled="disabled"
             data-status="draft">
           <span class="text-button loader-box loader-box-custom"  style="height: 21px">
                Save As Draft <span class="m-l-5 loader-34 loader-34-custom d-none"></span>
            </span>
        </button>
        <button class="btn btn-primary js-save-button js-btn-submit-assessment-non-confirm js-create-assessment"
                disabled="disabled"
                data-status="publish">
           <span class="text-button loader-box loader-box-custom"  style="height: 21px">
                Publish <span class="m-l-5 loader-34 loader-34-custom d-none"></span>
            </span>
        </button>
        <p class="text-danger js-error-attachment"></p>
        <p class="error-msg-checkbox"></p>

    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are You Sure ?</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Since your complexity changes, your maturity will be removed and you have to create a new maturity analysis.</div>
                <div class="modal-footer">
                    <button class="btn btn-primary js-btn-submit-assessment" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-secondary js-btn-submit-assessment-confirm js-confirm-assessment">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>
