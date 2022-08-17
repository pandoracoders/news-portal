<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend') }}/assets/images/logo-icon-2.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">News Portal</h4>
        </div>
        <div class="toggle-icon ms-auto">
            <ion-icon name="menu-sharp"></ion-icon>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        <li>
            <a href="{{ route('backend.dashboard') }}">
                <div class="parent-icon">
                    <i class="bi bi-house-door"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        @foreach (config('constants.sidebar') as $section)
            {{-- {{  dd($section);}} --}}
            <li class="menu-label">{{ $section['group'] }}</li>

            @foreach ($section['children'] as $link)
                @if (hasPermission($link['url']))
                    <li {{ Route::currentRouteName() == $link['url'] ? 'class=mm-active' : '' }}>
                        <a href="{{ route($link['url']) }}">
                            <div class="parent-icon">
                                <i class="bi {{ $link['icon'] }}"></i>
                            </div>
                            <div class="menu-title">{{ $link['title'] }}</div>
                        </a>
                    </li>
                @endif
            @endforeach
        @endforeach

        @if (auth()->user()->role->slug == 'super-admin')
            <li class="menu-label">System</li>

            <li {{ Route::currentRouteName() == 'backend.setting-view' ? 'class=mm-active' : '' }}>
                <a href="{{ route('backend.setting-view', ['type' => 'branding']) }}">
                    <div class="parent-icon">
                        <i class="bi bi-gear"></i>
                    </div>
                    <div class="menu-title">Web Setting</div>
                </a>
            </li>

            <li>
                <a href="{{ route('backend.setting-clear_cache') }}">
                    <div class="parent-icon">
                        <i class="bi bi-gear"></i>
                    </div>
                    <div class="menu-title">Clear Cache</div>
                </a>
            </li>
        @endif



    </ul>
    <!--end navigation-->
</aside>
