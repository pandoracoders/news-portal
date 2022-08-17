<header>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">

            <div class="d-flex">
                <button class="navbar-toggler btn-menu d-block" id="sidebarBtnOpen" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="fa-solid fa-align-left menu-icon"></i>
                    </span>
                </button>
                <a href="{{ url('/') }}" class="ml-3 brand-logo d-none" id="navScroll-btn">
                    {{ getSettingValue('website_title') }}
                </a>
            </div>

            <a href="{{ url('/') }}" class="navbar-brand d-lg">
                {{ getSettingValue('website_title') }}
            </a>

            @php
                $current_url = isset($article) ? route('singleArticle', ['slug' => $article->category->slug]) : Request::url();
            @endphp

            <div class="collapse navbar-collapse d-none d-lg-block" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto text-uppercase">
                    <li class="nav-item">
                        <a class="nav-link {{ $current_url == url('/') ? 'active' : '' }}"
                            href="{{ url('/') }}">Home</a>
                    </li>
                    @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link {{ $current_url == route('singleArticle', ['slug' => $category->slug]) ? 'active' : '' }}"
                                href="{{ route('singleArticle', ['slug' => $category->slug]) }}">
                                {{ $category->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="sidebar" id="sidebar">
                <div class="d-flex justify-content-end">
                    <div class="sidebar__btn-close" id="sidebarBtnClose">
                        <i class="fa-solid fa-xmark cros-icon"></i>
                    </div>
                </div>
                <ul class="pt-3 pt-lg-0 nav-menu menu">
                    <li class="nav-item">
                        <a class="nav-link {{ $current_url == url('/') ? 'active' : '' }}"
                            href="{{ url('/') }}">Home</a>
                    </li>

                    @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link {{ $current_url == route('singleArticle', ['slug' => $category->slug]) ? 'active' : '' }}"
                                href="{{ route('singleArticle', ['slug' => $category->slug]) }}">
                                {{ $category->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="sub">
                    <ul class="sub-menu">

                        @forelse (getSettingType("pages") as $page)
                            <li class="nav-item">
                                <a href="{{ route('singleArticle', $page->key) }}"
                                    class="nav-link">{{ unSlug($page->key) }}</a>
                            </li>
                        @empty
                        @endforelse

                    </ul>
                </div>
                <!-- sidebar social links -->
                <div class="links side-links mt-3">
                    @forelse (getSettingType("social-media") as $media)
                        <a href="{{ $media->value }}">
                            <i class="fa-brands fa-{{ $media->key }}"></i>
                        </a>
                    @empty
                    @endforelse

                </div>

            </div>

            <div class="search">
                <i class="fa-solid fa-magnifying-glass" id="search-label"></i>
            </div>

            <div id="searchcontainer">

                <script async src="https://cse.google.com/cse.js?cx=9eee22d27b4343c6a"></script>

                <div class="gcse-search"></div>

                <div class="closeSearch" id="closeSearch">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </div>
        </div>
    </nav>
</header>
