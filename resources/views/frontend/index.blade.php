<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>
    <meta name="description" content="">
    <meta name="theme-color" content="#db3434">
    <meta name="msapplication-navbutton-color" content="#db3434">
    <meta name="apple-mobile-web-app-status-bar-style" content="#db3434">
    <meta name="article:author" content="">
    <meta name="article:published_time" content="">
    <meta property="og:site_name" content="">
    <meta property="og:type" content="">
    <meta property="og:title" content="">
    <meta property="og:article:published_time" content="">
    <meta property="og:description" content="">
    <meta property="og:image" content="">
    <meta property="og:image:alt" content="">
    <meta property="twitter:title" content="">
    <meta property="twitter:description" content="">
    <meta property="twitter:domain" content="">
    <meta property="twitter:image" content="">
    <link href="" rel="canonical">

    <style>
        body a {
            color: #111;
        }
    </style>


    <link rel="stylesheet" href="{{ asset('frontend') }}/css/splide.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/style.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/style1.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <meta name="atdlayout" content="home">
</head>

<body>

    <header>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg">
            <div class="container">

                <div class="d-flex">
                    <button class="navbar-toggler btn-menu d-block" id="sidebarBtnOpen" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                            <a class="nav-link" href="/">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Category 1
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Category 1
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Category 1
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Category 1
                            </a>
                        </li>

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
                            <a class="nav-link" href="/">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Category on sidebar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Category on sidebar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Category on sidebar
                            </a>
                        </li>
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


    <div class="sidebar-overlay"></div>
    <div id="headerAd" class="adver container text-center">
    </div>
    <main class="container">
        <!-- Slider -->
        <section id="glider" class="my-2">
            <div class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide">
                            <figure class="slider-image">
                                <a href="#">
                                    <img src="/src/images/1.jpg" alt="" class="slider-image-img img-fluid">
                                </a>
                                <p class="article-date">
                                    Jan 20, 2022
                                </p>|
                                <p class="article-author">Author</p>
                                <p class="slider-category">
                                    Slider Category
                                </p>
                                <p class="slider-title">
                                    Sometimes title of the article might exceed the boundary so we need to check what happens in that case;
                                </p>
                            </figure>
                        </li>
                        <li class="splide__slide">
                            <figure class="slider-image">
                                <a href="#">
                                    <img src="/src/images/1.jpg" alt="" class="slider-image-img img-fluid">
                                </a>
                                <p class="slider-category">
                                    Slider Category
                                </p>
                                <p class="article-date">
                                    Jan 20, 2022
                                </p>|
                                <p class="article-author">Author</p>
                                <p class="slider-title">
                                    Sometimes title of the article
                                </p>
                            </figure>
                        </li>
                        <li class="splide__slide">
                            <figure class="slider-image">
                                <a href="#">
                                    <img src="/src/images/3.jpg" alt="" class="slider-image-img img-fluid">
                                </a>
                                <p class="slider-category">
                                    Slider Category
                                </p><p class="article-date">
                                    Jan 20, 2022
                                </p>|
                                <p class="article-author">Author</p>
                                <p class="slider-title">
                                    Sometimes title of the article might exceed the boundary 
                                </p>
                            </figure>
                        </li>
                        <li class="splide__slide">
                            <figure class="slider-image">
                                <a href="#">
                                    <img src="/src/images/6.jpg" alt="" class="slider-image-img img-fluid">
                                </a>
                                <p class="slider-category">
                                    Slider Category
                                </p>
                                <p class="article-date">
                                    Jan 20, 2022
                                </p>|
                                <p class="article-author">Author</p>
                                <p class="slider-title">
                                    Sometimes title of the article might exceed
                            </figure>
                        </li>
                        <li class="splide__slide">
                            <figure class="slider-image">
                                <a href="#">
                                    <img src="/src/images/9.jpg" alt="" class="slider-image-img img-fluid">
                                </a>
                                <p class="slider-category">
                                    Slider Category
                                </p>
                                <p class="article-date">
                                    Jan 20, 2022
                                </p>|
                                <p class="article-author">Author</p>
                                <p class="slider-title">
                                    Sometimes title of the 
                                </p>
                            </figure>
                        </li>                        
                    </ul>
                </div>
            </div>
        </section>

        <!-- Biography Section -->
        <section class="row outer-section">
            <div class="col-md-8 mt-4">
                <div class="heading">
                    <div class="category-segment">
                        <span>Biography</span>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="biography-left col-md-6">
                        <div class="biography-single">
                            <div class="col-4 image">
                                <figure class="m-0">
                                    <a href="#">
                                        <img src="/src/images/6.jpg" alt="" class="image_img img-fluid">
                                    </a>
                                </figure>
                            </div>
                            <div class="col-8 biography-title">
                                <p class="article-date">Jan 25, 2022</p>|<p class="article-author">Author</p>
                                <h2>This is the title for biography and to check how long the text goes into the title
                                    section
                                </h2>
                            </div>
                        </div>
                        <div class="biography-single">
                            <div class="col-4 image">
                                <figure class="m-0">
                                    <a href="#">
                                        <img src="/src/images/7.jpg" alt="" class="image_img img-fluid">
                                    </a>
                                </figure>
                            </div>
                            <div class="col-8 biography-title">
                                <p class="article-date">Jan 25, 2022</p>|<p class="article-author">Author</p>

                                <h2>This is the title for biography and to check how long the text goes into the title
                                    section
                                </h2>
                            </div>
                        </div>
                        <div class="biography-single">
                            <div class="col-4 image">
                                <figure class="m-0">
                                    <a href="#">
                                        <img src="/src/images/8.jpg" alt="" class="image_img img-fluid">
                                    </a>
                                </figure>
                            </div>
                            <div class="col-8 biography-title">
                                <p class="article-date">Jan 25, 2022</p>|<p class="article-author">Author</p>

                                <h2>This is the title for biography and to check how long the text goes into the title
                                    section
                                </h2>
                            </div>
                        </div>
                        <div class="biography-single">
                            <div class="col-4 image">
                                <figure class="m-0">
                                    <a href="#">
                                        <img src="/src/images/9.jpg" alt="" class="image_img img-fluid">
                                    </a>
                                </figure>
                            </div>
                            <div class="col-8 biography-title">
                                <p class="article-date">Jan 25, 2022</p>|<p class="article-author">Author</p>

                                <h2>This is the title for biography and to check how long the text goes into the title
                                    section
                                </h2>
                            </div>
                        </div>
                        <div class="biography-single">
                            <div class="col-4 image">
                                <figure class="m-0">
                                    <a href="#">
                                        <img src="/src/images/10.jpg" alt="" class="image_img img-fluid">
                                    </a>
                                </figure>
                            </div>
                            <div class="col-8 biography-title">
                                <p class="article-date">Jan 25, 2022</p>|<p class="article-author">Author</p>

                                <h2>This is the title for biography and to check how long the text goes into the title
                                    section
                                </h2>
                            </div>
                        </div>
                        <div class="biography-single">
                            <div class="col-4 image">
                                <figure class="m-0">
                                    <a href="#">
                                        <img src="/src/images/11.jpg" alt="" class="image_img img-fluid">
                                    </a>
                                </figure>
                            </div>
                            <div class="col-8 biography-title">
                                <p class="article-date">Jan 25, 2022</p>|<p class="article-author">Author</p>
                                <h2>This is the title for biography and to check how long the text goes into the title
                                    section
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="biography-right col-md-6">
                        <figure class="textover">
                            <a href="#">
                                <img src="/src/images/6.jpg" alt="" class="image_img img-fluid">
                            </a>
                            <figcaption>Here goes the title</figcaption>
                        </figure>
                        <figure class="textover">
                            <a href="#">
                                <img src="/src/images/7.jpg" alt="" class="image_img img-fluid">
                            </a>
                            <figcaption>Here goes the title</figcaption>
                        </figure>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-center load">
                            <a href="/biography" class="btn">View All</a>
                        </h2>
                    </div>
                </div>
            </div>
            <!-- Trending Section -->
            <div class="col-md-4 mt-4">
                <div class="heading">
                    <div class="category-segment">
                        <span>Trending</span>
                    </div>
                </div>
                <div class="trending mt-3">
                    <div class="trending-single">
                        <div class="image">
                            <figure class="m-0">
                                <a href="#">
                                    <img src="/src/images/1.jpg" alt="" class="image_img img-fluid">
                                </a>
                            </figure>
                        </div>
                        <div class="trending-title">
                            <p class="article-date">Jan 25, 2022</p>|<p class="article-author">Author</p>

                            <h2>This is the title for trending and to check how long the text goes into the title
                                section
                            </h2>
                        </div>
                    </div>
                    <div class="trending-single">
                        <div class="image">
                            <figure class="m-0">
                                <a href="#">
                                    <img src="/src/images/2.jpg" alt="" class="image_img img-fluid">
                                </a>
                            </figure>
                        </div>
                        <div class="trending-title">
                            <p class="article-date">Jan 25, 2022</p>|<p class="article-author">Author</p>

                            <h2>This is the title for trending and to check how long the text goes into the title
                                section
                            </h2>
                        </div>
                    </div>
                    <div class="trending-single">
                        <div class="image">
                            <figure class="m-0">
                                <a href="#">
                                    <img src="/src/images/3.jpg" alt="" class="image_img img-fluid">
                                </a>
                            </figure>
                        </div>
                        <div class="trending-title">
                            <p class="article-date">Jan 25, 2022</p>|<p class="article-author">Author</p>

                            <h2>This is the title for trending and to check how long the text goes into the title
                                section
                            </h2>
                        </div>
                    </div>
                    <div class="trending-single">
                        <div class="image">
                            <figure class="m-0">
                                <a href="#">
                                    <img src="/src/images/4.jpg" alt="" class="image_img img-fluid">
                                </a>
                            </figure>
                        </div>
                        <div class="trending-title">
                            <p class="article-date">Jan 25, 2022</p>|<p class="article-author">Author</p>

                            <h2>This is the title for trending and to check how long the text goes into the title
                                section
                            </h2>
                        </div>
                    </div>
                    <div class="trending-single">
                        <div class="image">
                            <figure class="m-0">
                                <a href="#">
                                    <img src="/src/images/5.jpg" alt="" class="image_img img-fluid">
                                </a>
                            </figure>
                        </div>
                        <div class="trending-title">
                            <p class="article-date">Jan 25, 2022</p>|<p class="article-author">Author</p>

                            <h2>This is the title for trending and to check how long the text goes into the title
                                section
                            </h2>
                        </div>
                    </div>
                    <div class="trending-single">
                        <div class="image">
                            <figure class="m-0">
                                <a href="#">
                                    <img src="/src/images/6.jpg" alt="" class="image_img img-fluid">
                                </a>
                            </figure>
                        </div>
                        <div class="trending-title">
                            <p class="article-date">Jan 25, 2022</p>|<p class="article-author">Author</p>

                            <h2>This is the title for trending and to check how long the text goes into the title
                                section
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Entertainment Section  -->
        <section class="row outer-section">
            <div class="col-md-8 mt-4">
                <div class="heading">
                    <div class="category-segment">
                        <span>Entertainment</span>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="entertainment-left col-md-6">
                        <div class="entertainment-single">
                            <div class="col-4 image">
                                <figure class="m-0">
                                    <a href="#">
                                        <img src="/src/images/6.jpg" alt="" class="image_img img-fluid">
                                    </a>
                                </figure>
                            </div>
                            <div class="col-8 entertainment-title">
                                <p class="article-date">Jan 25, 2022</p>|<p class="article-author">Author</p>

                                <h2>This is the title for entertainment and to check how long the text goes into the title
                                    section
                                </h2>
                            </div>
                        </div>
                        <div class="entertainment-single">
                            <div class="col-4 image">
                                <figure class="m-0">
                                    <a href="#">
                                        <img src="/src/images/7.jpg" alt="" class="image_img img-fluid">
                                    </a>
                                </figure>
                            </div>
                            <div class="col-8 entertainment-title">
                                <p class="article-date">Jan 25, 2022</p>|<p class="article-author">Author</p>

                                <h2>This is the title for entertainment and to check how long the text goes into the title
                                    section
                                </h2>
                            </div>
                        </div>
                        <div class="entertainment-single">
                            <div class="col-4 image">
                                <figure class="m-0">
                                    <a href="#">
                                        <img src="/src/images/8.jpg" alt="" class="image_img img-fluid">
                                    </a>
                                </figure>
                            </div>
                            <div class="col-8 entertainment-title">
                                <p class="article-date">Jan 25, 2022</p>|<p class="article-author">Author</p>

                                <h2>This is the title for entertainment and to check how long the text goes into the title
                                    section
                                </h2>
                            </div>
                        </div>
                        <div class="entertainment-single">
                            <div class="col-4 image">
                                <figure class="m-0">
                                    <a href="#">
                                        <img src="/src/images/9.jpg" alt="" class="image_img img-fluid">
                                    </a>
                                </figure>
                            </div>
                            <div class="col-8 entertainment-title">
                                <p class="article-date">Jan 25, 2022</p>|<p class="article-author">Author</p>

                                <h2>This is the title for entertainment and to check how long the text goes into the title
                                    section
                                </h2>
                            </div>
                        </div>
                        <div class="entertainment-single">
                            <div class="col-4 image">
                                <figure class="m-0">
                                    <a href="#">
                                        <img src="/src/images/10.jpg" alt="" class="image_img img-fluid">
                                    </a>
                                </figure>
                            </div>
                            <div class="col-8 entertainment-title">
                                <p class="article-date">Jan 25, 2022</p>|<p class="article-author">Author</p>

                                <h2>This is the title for entertainment and to check how long the text goes into the title
                                    section
                                </h2>
                            </div>
                        </div>
                        <div class="entertainment-single">
                            <div class="col-4 image">
                                <figure class="m-0">
                                    <a href="#">
                                        <img src="/src/images/11.jpg" alt="" class="image_img img-fluid">
                                    </a>
                                </figure>
                            </div>
                            <div class="col-8 entertainment-title">
                                <p class="article-date">Jan 25, 2022</p>|<p class="article-author">Author</p>

                                <h2>This is the title for entertainment and to check how long the text goes into the title
                                    section
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="entertainment-right col-md-6">
                        <figure class="textover">
                            <a href="#">
                                <img src="/src/images/6.jpg" alt="" class="image_img img-fluid">
                            </a>
                            <figcaption>Here goes the title</figcaption>
                        </figure>
                        <figure class="textover">
                            <a href="#">
                                <img src="/src/images/7.jpg" alt="" class="image_img img-fluid">
                            </a>
                            <figcaption>Here goes the title</figcaption>
                        </figure>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-center load">
                            <a href="/biography" class="btn">View All</a>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-4">
                <div class="heading">
                    <div class="category-segment">
                        <span>Just Published</span>
                    </div>
                </div>
                <div class="trending my-3">
                    <div class="trending-single">
                        <div class="image">
                            <figure class="m-0">
                                <a href="#">
                                    <img src="/src/images/1.jpg" alt="" class="image_img img-fluid">
                                </a>
                            </figure>
                        </div>
                        <div class="trending-title">
                            <p class="article-date">Jan 25, 2022</p>|<p class="article-author">Author</p>

                            <h2>This is the title for trending and to check how long the text goes into the title
                                section
                            </h2>
                        </div>
                    </div>
                    <div class="trending-single">
                        <div class="image">
                            <figure class="m-0">
                                <a href="#">
                                    <img src="/src/images/2.jpg" alt="" class="image_img img-fluid">
                                </a>
                            </figure>
                        </div>
                        <div class="trending-title">
                            <p class="article-date">Jan 25, 2022</p>|<p class="article-author">Author</p>

                            <h2>This is the title for trending and to check how long the text goes into the title
                                section
                            </h2>
                        </div>
                    </div>
                    <div class="trending-single">
                        <div class="image">
                            <figure class="m-0">
                                <a href="#">
                                    <img src="/src/images/3.jpg" alt="" class="image_img img-fluid">
                                </a>
                            </figure>
                        </div>
                        <div class="trending-title">
                            <p class="article-date">Jan 25, 2022</p>|<p class="article-author">Author</p>

                            <h2>This is the title for trending and to check how long the text goes into the title
                                section
                            </h2>
                        </div>
                    </div>
                    <div class="trending-single">
                        <div class="image">
                            <figure class="m-0">
                                <a href="#">
                                    <img src="/src/images/4.jpg" alt="" class="image_img img-fluid">
                                </a>
                            </figure>
                        </div>
                        <div class="trending-title">
                            <p class="article-date">Jan 25, 2022</p>|<p class="article-author">Author</p>

                            <h2>This is the title for trending and to check how long the text goes into the title
                                section
                            </h2>
                        </div>
                    </div>
                    <div class="trending-single">
                        <div class="image">
                            <figure class="m-0">
                                <a href="#">
                                    <img src="/src/images/5.jpg" alt="" class="image_img img-fluid">
                                </a>
                            </figure>
                        </div>
                        <div class="trending-title">
                            <p class="article-date">Jan 25, 2022</p>|<p class="article-author">Author</p>

                            <h2>This is the title for trending and to check how long the text goes into the title
                                section
                            </h2>
                        </div>
                    </div>
                    <div class="trending-single">
                        <div class="image">
                            <figure class="m-0">
                                <a href="#">
                                    <img src="/src/images/6.jpg" alt="" class="image_img img-fluid">
                                </a>
                            </figure>
                        </div>
                        <div class="trending-title">
                            <p class="article-date">Jan 25, 2022</p>|<p class="article-author">Author</p>

                            <h2>This is the title for trending and to check how long the text goes into the title
                                section
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- Genral Born Today Section -->

        
        <section class="row outer-section">
            <div class="heading mt-4 mb-4">
                <div class="category-segment">
                    <span>Born Today</span>
                </div>
            </div>
           
                <div class="col-md-4">
                    <figure class="textover">
                        <a href="#">
                            <img src="/src/images/6.jpg" alt="" class="image_img img-fluid">
                        </a>
                        <figcaption>Here goes the title</figcaption>
                        <div class="image_overlay">
                            <div class="image_title">
                                Here goes the title of the image
                            </div>
                            <p class="image_description">
                                This is the field where we would be putting the description of the image while we hover over the image itself.
                            </p>
                        </div>
                    </figure>
                </div>
                <div class="col-md-4">
                    <figure class="textover">
                        <a href="#">
                            <img src="/src/images/5.jpg" alt="" class="image_img img-fluid">
                        </a>
                        <figcaption>Here goes the title</figcaption>
                        <div class="image_overlay">
                            <div class="image_title">
                                Here goes the title of the image
                            </div>
                            <p class="image_description">
                                This is the field where we would be putting the description of the image while we hover over the image itself.
                            </p>
                        </div>
                    </figure>
                </div>
                <div class="col-md-4">
                    <figure class="textover">
                        <a href="#">
                            <img src="/src/images/3.jpg" alt="" class="image_img img-fluid">
                        </a>
                        <figcaption>Here goes the title</figcaption>
                        <div class="image_overlay">
                            <div class="image_title">
                                Here goes the title of the image
                            </div>
                            <p class="image_description">
                                This is the field where we would be putting the description of the image while we hover over the image itself.
                            </p>
                        </div>
                    </figure>
                </div>
                <div class="col-md-4">
                    <figure class="textover">
                        <a href="#">
                            <img src="/src/images/8.jpg" alt="" class="image_img img-fluid">
                        </a>
                        <figcaption>Here goes the title</figcaption>
                        <div class="image_overlay">
                            <div class="image_title">
                                Here goes the title of the image
                            </div>
                            <p class="image_description">
                                This is the field where we would be putting the description of the image while we hover over the image itself.
                            </p>
                        </div>
                    </figure>
                </div>
                <div class="col-md-4">
                    <figure class="textover">
                        <a href="#">
                            <img src="/src/images/11.jpg" alt="" class="image_img img-fluid">
                        </a>
                        <figcaption>Here goes the title</figcaption>
                        <div class="image_overlay">
                            <div class="image_title">
                                Here goes the title of the image
                            </div>
                            <p class="image_description">
                                This is the field where we would be putting the description of the image while we hover over the image itself.
                            </p>
                        </div>
                    </figure>
                </div>
                <div class="col-md-4">
                    <figure class="textover">
                        <a href="#">
                            <img src="/src/images/1.jpg" alt="" class="image_img img-fluid">
                        </a>
                        <figcaption>Here goes the title</figcaption>
                        <div class="image_overlay">
                            <div class="image_title">
                                Here goes the title of the image
                            </div>
                            <p class="image_description">
                                This is the field where we would be putting the description of the image while we hover over the image itself.
                            </p>
                        </div>
                    </figure>
                </div>
          
        </section>
       
        <!-- General Died Today Section -->

        <section class="row outer-section">
            <div class="heading mt-4 mb-4">
                <div class="category-segment">
                    <span>Died Today</span>
                </div>
            </div>
           
                <div class="col-md-4">
                    <figure class="textover">
                        <a href="#">
                            <img src="/src/images/9.jpg" alt="" class="image_img img-fluid">
                        </a>
                        <figcaption>Here goes the title</figcaption>
                        <div class="image_overlay">
                            <div class="image_title">
                                Here goes the title of the image
                            </div>
                            <p class="image_description">
                                This is the field where we would be putting the description of the image while we hover over the image itself.
                            </p>
                        </div>
                    </figure>
                </div>
                <div class="col-md-4">
                    <figure class="textover">
                        <a href="#">
                            <img src="/src/images/10.jpg" alt="" class="image_img img-fluid">
                        </a>
                        <figcaption>Here goes the title</figcaption>
                        <div class="image_overlay">
                            <div class="image_title">
                                Here goes the title of the image
                            </div>
                            <p class="image_description">
                                This is the field where we would be putting the description of the image while we hover over the image itself.
                            </p>
                        </div>
                    </figure>
                </div>
                <div class="col-md-4">
                    <figure class="textover">
                        <a href="#">
                            <img src="/src/images/7.jpg" alt="" class="image_img img-fluid">
                        </a>
                        <figcaption>Here goes the title</figcaption>
                        <div class="image_overlay">
                            <div class="image_title">
                                Here goes the title of the image
                            </div>
                            <p class="image_description">
                                This is the field where we would be putting the description of the image while we hover over the image itself.
                            </p>
                        </div>
                    </figure>
                </div>
                <div class="col-md-4">
                    <figure class="textover">
                        <a href="#">
                            <img src="/src/images/4.jpg" alt="" class="image_img img-fluid">
                        </a>
                        <figcaption>Here goes the title</figcaption>
                        <div class="image_overlay">
                            <div class="image_title">
                                Here goes the title of the image
                            </div>
                            <p class="image_description">
                                This is the field where we would be putting the description of the image while we hover over the image itself.
                            </p>
                        </div>
                    </figure>
                </div>
                <div class="col-md-4">
                    <figure class="textover">
                        <a href="#">
                            <img src="/src/images/1.jpg" alt="" class="image_img img-fluid">
                        </a>
                        <figcaption>Here goes the title</figcaption>
                        <div class="image_overlay">
                            <div class="image_title">
                                Here goes the title of the image
                            </div>
                            <p class="image_description">
                                This is the field where we would be putting the description of the image while we hover over the image itself.
                            </p>
                        </div>
                    </figure>
                </div>
                <div class="col-md-4">
                    <figure class="textover">
                        <a href="#">
                            <img src="/src/images/7.jpg" alt="" class="image_img img-fluid">
                        </a>
                        <figcaption>Here goes the title</figcaption>
                        <div class="image_overlay">
                            <div class="image_title">
                                Here goes the title of the image
                            </div>
                            <p class="image_description">
                                This is the field where we would be putting the description of the image while we hover over the image itself.
                            </p>
                        </div>
                    </figure>
                </div>
          
        </section>

    </main>

    <div id="footerAd" class="adver container text-center">
    </div>

    <!-- Footer -->
    <footer class="footer-section">
        <div class="footer-content pt-3 pb-3">
            <div class="row">
                <div class="col-lg-4 mb-50 d-none d-lg-block">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <h2>
                                <a href="/">
                                    Website Name
                                </a>
                            </h2>
                        </div>
                        <div class="footer-social-icon">
                            <span>Follow us</span>
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
                </div>
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="footer-widget">
                        <div class="footer-widget-heading">
                            <h3><span>Useful Links</span></h3>
                        </div>
                        <ul class="d-flex d-md-block">
                            <li><a href="#">Home</a></li>
                            <li>
                                <a href="#">
                                    Category in footer
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Category in footer
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Category in footer
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Category in footer
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-50">
                    <div class="footer-widget">
                        <div class="footer-widget-heading">
                            <h3><span>Subscribe</span></h3>
                        </div>
                        <div class="footer-text mb-25 d-none d-lg-block">
                            <p>Don’t miss to subscribe to our new feeds, kindly fill the form below.</p>
                        </div>
                        <div class="subscribe-form">
                            <input type="text" placeholder="Email Address" id="subscribeEmail">
                            <button type="submit" id="subscriptionButton"><i class="fa-regular fa-paper-plane"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 text-center text-lg-left">
                        <div class="copyright-text">
                            <p>Copyright &copy; 2021, All Right Reserved <a>Website Name</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back To Top Button -->
    <button onclick="topFunction()" id="myBtn" title="Go to top">
        <i class="fa-solid fa-arrow-up"></i>
    </button>


    <!-- Bootstrap JS -->
    <script src="{{ asset('frontend') }}/js/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('frontend') }}/js/script.js"></script>
    
        <script src="{{ asset('frontend') }}/js/splide.min.js"></script>
        <script>
            new Splide('.splide', {
                type: 'loop',
                perPage: 4,
                gap: '5px',
                autoplay: true,
                perMove: 1,
                breakpoints: {

                    '820': {
                        perPage: 2,
                        gap: '10px',
                    },
                    '480': {
                        perPage: 1,
                        gap: '10px'
                    }
                }
            }).mount();
        </script>
</body>

</html>