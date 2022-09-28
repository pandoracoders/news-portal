<!DOCTYPE html>
<html lang="en">

<head>
    {!! getSettingValue('google_tag_manager_code') !!}
    {!! getSettingValue('google_analytics_code') !!}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{ asset(getSettingValue('favicon')) }}" sizes="64x64">

    @include('frontend.layouts.partials.head')
    @stack('styles')
    {!! getSettingValue('org_schema') !!}
    @stack('schema')
    <style>
        body a {
            color: #111;
        }

        p {
            text-align: justify !important;
        }

        @media(max-width: 480px) {
            p {
                text-align: left !important;
            }
        }

        #search-container {
            position: fixed;
            /* Sit on top of the page content */
            display: none;
            /* Hidden by default */
            width: 100%;
            /* Full width (cover the whole page) */
            height: 100%;
            /* Full height (cover the whole page) */
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgb(75, 73, 73);
            /* Black background with opacity */
            z-index: 20;
            /* Specify a stack order in case you're using a different order for other elements */
            cursor: pointer;
            /* Add a pointer on hover */
        }

        #search-box {
            position: absolute;
            top: 5%;
            left: 5%;
            right: 5%;
            font-size: 50px;
            color: white;
            cursor: auto;
        }
        .gsc-control-cse{
            /* background-color: transparent !important; */
            border:none !important;
        }
        .gsc-search-button-v2 {
            font-size: 15px !important;
            margin-left: 2px !important;
        }
        .close-search{
            position: fixed;
            top: 10px;
            right: 20px;
            font-weight: 400;
            font-size: 27px;
        }
    </style>
</head>

<body>
    {!! getSettingValue('gtm_body_code') !!}
    @include('frontend.layouts.partials.header')
    <div class="sidebar-overlay"></div>
    <div id="headerAd" class="adver container text-center">
    </div>
    @yield('content')
    <div id="footerAd" class="adver container text-center">
    </div>
    @include('frontend.layouts.partials.footer')
    <button onclick="topFunction()" id="myBtn" title="Go to top">
        <i class="fa-solid fa-arrow-up"></i>
    </button>
    <script src="{{ asset('frontend') }}/js/script.min.js"></script>
    @stack('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            const atags = document.querySelectorAll('a');
            atags.forEach((a) => {
                // of outbound link
                if (a.href.indexOf(location.hostname) === -1) {
                    a.target = '_blank';
                    a.rel = 'noopener';
                }
            });
        });
    </script>
    <script>
        const loadImage = () => {
            if ('loading' in HTMLImageElement.prototype) {
                const images = document.querySelectorAll('img');
                images.forEach(img => {
                    img.dataset.src && (img.src = img.dataset.src);
                });

            } else {
                // Dynamically import the LazySizes library
                const script = document.createElement('script');
                script.src =
                    'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.1.2/lazysizes.min.js';
                document.body.appendChild(script);
            }
        }
        setTimeout(() => {
            loadImage();
        }, 1000)
    </script>
</body>

</html>
