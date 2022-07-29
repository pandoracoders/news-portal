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

        <li class="menu-label">Sections</li>

        <li>
            <a href="{{ route('backend.category-list') }}">
                <div class="parent-icon">
                    <i class="bi bi-house-door"></i>
                </div>
                <div class="menu-title">category</div>
            </a>
        </li>

        <li>
            <a href="{{ route('backend.tag-list') }}">
                <div class="parent-icon">
                    <i class="bi bi-house-door"></i>
                </div>
                <div class="menu-title">tag</div>
            </a>
        </li>

        <li>
            <a href="{{ route('backend.table_set-list') }}">
                <div class="parent-icon">
                    <i class="bi bi-house-door"></i>
                </div>
                <div class="menu-title">table_set</div>
            </a>
        </li>

        <li>
            <a href="{{ route('backend.article_title-list') }}">
                <div class="parent-icon">
                    <i class="bi bi-house-door"></i>
                </div>
                <div class="menu-title">article_title</div>
            </a>
        </li>

        <li>
            <a href="{{ route('backend.article-list') }}">
                <div class="parent-icon">
                    <i class="bi bi-house-door"></i>
                </div>
                <div class="menu-title">article</div>
            </a>
        </li>

        <li class="menu-label">System Settings</li>

        <li>
            <a href="{{ route('backend.role-list') }}">
                <div class="parent-icon">
                    <i class="bi bi-house-door"></i>
                </div>
                <div class="menu-title">role</div>
            </a>
        </li>

        <li>
            <a href="{{ route('backend.user-list') }}">
                <div class="parent-icon">
                    <i class="bi bi-house-door"></i>
                </div>
                <div class="menu-title">user</div>
            </a>
        </li>

    </ul>
    <!--end navigation-->
</aside>
