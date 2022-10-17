{{-- modal for update note --}}
<div class="modal fade detail_note_project" id="detail_note_project" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Note</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="loader-box">
                <div class="loader-3"></div>
            </div>
            @can('update')
                <div class="modal-body d-none">
                    <input type="hidden" class="js-project_id" name="project_id" value=""/>
                    <textarea class="form-control js-project_note" id="editor1" name="note" cols="30"
                              rows="10">
                </textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-secondary js-save-note"
                            type="button">
                        Save changes
                        <div class="loader-3"></div>
                    </button>
                </div>
            @else
                <div class="modal-body d-none js-note-viewer">
                    <span class="js-project_note"></span>
                </div>
            @endcan

        </div>
    </div>
</div>

{{-- modal for delete project --}}
<div class="modal fade" id="projectDelete" tabindex="-1" role="dialog" aria-labelledby="projectDelete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Project</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" value="" class="js-id-delete"/>
                Are you sure you want to delete this project ?
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-danger js-delete-project" type="button">Delete</button>
            </div>
        </div>
    </div>
</div>
