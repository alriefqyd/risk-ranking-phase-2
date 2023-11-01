@include('components.asset')
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 p-0">
                <div class="login-card">
                        <form method="POST" class="theme-form login-form" action="{{ route('login') }}">
                            @csrf
                        <div class="text-center">
                            <img style="width: auto; height: 5rem"
                                 class="fill-current text-gray-500 mb-3" src="{{asset('image/vale.png')}}"/>
                        </div>
                        <h6 class="text-center">Risk Ranking Capital Investment and R&D Budget Cycle
                            2024 - 2028</h6>

                        @if ($errors->any())
                            <div class="mb-4">
                                <div class="text-md text-danger">{{ __('Whoops! Something went wrong.') }}</div>
                                <span class="mt-3 text-sm text-danger">
                                    @foreach ($errors->all() as $error)
                                        <li> {{ $error }}</li>
                                    @endforeach
                                </span>
                            </div>
                        @endif
                        <div class="form-group">
                            <label>User Name</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input
                                    type="text"
                                    name="user_name"
                                    value=""
                                    class="form-control"
                                    autoComplete="username"
                                />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-key"></i>
                                </span>
                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    autoComplete="current-password"
                                />
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-outline-primary" type="submit">Sign in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
