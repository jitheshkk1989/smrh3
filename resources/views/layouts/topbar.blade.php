<div class="iq-top-navbar">
    <div class="iq-navbar-custom">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
            <div class="iq-menu-bt d-flex align-items-center">
                <div class="wrapper-menu">
                    <div class="main-circle"><i class="ri-menu-line"></i></div>
                    <div class="hover-circle"><i class="ri-close-fill"></i></div>
                </div>
                <div class="ml-3 d-flex iq-navbar-logo justify-content-between">
                    <a href="{{ url('/') }}" class="header-logo">
                        <!-- <img src="{{ asset('images/logo.png') }}" class="rounded img-fluid" alt="{{ config('app.name', 'Laravel') }} Logo"> -->
                        <span>{{ config('app.name', 'SMRH') }}</span>
                    </a>
                </div>
            </div>
            <div class="iq-search-bar">
                <form action="#" class="searchbox">
                    <input type="text" class="text search-input" placeholder="Type here to search...">
                    <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                </form>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
                <i class="ri-menu-3-line"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    </ul>
            </div>
            <ul class="navbar-list">
                @auth
                    <li class="line-height">
                        <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px; font-size: 16px; font-weight: bold;">
                                {{ strtoupper(substr(Auth::user()->employee->first_name . ' ' . Auth::user()->employee->last_name, 0, 2)) }}
                            </div>
                            <div class="caption">
                                <h6 class="mb-0 line-height">{{ Auth::user()->employee->first_name }} {{ Auth::user()->employee->last_name }}</h6>
                                <p class="mb-0">{{ Auth::user()->employee->position ?? 'User' }}</p>
                            </div>
                        </a>
                        <div class="iq-sub-dropdown iq-user-dropdown">
                            <div class="iq-card m-0 shadow-none">
                                <div class="card-body p-0">
                                    <div class="bg-primary p-3">
                                        <h5 class="mb-0 text-white line-height">Hello {{ Auth::user()->employee->first_name }} {{ Auth::user()->employee->last_name }}</h5>
                                        <span class="text-white font-size-12">{{ Auth::user()->status ?? 'Available' }}</span>
                                    </div>
                                    <a href="{{ url('/profile') }}" class="iq-sub-card iq-bg-primary-hover">
                                        <div class="media align-items-center">
                                            <div class="rounded iq-bg-primary iq-card-icon d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 12px; font-weight: bold;">
                                                {{ strtoupper(substr(Auth::user()->employee->first_name . ' ' . Auth::user()->employee->last_name, 0, 2)) }}
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0">My Profile</h6>
                                                <p class="mb-0 font-size-12">View personal profile details.</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="{{ url('/profile-edit') }}" class="iq-sub-card iq-bg-primary-hover">
                                        <div class="media align-items-center">
                                            <div class="rounded iq-bg-primary iq-card-icon d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 12px; font-weight: bold;">
                                                {{ strtoupper(substr(Auth::user()->employee->first_name . ' ' . Auth::user()->employee->last_name, 0, 2)) }}
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0">Edit Profile</h6>
                                                <p class="mb-0 font-size-12">Modify your personal details.</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{ url('/account-setting') }}" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                        <div class="rounded iq-bg-primary iq-card-icon d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 12px; font-weight: bold;">
                                            {{ strtoupper(substr(Auth::user()->employee->first_name . ' ' . Auth::user()->employee->last_name, 0, 2)) }}
                                        </div>
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0">Account settings</h6>
                                            <p class="mb-0 font-size-12">Manage your account parameters.</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{ url('/privacy-setting') }}" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                        <div class="rounded iq-bg-primary iq-card-icon d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 12px; font-weight: bold;">
                                            {{ strtoupper(substr(Auth::user()->employee->first_name . ' ' . Auth::user()->employee->last_name, 0, 2)) }}
                                        </div>
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0">Privacy Settings</h6>
                                            <p class="mb-0 font-size-12">Control your privacy parameters.</p>
                                        </div>
                                    </div>
                                </a>
                                <div class="d-inline-block w-100 text-center p-3">
                                    <a class="bg-primary iq-sign-btn" href="{{ url('/logout') }}" role="button">Sign out<i class="ri-login-box-line ml-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </li>
                @else
                    <li class="line-height">
                        <a href="{{ route('login') }}" class="iq-waves-effect d-flex align-items-center">
                            <i class="ri-login-box-line mr-2"></i>
                            <div class="caption">
                                <h6 class="mb-0 line-height">Login</h6>
                            </div>
                        </a>
                    </li>
                    @if (Route::has('register'))
                        <li class="line-height">
                            <a href="{{ route('register') }}" class="iq-waves-effect d-flex align-items-center">
                                <i class="ri-user-add-line mr-2"></i>
                                <div class="caption">
                                    <h6 class="mb-0 line-height">Register</h6>
                                </div>
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </nav>
    </div>
</div>