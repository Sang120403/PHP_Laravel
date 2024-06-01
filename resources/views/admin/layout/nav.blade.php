<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <ul class="navbar-nav ms-auto pe-md-3 align-items-center">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-language me-sm-1"></i>
                        <span class="d-sm-inline d-none">@lang('lang.lang')</span>
                    </a>
                    <ul class="dropdown-menu" style="top: -0.5rem!important;left: -25px;">
                        <li>
                            <a class="dropdown-item" href="lang/en">
                                <img src="images/language/united-states.png" alt="" style="height: 30px">
                                &nbsp;@lang('lang.en')
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="lang/vi">
                                <img src="images/language/vietnam.png" alt="" style="height: 30px">&nbsp;@lang('lang.vi')
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Uncomment below to add user dropdown menu -->
                <li class="nav-item dropdown ps-3">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-id-card me-sm-1"></i>
                        {{-- <span class="d-sm-inline d-none">{{ Auth::user()->fullName }}</span> --}}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" style="top: -0.5rem!important;left: -25px;">
                        <li><a class="dropdown-item" href="/admin/profile">@lang('lang.profile')</a></li>
                        <li><a class="dropdown-item" href="/admin/sign_out">@lang('lang.signout')</a></li>
                    </ul>
                </li> 
            
                <li class="nav-item d-flex d-xl-none align-items-center">
                    <a href="javascript:;" class="nav-link p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <span class="bg-white"></span>
                            <span class="bg-white"></span>
                            <span class="bg-white"></span>
                        </div>
                    </a>
                </li>
                <!-- Uncomment below to add cog icon -->
                <!-- 
                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li> 
                -->
            </ul>
        </div>
    </div>
</nav>
