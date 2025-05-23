<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>SMRH</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="images/favicon.ico" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="css/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- Full calendar -->
      <link href='fullcalendar/core/main.css' rel='stylesheet' />
      <link href='fullcalendar/daygrid/main.css' rel='stylesheet' />
      <link href='fullcalendar/timegrid/main.css' rel='stylesheet' />
      <link href='fullcalendar/list/main.css' rel='stylesheet' />

      <link rel="stylesheet" href="css/flatpickr.min.css">

   </head>
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
      <!-- Wrapper Start -->
      <div class="wrapper">
         <!-- Sidebar  -->
         <div class="iq-sidebar">
            <div class="iq-navbar-logo d-flex justify-content-between">
               <a href="index.html" class="header-logo">
               <!-- <img src="images/logo.png" class="img-fluid rounded" alt=""> -->
               <!-- <span>FinDash</span> -->
               <span>{{ config('app.name', 'SMRH') }}</span>
               </a>
               <div class="iq-menu-bt align-self-center">
                  <div class="wrapper-menu">
                     <div class="main-circle"><i class="ri-menu-line"></i></div>
                     <div class="hover-circle"><i class="ri-close-fill"></i></div>
                  </div>
               </div>
            </div>
            <div id="sidebar-scrollbar">
            <nav class="iq-sidebar-menu">
            <ul class="iq-menu" id="iq-sidebar-toggle">
                @php
                    $menuItems = collect(config('sidebar.items'))->keyBy('key');
                    $userMenuPermissions = Auth::check()
                        ? \App\Models\UserMenuPermission::where('user_id', Auth::id())->pluck('enabled', 'menu_item_key')->toArray()
                        : [];
                @endphp

                @foreach(config('sidebar.items') as $item)
                    @php
                        $itemKey = $item['key'] ?? Str::slug($item['label']);
                        $isEnabled = $userMenuPermissions[$itemKey] ?? true;
                        $hasPermission = empty($item['permissions']) || (Auth::check() && Auth::user()->hasAnyPermission($item['permissions']));
                    @endphp

                    @if($isEnabled && $hasPermission)
                        <li class="{{ isset($item['sub_menu']) && collect($item['sub_menu'])->contains(fn($subItem) => (\App\Models\UserMenuPermission::where('user_id', Auth::id())->pluck('enabled', 'menu_item_key')->get($subItem['key'] ?? Str::slug($subItem['label'])) ?? true) && request()->routeIs($subItem['route'] ?? '')) ? 'active' : '' }}">
                            <a href="{{ isset($item['sub_menu']) ? '#' : route($item['route'] ?? '') }}{{ Str::slug($item['label']) }}"
                               class="iq-waves-effect {{ isset($item['sub_menu']) ? 'collapsed' : '' }}"
                               data-toggle="collapse"
                               aria-expanded="{{ isset($item['sub_menu']) && collect($item['sub_menu'])->contains(fn($subItem) => (\App\Models\UserMenuPermission::where('user_id', Auth::id())->pluck('enabled', 'menu_item_key')->get($subItem['key'] ?? Str::slug($subItem['label'])) ?? true) && request()->routeIs($subItem['route'] ?? '')) ? 'true' : 'false' }}">
                                <span class="ripple rippleEffect"></span>
                                <i class="las iq-arrow-left {{ $item['icon'] }}"></i>
                                <span>{{ $item['label'] }}</span>
                                @if(isset($item['sub_menu']))
                                    <i class="iq-arrow-right ri-arrow-right-s-line"></i>
                                @endif
                            </a>
                            @if(isset($item['sub_menu']))
                                <ul class="collapse iq-submenu {{ collect($item['sub_menu'])->contains(fn($subItem) => (\App\Models\UserMenuPermission::where('user_id', Auth::id())->pluck('enabled', 'menu_item_key')->get($subItem['key'] ?? Str::slug($subItem['label'])) ?? true) && request()->routeIs($subItem['route'] ?? '')) ? 'show' : '' }}"
                                    id="{{ Str::slug($item['label']) }}"
                                    data-parent="#iq-sidebar-toggle">
                                    @foreach($item['sub_menu'] as $subItem) 
                                        @php
                                            $subItemKey = $subItem['key'] ?? Str::slug($subItem['label']);
                                            $isSubItemEnabled = \App\Models\UserMenuPermission::where('user_id', Auth::id())->pluck('enabled', 'menu_item_key')->get($subItemKey) ?? true;
                                            $hasSubItemPermission = empty($subItem['permissions']) || (Auth::check() && Auth::user()->hasAnyPermission($subItem['permissions']));
                                        @endphp
                                        @if($isSubItemEnabled && $hasSubItemPermission)
                                            <li class="{{ request()->routeIs($subItem['route'] ?? '') ? 'active' : '' }}">
                                                <a href="{{ route($subItem['route'] ?? '') }}">
                                                    <i class="{{ $item['icon'] === 'las iq-arrow-left la-home' ? 'las la-laptop-code' : ($item['icon'] === 'las iq-arrow-left la-user-tie' ? 'las la-id-card-alt' : '') }}"></i>
                                                    {{ $subItem['label'] }}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
               <div class="p-3"></div>
            </div>
         </div>
         <!-- TOP Nav Bar -->
         <div class="iq-top-navbar">
            <div class="iq-navbar-custom">
               <nav class="navbar navbar-expand-lg navbar-light p-0">
                  <div class="iq-menu-bt d-flex align-items-center">
                     <div class="wrapper-menu">
                        <div class="main-circle"><i class="ri-menu-line"></i></div>
                        <div class="hover-circle"><i class="ri-close-fill"></i></div>
                     </div>
                     <div class="iq-navbar-logo d-flex justify-content-between ml-3">
                        <a href="index.html" class="header-logo">
                        <!-- <img src="images/logo.png" class="img-fluid rounded" alt=""> -->
                        <!-- <span>FinDash</span> -->
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
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  aria-label="Toggle navigation">
                  <i class="ri-menu-3-line"></i>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     
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
         <!-- TOP Nav Bar END -->
         
         <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-sm-6 col-md-6 col-lg-3">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body iq-box-relative">
                           <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-primary">
                              <i class="ri-focus-2-line"></i>
                           </div>
                           <p class="text-secondary">Total Sales</p>
                           <div class="d-flex align-items-center justify-content-between">
                              <h4><b>$18 378</b></h4>
                              <div id="iq-chart-box1"></div>
                              <span class="text-primary"><b> +14% <i class="ri-arrow-up-fill"></i></b></span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-3">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body iq-box-relative">
                           <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-danger">
                              <i class="ri-pantone-line"></i>
                           </div>
                           <p class="text-secondary">Sales Today</p>
                           <div class="d-flex align-items-center justify-content-between">
                              <h4><b>$190</b></h4>
                              <div id="iq-chart-box2"></div>
                              <span class="text-danger"><b> -6% <i class="ri-arrow-down-fill"></i></b></span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-3">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body iq-box-relative">
                           <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-success">
                              <i class="ri-database-2-line"></i>
                           </div>
                           <p class="text-secondary">Total Classon</p>
                           <div class="d-flex align-items-center justify-content-between">
                              <h4><b>45</b></h4>
                              <div id="iq-chart-box3"></div>
                              <span class="text-success"><b> +0.36% <i class="ri-arrow-up-fill"></i></b></span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-3">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body iq-box-relative">
                           <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-warning">
                              <i class="ri-pie-chart-2-line"></i>
                           </div>
                           <p class="text-secondary">Total Profit</p>
                           <div class="d-flex align-items-center justify-content-between">
                              <h4><b>60</b></h4>
                              <div id="iq-chart-box4"></div>
                              <span class="text-warning"><b> +0.45% <i class="ri-arrow-up-fill"></i></b></span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-8">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Spendings Stats </h4>
                           </div>
                           <div class="iq-card-header-toolbar d-flex align-items-center">
                              <ul class="nav nav-pills">
                                 <li class="nav-item">
                                    <a href="#" class="nav-link active">Personal</a>
                                 </li>
                                 <li class="nav-item">
                                    <a href="#" class="nav-link">Business</a>
                                 </li>
                                 <li class="nav-item">
                                    <a href="#" class="nav-link">Credit</a>
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <div class="iq-card-body row m-0 align-items-center pb-0">
                           <div class="col-md-8">
                              <div id="iq-income-chart"></div>
                           </div>
                           <div class="col-md-4">
                              <div class="chart-data-block">
                                 <h4><b>Total</b></h4>
                                 <h2><b>$ 49000 </b></h2>
                                 <p>Income Top the Last Week</p>
                                 <div class="chart-box d-flex align-items-center justify-content-between mt-5 mb-5">
                                    <div id="iq-chart-boxleft"></div>
                                    <div id="iq-chart-boxright"></div>
                                 </div>
                                 <div class="mt-3 pr-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                       <div class="d-flex align-items-center">
                                          <span class="bg-primary p-1 rounded mr-2"></span>
                                          <p class="mb-0">Successful Deals</p>
                                       </div>
                                       <h6><b>78%</b></h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                       <div class="d-flex align-items-center">
                                          <span class="bg-danger p-1 rounded mr-2"></span>
                                          <p class="mb-0">Failed Deals</p>
                                       </div>
                                       <h6><b>12%</b></h6>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height banner-image-block-bg position-relative" style="background: transparent url(images/page-img/45.png) no-repeat scroll center bottom; background-size: contain; height: 440px; box-shadow: none;">
                     </div>
                  </div>
                  <div class="col-lg-8">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Open Invoices</h4>
                           </div>
                           <div class="iq-card-header-toolbar d-flex align-items-center">
                              <div class="dropdown">
                                 <span class="dropdown-toggle text-primary" id="dropdownMenuButton5" data-toggle="dropdown">
                                 <i class="ri-more-fill"></i>
                                 </span>
                                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton5">
                                    <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                                    <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                                    <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                    <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                                    <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Download</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <div class="table-responsive">
                              <table class="table mb-0">
                                 <thead class="thead-light">
                                    <tr>
                                       <th scope="col">Customer</th>
                                       <th scope="col">Date</th>
                                       <th scope="col">Invoice</th>
                                       <th scope="col">Amount</th>
                                       <th scope="col">Status</th>
                                       <th scope="col">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td>Ira Membrit</td>
                                       <td>18/10/2019</td>
                                       <td>20156</td>
                                       <td>$1500</td>
                                       <td>
                                          <div class="badge badge-pill badge-success">Paid</div>
                                       </td>
                                       <td>Copy</td>
                                    </tr>
                                    <tr>
                                       <td>Pete Sariya</td>
                                       <td>26/10/2019</td>
                                       <td>7859</td>
                                       <td>$2000</td>
                                       <td>
                                          <div class="badge badge-pill badge-success">Paid</div>
                                       </td>
                                       <td>Send Email</td>
                                    </tr>
                                    <tr>
                                       <td>Cliff Hanger</td>
                                       <td>18/11/2019</td>
                                       <td>6396</td>
                                       <td>$2500</td>
                                       <td>
                                          <div class="badge badge-pill badge-danger">Past Due</div>
                                       </td>
                                       <td>Before Due</td>
                                    </tr>
                                    <tr>
                                       <td>Terry Aki</td>
                                       <td>14/12/2019</td>
                                       <td>7854</td>
                                       <td>$5000</td>
                                       <td>
                                          <div class="badge badge-pill badge-success">Paid</div>
                                       </td>
                                       <td>Copy</td>
                                    </tr>
                                    <tr>
                                       <td>Anna Mull</td>
                                       <td>24/12/2019</td>
                                       <td>568569</td>
                                       <td>$10000</td>
                                       <td>
                                          <div class="badge badge-pill badge-success">Paid</div>
                                       </td>
                                       <td>Send Email</td>
                                    </tr>
                                    <tr>
                                       <td>Alex john</td>
                                       <td>05/12/2019</td>
                                       <td>45896</td>
                                       <td>$15236</td>
                                       <td>
                                          <div class="badge badge-pill badge-success">Paid</div>
                                       </td>
                                       <td>Send Email</td>
                                    </tr>
                                    <tr>
                                       <td>Rock lai</td>
                                       <td>28/12/2019</td>
                                       <td>458965</td>
                                       <td>$50200</td>
                                       <td>
                                          <div class="badge badge-pill badge-success">Paid</div>
                                       </td>
                                       <td>Send Email</td>
                                    </tr>
                                    <tr>
                                       <td>Cliff Hanger</td>
                                       <td>18/11/2019</td>
                                       <td>6396</td>
                                       <td>$2500</td>
                                       <td>
                                          <div class="badge badge-pill badge-danger">Past Due</div>
                                       </td>
                                       <td>Before Due</td>
                                    </tr>
                                    <tr>
                                       <td>Terry Aki</td>
                                       <td>14/12/2019</td>
                                       <td>7854</td>
                                       <td>$5000</td>
                                       <td>
                                          <div class="badge badge-pill badge-success">Paid</div>
                                       </td>
                                       <td>Copy</td>
                                    </tr>
                                    <tr>
                                       <td>Anna Mull</td>
                                       <td>24/12/2019</td>
                                       <td>568569</td>
                                       <td>$10000</td>
                                       <td>
                                          <div class="badge badge-pill badge-success">Paid</div>
                                       </td>
                                       <td>Send Email</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body">
                           <div class="d-flex align-items-center mt-3">
                              <div class="icon iq-icon-box rounded iq-bg-danger mr-3">
                                 <i class="ri-shopping-bag-line"></i>
                              </div>
                              <div class="iq-details col-sm-9 p-0">
                                 <div class="d-flex align-items-center justify-content-between">
                                    <span class="title text-dark">Dailly expenses</span>
                                    <div class="percentage"><b><span>$</span> 620 </b></div>
                                 </div>
                                 <div class="iq-progress-bar-linear d-inline-block w-100">
                                    <div class="iq-progress-bar">
                                       <span class="bg-danger" data-percent="67"></span>
                                    </div>
                                 </div>
                                 <div class="d-flex align-items-center justify-content-between">
                                    <span class="">45 Transaction</span>
                                    <div class="percentage">67<span>%</span></div>
                                 </div>
                              </div>
                           </div>
                           <hr class="mt-4 mb-4">
                           <div class="d-flex align-items-center">
                              <div class="icon iq-icon-box rounded iq-bg-warning mr-3">
                                 <i class="ri-home-8-line"></i>
                              </div>
                              <div class="iq-details col-sm-9 p-0">
                                 <div class="d-flex align-items-center justify-content-between">
                                    <span class="title text-dark">House, bills</span>
                                    <div class="percentage"><b><span>$</span> 230 </b></div>
                                 </div>
                                 <div class="iq-progress-bar-linear d-inline-block w-100">
                                    <div class="iq-progress-bar">
                                       <span class="bg-warning" data-percent="32"></span>
                                    </div>
                                 </div>
                                 <div class="d-flex align-items-center justify-content-between">
                                    <span class="">38 Transaction</span>
                                    <div class="percentage">32<span>%</span></div>
                                 </div>
                              </div>
                           </div>
                           <hr class="mt-4 mb-4">
                           <div class="d-flex align-items-center">
                              <div class="icon iq-icon-box rounded iq-bg-success mr-3">
                                 <i class="ri-camera-lens-line"></i>
                              </div>
                              <div class="iq-details col-sm-9 p-0">
                                 <div class="d-flex align-items-center justify-content-between">
                                    <span class="title text-dark">Children</span>
                                    <div class="percentage float-right"><b><span>$</span> 120 </b></div>
                                 </div>
                                 <div class="iq-progress-bar-linear d-inline-block w-100">
                                    <div class="iq-progress-bar">
                                       <span class="bg-success" data-percent="20"></span>
                                    </div>
                                 </div>
                                 <div class="d-flex align-items-center justify-content-between">
                                    <span class="">9 Transaction</span>
                                    <div class="percentage float-right">20<span>%</span></div>
                                 </div>
                              </div>
                           </div>
                           <hr class="mt-4 mb-4">
                           <div class="d-flex align-items-center">
                              <div class="icon iq-icon-box rounded iq-bg-primary mr-3">
                                 <i class="ri-hospital-line"></i>
                              </div>
                              <div class="iq-details col-sm-9 p-0">
                                 <div class="d-flex align-items-center justify-content-between">
                                    <span class="title text-dark">Health</span>
                                    <div class="percentage float-right"><b><span>$</span> 80 </b></div>
                                 </div>
                                 <div class="iq-progress-bar-linear d-inline-block w-100">
                                    <div class="iq-progress-bar">
                                       <span class="bg-primary" data-percent="30"></span>
                                    </div>
                                 </div>
                                 <div class="d-flex align-items-center justify-content-between">
                                    <span class="">18 Transaction</span>
                                    <div class="percentage">30<span>%</span></div>
                                 </div>
                              </div>
                           </div>
                           <hr class="mt-4 mb-4">
                           <div class="d-flex align-items-center">
                              <div class="icon iq-icon-box rounded iq-bg-info mr-3">
                                 <i class="ri-bank-line"></i>
                              </div>
                              <div class="iq-details col-sm-9 p-0">
                                 <div class="d-flex align-items-center justify-content-between">
                                    <span class="title text-dark">Banking</span>
                                    <div class="percentage float-right"><b><span>$</span> 110 </b></div>
                                 </div>
                                 <div class="iq-progress-bar-linear d-inline-block w-100">
                                    <div class="iq-progress-bar">
                                       <span class="bg-info" data-percent="60"></span>
                                    </div>
                                 </div>
                                 <div class="d-flex align-items-center justify-content-between">
                                    <span class="">50 Transaction</span>
                                    <div class="percentage">60<span>%</span></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">User Percentage</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <div id="home-perfomer-chart"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Users</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <ul class="perfomer-lists m-0 p-0">
                              <li class="d-flex mb-4 align-items-center">
                                 <div class="user-img img-fluid"><img src="images/page-img/29.png" alt="story-img" class="rounded avatar-40"></div>
                                 <div class="media-support-info ml-3">
                                    <h6>Dribble</h6>
                                    <p class="mb-0 font-size-12">Graphics Designer</p>
                                 </div>
                                 <div class="iq-card-header-toolbar d-flex align-items-center">
                                    <span class="text-primary"><b>$10.00</b></span>
                                 </div>
                              </li>
                              <li class="d-flex mb-4 align-items-center">
                                 <div class="user-img img-fluid"><img src="images/page-img/30.png" alt="story-img" class="rounded avatar-40"></div>
                                 <div class="media-support-info ml-3">
                                    <h6>Behance</h6>
                                    <p class="mb-0 font-size-12">Developer</p>
                                 </div>
                                 <div class="iq-card-header-toolbar d-flex align-items-center">
                                    <span class="text-primary"><b>$25.50</b></span>
                                 </div>
                              </li>
                              <li class="d-flex mb-4 align-items-center">
                                 <div class="user-img img-fluid"><img src="images/page-img/31.png" alt="story-img" class="rounded avatar-40"></div>
                                 <div class="media-support-info ml-3">
                                    <h6>Instagram</h6>
                                    <p class="mb-0 font-size-12">Posts</p>
                                 </div>
                                 <div class="iq-card-header-toolbar d-flex align-items-center">
                                    <span class="text-primary"><b>$15.00</b></span>
                                 </div>
                              </li>
                              <li class="d-flex mb-4 align-items-center">
                                 <div class="user-img img-fluid"><img src="images/page-img/32.png" alt="story-img" class="rounded avatar-40"></div>
                                 <div class="media-support-info ml-3">
                                    <h6>Twitter</h6>
                                    <p class="mb-0 font-size-12">Latest News</p>
                                 </div>
                                 <div class="iq-card-header-toolbar d-flex align-items-center">
                                    <span class="text-primary"><b>$5.00</b></span>
                                 </div>
                              </li>
                              <li class="d-flex mb-4 align-items-center">
                                 <div class="user-img img-fluid"><img src="images/page-img/33.png" alt="story-img" class="rounded avatar-40"></div>
                                 <div class="media-support-info ml-3">
                                    <h6>Bootstrap</h6>
                                    <p class="mb-0 font-size-12">Ui/Ux Design</p>
                                 </div>
                                 <div class="iq-card-header-toolbar d-flex align-items-center">
                                    <span class="text-primary"><b>$5.00</b></span>
                                 </div>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="iq-card iq-card-block iq-card-stretch" style="position: relative;">
                        <div class="iq-card-body">
                           <h6>Graph Profit Margin</h6>
                           <h2>80%</h2>
                        </div>
                        <div id="home-profit-chart"></div>
                     </div>
                     <div class="iq-card iq-card-block iq-card-stretch" style="position: relative;">
                        <div class="iq-card-body">
                           <h6>Graph Loss Margin</h6>
                           <h2>25%</h2>
                        </div>
                        <div id="home-loss-chart"></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Wrapper END -->
      <!-- Footer -->
      <footer class="iq-footer">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-6">
                  <ul class="list-inline mb-0">
                     <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                     <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
                  </ul>
               </div>
               <div class="col-lg-6 text-right">
                  Copyright 2020 <a href="#">FinDash</a> All Rights Reserved.
               </div>
            </div>
         </div>
      </footer>
      <!-- Footer END -->
     
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- Appear JavaScript -->
      <script src="js/jquery.appear.js"></script>
      <!-- Countdown JavaScript -->
      <script src="js/countdown.min.js"></script>
      <!-- Counterup JavaScript -->
      <script src="js/waypoints.min.js"></script>
      <script src="js/jquery.counterup.min.js"></script>
      <!-- Wow JavaScript -->
      <script src="js/wow.min.js"></script>
      <!-- Apexcharts JavaScript -->
      <script src="js/apexcharts.js"></script>
      <!-- Slick JavaScript -->
      <script src="js/slick.min.js"></script>
      <!-- Select2 JavaScript -->
      <script src="js/select2.min.js"></script>
      <!-- Owl Carousel JavaScript -->
      <script src="js/owl.carousel.min.js"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="js/jquery.magnific-popup.min.js"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="js/smooth-scrollbar.js"></script>
      <!-- lottie JavaScript -->
      <script src="js/lottie.js"></script>
      <!-- am core JavaScript -->
      <script src="js/core.js"></script>
      <!-- am charts JavaScript -->
      <script src="js/charts.js"></script>
      <!-- am animated JavaScript -->
      <script src="js/animated.js"></script>
      <!-- am kelly JavaScript -->
      <script src="js/kelly.js"></script>
      <!-- am maps JavaScript -->
      <script src="js/maps.js"></script>
      <!-- am worldLow JavaScript -->
      <script src="js/worldLow.js"></script>
      <!-- Raphael-min JavaScript -->
      <script src="js/raphael-min.js"></script>
      <!-- Morris JavaScript -->
      <script src="js/morris.js"></script>
      <!-- Morris min JavaScript -->
      <script src="js/morris.min.js"></script>
      <!-- Flatpicker Js -->
      <script src="js/flatpickr.js"></script>
      <!-- Style Customizer -->
      <script src="js/style-customizer.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="js/custom.js"></script>
   </body>
</html>