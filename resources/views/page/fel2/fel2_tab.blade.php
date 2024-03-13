<div class="row js-row-header-tab">
    <div class="col-md-4 m-l-10 m-t-15 m-b-10">
        <h6 class="font-roboto js-title-detail {{!$errors->any() ? '' : 'd-none'}} title">FEL 2 Detail</h6>
        <h6 class="font-roboto js-title-form {{!$errors->any() ? 'd-none' : ''}} title">FEL 2 Form</h6>
    </div>
    @if(!$isNotCurrentData)
        @can('update')
            <div class="col-md-7 m-l-50 m-b-10">
                @if(!$project?->assessment?->level_project_text)
                    <button class="btn btn-sm btn-success m-t-10 float-end {{!$errors->any() ? '' : 'd-none'}}"
                    data-bs-target="#errorCreateFel2"
                    data-bs-toggle="modal">
                        {{$project?->fel2 ? 'Update' : 'Create'}} <i style="width: 20px; height: 15px;" data-feather="edit"></i>
                    </button>
                @else
                    <button class="btn btn-sm btn-success m-t-10 float-end {{!$errors->any() ? '' : 'd-none'}}
                    js-btn-edit_project">
                        {{$project?->fel2 ? 'Update' : 'Create'}} <i style="width: 20px; height: 15px;" data-feather="edit"></i>
                    </button>
                @endif
                <button class="btn btn-sm btn-success m-t-10 float-end {{!$errors->any() ? 'd-none' : ''}}
                    js-btn-view_project">
                    View Fel 2 <i style="width: 20px; height: 15px;" data-feather="eye"></i>
                </button>
            </div>
        @endcan
    @endif
</div>

@if(!isset($project?->assessment?->level_project_text))
    <div class="modal fade" id="errorCreateFel2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title error" id="exampleModalLabel">Error</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">You cannot create FEL 2, Please complete assessment form first!</div>
                <div class="modal-footer">
                    <button class="btn btn-danger js-btn-submit-assessment" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endif

@if(!$isNotCurrentData)
    @if($project?->fel2)
        @can('update')
            <div class="row js-form-project-edit is-edit {{!$errors->any() ? 'd-none' : ''}} m-t-0">
                @include('page.fel2.edit')
            </div>
        @endcan
    @else
        @can('create')
            <div class="row js-form-project-edit {{!$errors->any() ? 'd-none' : ''}} m-t-0">
                @include('page.fel2.create')
            </div>
        @endcan
    @endif
@endif
@include('page.fel2.fel2_detail')
