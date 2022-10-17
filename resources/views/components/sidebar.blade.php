<header class="main-nav">
    <div class="sidebar-user text-center"><a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a><img class="img-90 rounded-circle" src="{{asset('assets/images/dashboard/1.png')}}" alt="">
        <div class="badge-bottom"><span class="badge badge-primary">New</span></div><a href="user-profile.html">
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
                    <li class="dropdown"><a class="nav-link menu-title" href="/"><i data-feather="home"></i><span>Dashboard</span></a>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="box"></i><span>Project</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="/project">Project List</a></li>
                            <li><a href="/assessment">Project Level Assessment</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>
