<header class="top-header">
    <nav class="navbar navbar-expand gap-3">
        <div class="mobile-menu-button">
            <i class="bi bi-list"></i>
        </div>

        <div class="top-navbar-right ms-auto">

            <ul class="navbar-nav align-items-center">

                <li class="nav-item">
                    <a class="nav-link" href="javascript:;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling"
                        aria-controls="offcanvasScrolling">
                        <div class="">
                            <i class="bi bi-gear"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item dropdown dropdown-large">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                        data-bs-toggle="dropdown">
                        <div class="position-relative">
                            <span class="notify-badge">{{ auth()->user()->unreadNotifications()->count() }}</span>
                            <i class="bi bi-bell"></i>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="javascript:;">
                            <div class="msg-header">
                                <p class="msg-header-title">Notifications</p>
                                <p class="msg-header-clear ms-auto">Marks all as read</p>
                            </div>
                        </a>
                        <div class="header-notifications-list">
                            @foreach (auth()->user()->notifications as $notification)
                                {{-- {{ dd($notification) }} --}}
                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div class="notify">
                                            <i class="bi bi-person"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name"> {{ $notification->data['title'] }} <span
                                                    class="msg-time float-end">14 Sec
                                                    ago</span></h6>
                                            <p class="msg-info">{{ $notification->data["body"] }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach

                        </div>
                        <a href="javascript:;">
                            <div class="text-center msg-footer">View All Notifications</div>
                        </a>
                    </div>
                </li>

                <li class="nav-item dropdown dropdown-user-setting">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                        data-bs-toggle="dropdown">
                        <div class="user-setting">
                            <img src="https://via.placeholder.com/110X110/212529/fff" class="user-img" alt="">
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="javascript:;">
                                <div class="d-flex flex-row align-items-center gap-2">
                                    <img src="https://via.placeholder.com/110X110/212529/fff" alt=""
                                        class="rounded-circle" width="54" height="54">
                                    <div class="">
                                        <h6 class="mb-0 dropdown-user-name">{{ auth()->user()->name ?? '' }}</h6>

                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item" href="{{ route("logout") }}">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <ion-icon name="log-out-outline"></ion-icon>
                                    </div>
                                    <div class="ms-3"><span>Logout</span></div>
                                </div>
                            </a>
                        </li>
                        
                    </ul>
                </li>

            </ul>

        </div>
    </nav>
</header>
