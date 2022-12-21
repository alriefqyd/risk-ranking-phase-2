<div class="row">
    <div class="col-md-4 m-l-10 m-t-15 m-b-10">
        <h6 class="font-roboto js-title-detail {{!$errors->any() ? '' : 'd-none'}} title">Business Case Detail</h6>
        <h6 class="font-roboto js-title-form {{!$errors->any() ? 'd-none' : ''}} title">Business Case Form</h6>
    </div>
    @if(!$isNotCurrentData)
        @can('update')
            <div class="col-md-7 m-l-50 m-b-10">
                <button class="btn btn-sm btn-success m-t-10 float-end {{!$errors->any() ? '' : 'd-none'}}
                    js-btn-edit_project">
                    {{$project?->business_case ? 'Update' : 'Create'}} <i style="width: 20px; height: 15px;" data-feather="edit"></i>
                </button>

                <button class="btn btn-sm btn-success m-t-10 float-end {{!$errors->any() ? 'd-none' : ''}}
                    js-btn-view_project">
                    View Business Case <i style="width: 20px; height: 15px;" data-feather="eye"></i>
                </button>
            </div>
        @endcan
        @endif
</div>
@if(!$isNotCurrentData)
    @if($project?->business_case)
        @can('update')
            <div class="row js-form-project-edit {{!$errors->any() ? 'd-none' : ''}} m-t-0">
                @include('page.business_case.edit')
            </div>
        @endcan
    @else
        @can('create')
            <div class="row js-form-project-edit {{!$errors->any() ? 'd-none' : ''}} m-t-0">
                @include('page.business_case.create')
            </div>
        @endcan
    @endif
@endif
@include('page.business_case.detail')
