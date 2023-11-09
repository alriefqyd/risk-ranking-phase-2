<div class="mb-3">
    <label class="col-sm-3 col-form-label" for="ProjectName">Project Title <span class="text-danger f-w-550">*</span></label>
    <div class="col-sm-12">
        <textarea class="form-control area1
            @error('project_name')
                is-invalid
            @enderror"
          id="simpleEditor"
          name="project_name"
          placeholder="Project Title">{{ old('project_name') ?:
            (isset($project->project_name) ?
            $project->project_name : '') }}</textarea>
    </div>
    @error('project_name')
        <p class="txt-danger">{{$message}}</p>
    @enderror
</div>
<div class="row g-3">
    <div class="col-sm-6 mb-3">
        <label class="col-sm-12 col-form-label" for="ProjectName">Operation Area <span class="text-danger f-w-550">*</span></label>
        <div class="col-sm-12
            @error('operation_area')
                b-danger
            @enderror">
            <select name="operation_area"
                    style="width: 100% !important;"
                    data-placeholder="Select Operation Area"
                    class="js-example-basic-single col-sm-12
                    js-select-project-category
                    select2">
                <option></option>
                @foreach($projectCategory as $key=>$value)
                    <option {{old('operation_area') == $key ||
                            (isset($project->operation_area)
                            && $project->operation_area == $key) ?
                             'selected="selected"' : ''}}
                            value="{{$key}}">{{$value}}
                    </option>
                @endforeach
            </select>
        </div>
        @error('operation_area')
            <p class="txt-danger">{{$message}}</p>
        @enderror
    </div>
    <div class="mb-3 col-sm-6">
        <label class="col-sm-12 col-form-label" for="ProjectName">Sponsor Area <span class="text-danger f-w-550">*</span></label>
        <div class="col-sm-12
            @error('sponsor_area')
                b-danger
            @enderror">
            <select id="" name="sponsor_area" data-url="/getProjectType" data-id="{{$user_department}}"
                    class="select2
             js-example-basic-single form-control js-project-type">
                <option value="" disabled selected>Select your option</option>
                @foreach($projectType as $value)
                    <option value="{{$value->setting_value}}"
                        {{old('sponsor_area') == $value->setting_value ||
                        (isset($project->sponsor_area) && $project->sponsor_area == $value->setting_value)
                        ? 'selected="selected"' : ''}}>{{$value->setting_value}}
                    </option>
                @endforeach
            </select>
        </div>
        @error('sponsor_area')
            <p class="txt-danger">{{$message}}</p>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-sm-6 mb-3">
        <label class="col-sm-12 col-form-label" for="owner">Owner <span class="text-danger f-w-550">*</span></label>
        <div class="col-sm-12
            @error('owner')
                b-danger
            @enderror">
            <input type="text" name="owner"
                   value="{{old('owner') ?: (isset($project->owner) ?
                $project->owner : '')}}"
                   class="form-control
            @error('owner')
               is-invalid
            @enderror">
        </div>
        @error('owner')
            <p class="txt-danger">{{$message}}</p>
        @enderror
    </div>
    <div class="col-sm-6 mb-3">
        <label class="col-sm-12 col-form-label" for="ProjectName">Project Sponsor <span class="text-danger f-w-550">*</span></label>
        <div class="col-sm-12
            @error('project_sponsor')
                b-danger
            @enderror">
            <input type="text" name="project_sponsor"
                   value="{{old('project_sponsor') ?: (isset($project->sponsor) ?
                $project->sponsor : '')}}"
                   class="form-control
                @error('project_sponsor')
                   is-invalid
                @enderror">
        </div>
        @error('project_sponsor')
            <p class="txt-danger">{{$message}}</p>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-sm-6 mb-3">
        <label class="col-sm-12 col-form-label">Maintenance Reps. <span class="text-danger f-w-550">*</span></label>
        <input type="text" name="maintenance_reps"
               value="{{old('maintenance_reps') ?: (isset($project->maintenance_reps) ?
                $project->maintenance_reps : '')}}"
               class="form-control
                @error('maintenance_reps')
                   is-invalid
                @enderror">
        @error('maintenance_reps')
        <p class="txt-danger">{{$message}}</p>
        @enderror
    </div>
    <div class="col-sm-6 mb-3">
        <label class="col-sm-12 col-form-label">Operation Reps. <span class="text-danger f-w-550">*</span></label>
        <input type="text" name="operation_reps"
               value="{{old('operation_reps') ?: (isset($project->operation_reps)
                ? $project->operation_reps : '')}}"
               class="form-control
                @error('operation_reps')
                   is-invalid
                @enderror">
        @error('operation_reps')
        <p class="txt-danger">{{$message}}</p>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-sm-6 mb-3">
        <label class="col-sm-12 col-form-label" for="BCPresenter">BC Presenter <span class="text-danger f-w-550">*</span></label>
        <input type="text" name="bc_presenter"
               value="{{old('bc_presenter') ?: (isset($project->bc_presenter) ?
                $project->bc_presenter : '')}}"
               class="form-control
                @error('bc_presenter')
                   is-invalid
                @enderror">
        @error('bc_presenter')
            <p class="txt-danger">{{$message}}</p>
        @enderror

    </div>
    <div class="col-sm-6 mb-3">
        <label class="col-sm-12 col-form-label" for="Finance Analyst">FEL1/FEL2/FEL3 Project Ref. <span class="text-danger f-w-550">*</span></label>
        <input type="text" name="fel_123_project_ref"
               value="{{old('fel_123_project_ref') ?: (isset($project->fel_123_project_ref)
                ? $project->fel_123_project_ref : '')}}"
               class="form-control
                @error('fel_123_project_ref')
                   is-invalid
                @enderror">
        @error('fel_123_project_ref')
            <p class="txt-danger">{{$message}}</p>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-sm-6 mb-3">
        <label class="col-sm-12 col-form-label" for="Finance Analyst">Finance Analyst</label>
        <input type="text" name="finance_analyst"
               value="{{old('finance_analyst') ?: (isset($project->finance_analyst)
                ? $project->finance_analyst : '')}}"
               class="form-control
                @error('finance_analyst')
                   is-invalid
                @enderror">
        @error('finance_analyst')
        <p class="txt-danger">{{$message}}</p>
        @enderror
    </div>
</div>

