<div class="row js-row-header-tab">
    <div class="col-md-4 m-l-10 m-t-15 m-b-10">
        <h6 class="font-roboto js-title-detail {{!$errors->any() ? '' : 'd-none'}} title">Business Case Detail</h6>
        <h6 class="font-roboto js-title-form {{!$errors->any() ? 'd-none' : ''}} title">Business Case Form</h6>
    </div>
    @if(!$isNotCurrentData)
        @can('update')
            <div class="col-md-7 m-l-50 m-b-10">
                @if(!$project->newValidateAssessmentBasedOnComplexityScore(false))
                    <button class="btn btn-sm btn-success m-t-10 float-end {{!$errors->any() ? '' : 'd-none'}}"
                            data-bs-target="#errorCreateBusinessCase"
                            data-bs-toggle="modal"
                    >
                        {{$project?->business_case ? 'Update' : 'Create'}} <i style="width: 20px; height: 15px;" data-feather="edit"></i>
                    </button>
                @else
                    <button class="btn btn-sm btn-success m-t-10 float-end {{!$errors->any() ? '' : 'd-none'}}
                        js-btn-edit_project">
                        {{$project?->business_case ? 'Update' : 'Create'}} <i style="width: 20px; height: 15px;" data-feather="edit"></i>
                    </button>
                @endif
                <button class="btn btn-sm btn-success m-t-10 float-end {{!$errors->any() ? 'd-none' : ''}}
                    js-btn-view_project">
                    View Business Case <i style="width: 20px; height: 15px;" data-feather="eye"></i>
                </button>
            </div>
        @endcan
    @endif
</div>

@if(isset($project->assessment) && !$project->newValidateAssessmentBasedOnComplexityScore(false))
    @php($score = $project->assessment?->complexity_score_assessment)
    <div class="modal fade" id="errorCreateBusinessCase" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title error" id="exampleModalLabel">Error</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Project Level Assessmnet : {{$project->assessment?->level_project_text}} . Mandatory Action Required: Submit Form {{ $project->newValidateAssessmentBasedOnComplexityScore(true) }}</div>
                <div class="modal-footer">
                    <button class="btn btn-danger js-btn-submit-assessment" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endif

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
