<div class="mb-3">
    <label class="col-sm-3 col-form-label" for="projectNumber">Project Number</label>
    <div class="col-sm-12">
        <input class="form-control
            @error('project_number')
            is-invalid
            @enderror" id="projectNumber"
           name="project_number"
           value="{!! old('project_number')
            ?: (isset($project->project_number) ? $project->project_number : '') !!}"
           type="text" placeholder="Project Number">
    </div>
    @error('project_number')
        <p class="txt-danger">{{$message}}</p>
    @enderror
        <div class="invalid-feedback"></div>
</div>
<div class="mb-3">
    <label class="col-sm-3 col-form-label" for="ProjectName">Project Name</label>
    <div class="col-sm-12">
        <textarea class="form-control area1
            @error('project_name')
                is-invalid
            @enderror"
          id="simpleEditor"
          name="project_name"
          placeholder="Project Name">{{ old('project_name') ?:
            (isset($project->project_name) ?
            $project->project_name : '') }}</textarea>
    </div>
    @error('project_name')
        <p class="txt-danger">{{$message}}</p>
    @enderror
</div>
<div class="row g-3">
    <div class="col-sm-6 mb-3">
        <label class="col-sm-12 col-form-label" for="ProjectName">Project Category</label>
        <div class="col-sm-12
            @error('category')
                b-danger
            @enderror">
            <select name="category"
                    style="width: 100% !important;"
                    data-placeholder="Select Project Category"
                    class="js-example-basic-single col-sm-12
                    js-select-project-category
                    select2">
                <option></option>
                @foreach($projectCategory as $key=>$value)
                    <option {{old('category') == $key ||
                            (isset($project->project_category)
                            && $project->project_category == $key) ?
                             'selected="selected"' : ''}}
                            value="{{$key}}">{{$value}}
                    </option>
                @endforeach
            </select>
        </div>
        @error('category')
            <p class="txt-danger">{{$message}}</p>
        @enderror
    </div>
    <div class="mb-3 col-sm-6">
        <label class="col-sm-12 col-form-label" for="ProjectName">Project Type</label>
        <div class="col-sm-12
            @error('project_type')
                b-danger
            @enderror">
            <select id="" name="project_type" data-url="/getProjectType" data-id="{{$user_department}}"
                    class="select2
             js-example-basic-single form-control js-project-type">
                <option value="" disabled selected>Select your option</option>
                @foreach($projectType as $value)
                    <option value="{{$value->setting_value}}"
                        {{old('project_type') == $value->setting_value ||
                        (isset($project->project_type) && $project->project_type == $value->setting_value)
                        ? 'selected="selected"' : ''}}>{{$value->setting_value}}
                    </option>
                @endforeach
            </select>
        </div>
        @error('project_type')
            <p class="txt-danger">{{$message}}</p>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-sm-6 mb-3">
        <label class="col-sm-12 col-form-label" for="ProjectName">Owner Area</label>
        <div class="col-sm-12
            @error('owner')
                b-danger
            @enderror">
            <select id="" style="width: 100% !important;"
                    name="owner" data-url="/getProjectType" data-id="{{$user_department}}"
                    class="select2
                js-example-basic-single
                js-select-owner
                form-control">
                <option value="" disabled selected>Select your option</option>
                @foreach($department as $dep)
                    <option value="{{$dep->id}}"
                        {{old('owner') == $dep->id || (isset($project->owner) &&
                            $project->owner == $dep->id) ? 'selected="selected"' : ''}}>
                        {{$dep->name}}
                    </option>
                @endforeach
            </select>
        </div>
        @error('owner')
            <p class="txt-danger">{{$message}}</p>
        @enderror
    </div>
    <div class="col-sm-6 mb-3">
        <label class="col-sm-12 col-form-label" for="ProjectName">Project Sponsor</label>
        <div class="col-sm-12
                @error('sponsor')
                    b-danger
                @enderror
            ">
            <select id="" name="sponsor" data-url="/getSponsorByOwner" data-id="{{$user_department}}"
                    class="select2 select2-hidden-accessible
                 js-example-basic-single
                 js-select-sponsor
                form-control">
                <option value="" disabled selected>Select your option</option>
                @foreach($subDepartment as $sponsor)
                    <option value="{{$sponsor->id}}"
                        {{old('sponsor') == $sponsor->id || (isset($project->sponsor) && $project->sponsor == $sponsor->id ) ? 'selected="selected"': ""}}>{{$sponsor->name}}</option>
                @endforeach
            </select>
        </div>
        @error('sponsor')
            <p class="txt-danger">{{$message}}</p>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-sm-6 mb-3">
        <label class="col-sm-12 col-form-label" for="BCPresenter">BC Presenter</label>
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

