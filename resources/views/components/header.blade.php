<div class="page-main-header">
    <div class="main-header-right row m-0">
        <div class="main-header-left">
            <div class="logo-wrapper"><a href="index.html"><img class="img-fluid" width="35%" src="{{asset('image/vale.png')}}" alt=""></a></div>
            <div class="dark-logo-wrapper"><a href="index.html"><img class="img-fluid" src="{{asset('image/vale.png')}}" alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle"></i></div>
        </div>
        <div class="nav-right col pull-right right-menu p-0">
            <ul class="nav-menus">
                <li class="onhover-dropdown p-0">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-primary-light" type="button"><a :href="route('logout')"
                               onclick="event.preventDefault();
                                this.closest('form').submit();">
                                <i data-feather="log-out"></i>Log out</a></button>
                    </form>
                </li>
            </ul>
        </div>
        <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
    </div>
</div>
