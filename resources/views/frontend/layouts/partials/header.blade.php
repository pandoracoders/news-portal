@php
    $parentCategories = [];
    $childCategories = [];
    $soloCategories = [];

    foreach ($categories as $category){
        foreach ($categories as $cat){
            if ($category->id == $cat->parent_id){
                array_push($parentCategories, $category);
                break;
            }
        }
        if($category->parent_id == null){
            array_push($soloCategories, $category);
        }else{
            array_push($childCategories, $category);
        }
    }
    $soloCategories = array_diff($soloCategories, $parentCategories);

@endphp
<header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <div class="d-flex">
                <button class="navbar-toggler btn-menu d-block" id="sidebarBtnOpen" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon" style="">
                        <i class="fa-solid fa-align-left menu-icon"></i>
                    </span>
                </button>
                <a href="{{ url('/') }}" class="ml-3 brand-logo d-none" id="navScroll-btn">
                    {{ getSettingValue('website_title') }}
                </a>
            </div>

            <a href="{{ url('/') }}" class="navbar-brand d-lg" style="padding-bottom: 15px">
               <img src=" {{ asset(getSettingValue('logo')) }}" height="50" width="150" alt="">
            </a>
            @php
                $current_url = isset($article) ? route('singleArticle', ['slug' => $article->category?->slug ?? 'nu']) : Request::url();
            @endphp

            <div class="collapse navbar-collapse d-none d-lg-block menu-items" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto text-uppercase">
                    <li class="nav-item">
                        <a class="nav-link {{ $current_url == url('/') ? 'active' : '' }}"
                            href="{{ url('/') }}">Home</a>
                    </li>
                    @foreach ($soloCategories as $category)
                        <li class="nav-item">
                            <a class="nav-link {{ $current_url == route('singleArticle', ['slug' => $category->slug]) ? 'active' : '' }}"
                                href="{{ route('singleArticle', ['slug' => $category->slug]) }}">
                                {{ $category->title }}
                            </a>
                        </li>
                    @endforeach
                    @foreach ($parentCategories as $cat)
                        <li class="nav-item">

                            <div class="nav-link parent">
                                {{ $cat->title }} <i style="font-size:18px;" class="fa-solid fa-caret-down">
                                 </i>
                                 <ul class="dropdown-list">
                                    @foreach ($childCategories as $c)
                                        @if ($cat->id == $c->parent_id)
                                            <li >
                                                <a class=" {{ $current_url == route('singleArticle', ['slug' => $c->slug]) ? 'active' : '' }}"
                                                    href="{{ route('singleArticle', ['slug' => $c->slug]) }}">
                                                    {{ $c->title }}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>


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

                    @foreach ($soloCategories as $category)
                        <li class="nav-item">
                            <a class="nav-link {{ $current_url == route('singleArticle', ['slug' => $category->slug]) ? 'active' : '' }}"
                                href="{{ route('singleArticle', ['slug' => $category->slug]) }}">
                                {{ $category->title }}
                            </a>
                        </li>
                    @endforeach
                    @foreach ($parentCategories as $cat)
                        <li class="nav-item">
                            <span id="{{ $cat->slug }}" class="nav-link dropdown-trigger text-uppercase">
                                {{ $cat->title }} <i style="font-size:18px;" class="fa-solid fa-caret-down"></i>
                            </span>
                            <ul class="dropdown-mobile text-uppercase">
                                @foreach ($childCategories as $c)
                                    @if ($cat->id == $c->parent_id)
                                        <li >
                                            <a class=""
                                                href="{{ route('singleArticle', ['slug' => $c->slug]) }}">
                                                {{ $c->title }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
                <div class="sub">
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="/about-us" class="nav-link">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="/contact-us" class="nav-link">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a href="/privacy-policy" class="nav-link">Privacy Policy</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">Terms Conditions</a>
                        </li> --}}
                        <!-- <li class="nav-item">
                            <a href="Ads" class="nav-link">Ads</a>
                        </li> -->
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
                <div id="search-container">
                    <form action="/search/" method="get">
                        <input type="text" name="q" id="" class="form-control search-box">
                        <span class="close-search">X</span>
                    </form>
                </div>
            </div>

        </div>
    </nav>
</header>

