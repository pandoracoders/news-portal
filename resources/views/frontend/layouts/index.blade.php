<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @include('frontend.layouts.partials.head')
    @stack('styles')
    {!! getSettingValue('org_schema') !!}
    @stack('schema')
    <style>
        body a {
            color: #111;
        }
    </style>
    <style>
        p {
            text-align: justify !important;
        }

        @media(max-width: 480px) {
            p {
                text-align: left !important;
            }
        }
    </style>
</head>
<body>
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
