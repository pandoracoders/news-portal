<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>

    @include('frontend.layouts.partials.head')

    <link rel="stylesheet" href="{{ asset('frontend') }}/css/splide.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/style.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/style1.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <meta name="atdlayout" content="home">


    <style>
        body a {
            color: #111;
        }

       
    </style>
</head>

<body>

    @include("frontend.layouts.partials.header")

    <div class="sidebar-overlay"></div>
    <div id="headerAd" class="adver container text-center">
    </div>
    <main class="container">
        @yield('content')

    </main>

    <div id="footerAd" class="adver container text-center">
    </div>

    <!-- Footer -->
    @include('frontend.layouts.partials.footer')

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
