<div class="row g-3">
    <div class="col-md-6">
        <label class="col-sm-3 col-form-label" for="ProjectName">Project No <span class="text-danger f-w-550">*</span></label>
        <input type="text" name="project_number"
               readonly
               value="{{old('project_number') ?: (isset($project->project_number) ?
                $project->project_number : $initialProjectNo ?? "")}}"
               class="form-control js-project_no
                @error('project_number')
                   is-invalid
                @enderror">
        @error('project_number')
        <p class="txt-danger">{{$message}}</p>
        @enderror
    </div>
    <div class="col-sm-6">
        <label class="col-sm-3 col-form-label" for="ProjectName">Project Title <span class="text-danger f-w-550">*</span></label>
        <textarea class="form-control area1
            @error('project_name')
                is-invalid
            @enderror"
          id="simpleEditor"
          name="project_name"
          placeholder="Project Title">{{ old('project_name') ?:
            (isset($project->project_name) ?
            $project->project_name : '') }}</textarea>
        @error('project_name')
            <p class="txt-danger">{{$message}}</p>
        @enderror
    </div>
</div>
<div class="row g-3">
    <div class="mb-3 col-sm-6">
        <label class="col-sm-12 col-form-label" for="ProjectName">Directorate <span class="text-danger f-w-550">*</span></label>
        <div class="col-sm-12
            @error('directorate')
                b-danger
            @enderror">
            <select name="directorate"
                    style="width: 100% !important;"
                    data-placeholder="Select Operation Area"
                    class="js-example-basic-single col-sm-12
                    select2">
                <option></option>
                @foreach($directorate as $dep)
                    <option {{old('directorate') == $dep->id ||
                            (isset($project->directorate)
                            && $project->directorate == $dep->id) ?
                             'selected="selected"' : ''}}
                            value="{{$dep->id}}">{{$dep->name}}
                    </option>
                @endforeach
            </select>
        </div>
        @error('sponsor_area')
        <p class="txt-danger">{{$message}}</p>
        @enderror
    </div>
    <div class="col-sm-6 mb-3">
        <label class="col-sm-12 col-form-label" for="ProjectName">Department <span class="text-danger f-w-550">*</span></label>
        <div class="col-sm-12
            @error('operation_area')
                b-danger
            @enderror">
            <select name="operation_area"
                    style="width: 100% !important;"
                    data-placeholder="Select Operation Area"
                    class="js-example-basic-single col-sm-12
                    js-select-owner
                    select2">
                <option></option>
                @foreach($department as $dep)
                    <option {{old('operation_area') == $dep->id ||
                            (isset($project->operation_area)
                            && $project->operation_area == $dep->id) ?
                             'selected="selected"' : ''}}
                            value="{{$dep->id}}">{{$dep->name}}
                    </option>
                @endforeach
            </select>
        </div>
        @error('operation_area')
            <p class="txt-danger">{{$message}}</p>
        @enderror
    </div>
    <div class="mb-3 col-sm-6">
        <label class="col-sm-12 col-form-label" for="ProjectName">Sponsor <span class="text-danger f-w-550">*</span></label>
        <div class="col-sm-12
            @error('sponsor_area')
                b-danger
            @enderror">
            <select id="" name="sponsor_area" data-url="/getProjectType" data-id="{{$user_department}}"
                    class="select2
             js-example-basic-single form-control js-select-sponsor">
                <option value="" disabled selected>Select your option</option>
                @if(isset($project->sponsorsProject?->name))
                    <option value="{{$project->sponsorsProject?->id}}" data-sponsor="{{$project->sponsorsProject?->supervisor}}" data-owner="{{$project->ownersProject->supervisor}}" >{{$project->sponsorsProject?->name}}</option>
                @endif
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
            <input type="text" name="owner" readonly
                   value="{{old('owner') ?: (isset($project->owner) ?
                $project->owner : '')}}"
                   class="form-control js-project-owner
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
            <input type="text" name="project_sponsor" readonly
                   value="{{old('project_sponsor') ?: (isset($project->sponsor) ?
                $project->sponsor : '')}}"
                   class="form-control js-project-sponsor
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
        <label class="col-sm-12 col-form-label" for="Finance Analyst">BC Originator <span class="text-danger f-w-550">*</span></label>
        <input type="text" name="bc_originator"
               value="{{old('bc_originator') ?: (isset($project->bc_originator)
                ? $project->bc_originator : '')}}"
               class="form-control
                @error('bc_originator')
                   is-invalid
                @enderror">
        @error('bc_originator')
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
    <div class="col-sm-6 mb-3">
        <label class="col-sm-12 col-form-label" for="Finance Analyst">Email PIC</label>
        <input type="text" name="email_pic"
               value="{{old('email_pic') ?: (isset($project->email_pic)
                ? $project->email_pic : '')}}"
               class="form-control
                @error('email_pic')
                   is-invalid
                @enderror">
        @error('email_pic')
        <p class="txt-danger">{{$message}}</p>
        @enderror
    </div>
</div>

