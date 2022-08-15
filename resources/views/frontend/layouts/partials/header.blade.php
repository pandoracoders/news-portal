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
                <a href="/" class="ml-3 brand-logo d-none" id="navScroll-btn">Website<span
                        class="colored">Name</span>
                </a>
            </div>

            <a href="/" class="navbar-brand d-lg">
                Website Name
            </a>

            <div class="collapse navbar-collapse d-none d-lg-block" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto text-uppercase">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('singleArticle', ['slug' => $category->slug]) }}">
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
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>

                    @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('singleArticle', ['slug' => $category->slug]) }}">
                                {{ $category->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="sub">
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="#" class="nav-link">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Advertise</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Privacy Policy</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Terms Conditions</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="Ads" class="nav-link">Ads</a>
                        </li> -->
                    </ul>
                </div>
                <!-- sidebar social links -->
                <div class="links side-links mt-3">
                    <a href="#">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                    <a href="#">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="#">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                </div>

            </div>

            <div class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
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
