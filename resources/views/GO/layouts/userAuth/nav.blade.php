<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
                    {{ Request::path() === '/' ? 'Landing Page' : str_replace('-', ' ', Request::path()) }}</li>
            </ol>
            <h6 class="font-weight-bolder mb-0 text-capitalize">
                {{ Request::path() === '/' ? 'Landing Page' : str_replace('-', ' ', Request::path()) }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-between justify-content-md-end"
            id="navbar">
            <a href="javascript:;" class="nav-link text-body p-0 d-xl-none d-flex align-items-center"
                id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                </div>
            </a>
            <div class="ms-md-3 pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Type here...">
                </div>
            </div>

            @if (Auth::guest())
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link me-2" href="{{ url('register') }}">
                            <i class="fas fa-user-circle opacity-6 me-1 text-dark"></i>
                            Sign Up
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="{{ url('login') }}">
                            <i class="fas fa-key opacity-6 me-1 text-dark"></i>
                            Sign In
                        </a>
                    </li>
                </ul>
            @else
                <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <span class="d-sm-inline d-none font-weight-bold">{{ auth()->user()->name }}</span>
                    <i class="fa fa-user ms-sm-1"></i>
                </a>
                <ul class="dropdown-menu  dropdown-menu-end p-2 m-0" aria-labelledby="dropdownMenuButton">
                    <li class="mb-1">
                        <a class="dropdown-item border-radius-md"  href="{{ url('/user-profile') }}">
                            <div class="d-flex py-1">
                                <div class="my-auto">
                                    <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="text-sm font-weight-bold mb-1">
                                        {{ auth()->user()->name }}
                                    </h6>
                                    <p class="text-xs text-secondary mb-0">
                                        {{ auth()->user()->role }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a class="dropdown-item border-radius-md" href="{{ route(auth()->user()->role->value . '.dashboard') }}">
                            <div class="d-flex py-1 align-items-center justify-content-center">
                                <div class="d-flex flex-column">
                                    <h6 class="text-sm font-weight-bold mb-0">
                                        Dashboard
                                    </h6>
                                </div>
                            </div>
                        </a>
                    </li>
                    <hr class="dark my-1">
                    <li class="mb-0 ">
                        <a class="dropdown-item border-radius-md" href="{{ url('/logout') }}">
                            <div class="d-flex py-1 align-items-center justify-content-center">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="text-sm font-weight-bold mb-0">
                                        Sign Out
                                    </h6>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</nav>
<!-- End Navbar -->
