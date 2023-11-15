<div class="row">
    @if(!$isNotCurrentData)
        @can('update')
            <div class="col-md-7 m-l-50 m-b-10">
                <button class="btn btn-sm btn-success m-t-10 float-end {{!$errors->any() ? '' : 'd-none'}}
                    js-btn-edit_project">
                    {{$project->assessment ? 'Update' : 'Create'}} <i style="width: 20px; height: 15px;" data-feather="edit"></i>
                </button>

                <button class="btn btn-sm btn-success m-t-10 float-end {{!$errors->any() ? 'd-none' : ''}}
                    js-btn-view_project">
                    View <i style="width: 20px; height: 15px;" data-feather="eye"></i>
                </button>
            </div>
        @endcan
    @endif
</div>

@if(!$isNotCurrentData)
    @if($project->assessment)
        @can('update')
            <div class="row js-form-project-edit {{!$errors->any() ? 'd-none' : ''}} m-t-0">
                @include('page.assessment.edit')
            </div>
        @endcan
    @else
        @can('create')
            <div class="row js-form-project-edit {{!$errors->any() ? 'd-none' : ''}} m-t-0">
                @include('page.assessment.create')
            </div>
        @endcan
        @include('page.assessment.assessment_detail')
    @endif
@endif

