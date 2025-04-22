<div class="iq-sidebar">
    <div class="iq-navbar-logo d-flex justify-content-between">
        <a href="{{ url('/') }}" class="header-logo">
            <img src="{{ asset('images/logo.png') }}" class="rounded img-fluid" alt="">
            <span>FinDash</span>
        </a>
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