<div class="row">
    <div class="col-md-4 m-l-10 m-t-15 m-b-10">
        <h6 class="font-roboto js-title-detail {{!$errors->any() ? '' : 'd-none'}} title">FEL 1 Detail</h6>
        <h6 class="font-roboto js-title-form {{!$errors->any() ? 'd-none' : ''}} title">FEL 1 Form</h6>
    </div>
    @can('update')
        <div class="col-md-7 m-l-50 m-b-10">
            <button class="btn btn-sm btn-success m-t-10 float-end {{!$errors->any() ? '' : 'd-none'}}
                js-btn-edit_project">
                {{$project?->fel1 ? 'Update' : 'Create'}} <i style="width: 20px; height: 15px;" data-feather="edit"></i>
            </button>

            <button class="btn btn-sm btn-success m-t-10 float-end {{!$errors->any() ? 'd-none' : ''}}
                js-btn-view_project">
                View Fel 1 <i style="width: 20px; height: 15px;" data-feather="eye"></i>
            </button>
        </div>
    @endcan
</div>
@if($project?->fel1)
    @can('update')
        <div class="row js-form-project-edit {{!$errors->any() ? 'd-none' : ''}} m-t-0">
            @include('page.fel1.edit')
        </div>
    @endcan
@else
    @can('create')
        <div class="row js-form-project-edit {{!$errors->any() ? 'd-none' : ''}} m-t-0">
            @include('page.fel1.create')
        </div>
    @endcan
@endif
@include('page.fel1.fel1_detail')
