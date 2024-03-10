<div class="row">
    <div class="col-md-3 m-l-10 m-t-15 m-b-10">
        <h6 class="font-roboto js-title-detail {{!$errors->any() ? '' : 'd-none'}} title">Project Detail</h6>
        <h6 class="font-roboto p-l-10 js-title-form {{!$errors->any() ? 'd-none' : ''}} title">Project Form</h6>
    </div>
    @if(!$isNotCurrentData)
        @can('update')
            @if(auth()->user()->role == \App\Models\User::ROLE['admin'])
                <div class="col-md-8 m-l-50 m-b-10">
                    <button class="btn btn-sm btn-success m-t-10 float-end {{!$errors->any() ? '' : 'd-none'}}
                        js-btn-edit_project">
                        Edit <i style="width: 20px; height: 15px;" data-feather="edit"></i>
                    </button>
                    <button class="btn btn-sm btn-success m-t-10 float-end {{!$errors->any() ? 'd-none' : ''}}
                        js-btn-view_project">
                        View <i style="width: 20px; height: 15px;" data-feather="eye"></i>
                    </button>
                </div>
           @endif
        @endcan
    @endif
</div>
@if(auth()->user()->role == \App\Models\User::ROLE['admin'])
@can('update')
    @if(!$isNotCurrentData)
        <form method="post" action="/project/{{$project?->id}}"
              class="theme-form js-project-edit js-project-form">
            @csrf
            @method('PUT')
            <div class="row js-form-project-edit {{!$errors->any() ? 'd-none' : ''}} m-t-0">
                <div class="p-4 pt-0">
                    @include('page.project.form',[
                        'subDepartment' => $subDepartment,
                        'department' => $department,
                        'user_department' => $userDepartment,
                        'errors' => $errors
                    ])
                </div>
            </div>
            <div class="separator d-none js-form-project-edit"></div>
            <div class="row js-form-project-edit d-none center-content p-4 mt-3 ">
                <div class="col-md-12">
                    <h5 class="text-left">
                        <a class="mr-2 setting-primary-custom bg-draft">
                            <i class="fa fa-dollar text-white"></i>
                        </a>
                        <span class="text-primary-template f-w-700">CAPEX INVESTMENT</span>
                    </h5>
                    <div class="col-md-6 text-center">
                        <div style="height: 3px; background-color: #24695c "></div>
                    </div>
                </div>
            </div>
            <div class="row js-form-project-edit d-none center-content mb-0 p-4">
                @include('page.project.capex_investment_option')
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary js-button-investment_category">Submit</button>
                    <button class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </form>

        <div class="modal js-modal-loading" id="modal-loading" data-backdrop="static">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <div class="loading-spinner mb-2"></div>
                        <div>Loading....</div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endcan
@endif
<div class="row js-form-project-detail m-b-30 {{!$errors->any() ? '' : 'd-none'}}">
    <div class="table-responsive">
        <table class="table table-striped">
            <tbody>
            <tr>
                <td style="width: 200px">Basket : </td>
                <td>{{$project?->baskets?->name}}</td>
            </tr>
            <tr>
                <td style="width: 200px">Sub Basket : </td>
                <td>{{$project?->subBaskets?->name}}</td>
            </tr>
            <tr>
                <td style="width: 200px">Sub Basket Categories : </td>
                <td>{{$project?->categories?->name ?? ''}}</td>
            </tr>
{{--            <tr>--}}
{{--                <td style="width: 200px">Project Number : </td>--}}
{{--                <td>{{$project?->project_number}}</td>--}}
{{--            </tr>--}}
            <tr>
                <td>Project Name : </td>
                <td>{{$project?->project_name}}</td>
            </tr>
            @if(isset($project?->project_type))
                <tr>
                    <td>Project Type : </td>
                    <td>{{$project?->project_type}}</td>
                </tr>
            @endif
            <tr>
                <td>Owner Area :</td>
                <td> {{$project->ownersProject?->name}}</td>
            </tr>
            <tr>
                <td>Sponsor Area :</td>
                <td>{{$project?->sponsorsProject?->name}}</td>
            </tr>
            <tr>
                <td>BC Presenter :</td>
                <td>{{$project?->bc_presenter}}</td>
            </tr>
            <tr>
                <td>Finance Analyst :</td>
                <td>{{$project?->finance_analyst}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
