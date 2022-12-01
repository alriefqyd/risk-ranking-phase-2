<header class="main-nav">
    <div class="sidebar-user text-center"><img class="img-90 rounded-circle" src="{{asset('assets/images/dashboard/1.png')}}" alt="">
        <div class="badge-bottom"></div><a href="user-profile.html">
            <h6 class="mt-3 f-14 f-w-600">{{auth()->user()->name}}</h6></a>
        <p class="mb-0 font-roboto">{{auth()->user()->role}}</p>
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span></div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title
                            {{request()->is('/') ? 'active' : ''}}"
                            href="/"><i data-feather="home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title {{request()->is(['project*','assessment*','fel1*']) ? 'active' : ''}}">
                            <i data-feather="box"></i><span>Project</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a class="{{request()->is('project*') ? 'active' : ''}}" href="/project">Project List</a></li>
                            <li><a class="{{request()->is('assessment*') ? 'active' : ''}}" href="/assessment">Project Level Assessment</a></li>
                            <li><a class="{{request()->is('fel1*') ? 'active' : ''}}" href="/fel1">FEL 1</a></li>
                            <li><a class="{{request()->is('fel2*') ? 'active' : ''}}" href="/fel2">FEL 2</a></li>
                            <li><a class="{{request()->is('fel3*') ? 'active' : ''}}" href="/fel3">FEL 3</a></li>
                            <li><a class="{{request()->is('business-case*') ? 'active' : ''}}" href="/business-case">Business Case</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>
