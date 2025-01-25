<header class="main-nav">
    <div class="sidebar-user text-center">
        <div class="badge-bottom"></div><a href="">
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
                        <a class="nav-link menu-title {{request()->is(['project*']) ? 'active' : ''}}" href="/project">
                            <i data-feather="box"></i><span>Project</span></a>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>
