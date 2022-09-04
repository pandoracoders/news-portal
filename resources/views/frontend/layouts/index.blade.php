<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if (isset($title))
        <title> {{ $title }} - {{ getSettingValue('website_title') }}</title>
    @else
        <title>{{ getSettingValue('website_title') }} - {{ getSettingValue('slogan') }}</title>
    @endif

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @include('frontend.layouts.partials.head')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/style.css" type="text/css">

    @stack('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <meta name="atdlayout" content="home">


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
        if (window.ajax_url) {
            const scrollContent = document.getElementById('scroll-content');
            var page = 1;
            var loading = 0;
            var extra = 500;
            window.onscroll = function() {
                if (window.innerHeight + window.scrollY > scrollContent.offsetHeight - extra && loading === 0) {
                    // extra = 0;
                    loading = 1;
                    fetch(window.ajax_url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                "X-Requested-With": "XMLHttpRequest",
                                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                page,
                            })
                        })
                        .then(response => response.json())
                        .then(d => {

                            if (d && d.length > 0) {
                                // var r = d.data;
                                var html = '';

                                for (let index = 0; index < d.length; index++) {
                                    html += '<div class="col-md-6 col-lg-4 mb-1 single-post">';
                                    html +=
                                        '<div class="category-post">';
                                    html += '<div class="image">';
                                    html += '<figure class="m-0">';
                                    html += '<a href="' + d[index].url + '">';
                                    html += '<img src="' + d[index].image + '" alt="" class="image_img img-fluid">';
                                    html += '</a>';
                                    html += '</figure>';
                                    html += '</div>';
                                    html +=
                                        '<div class="category-post-title">';
                                    html += '<div class="title mb-3">';
                                    html += '<a href="' + d[index].url + '">';
                                    html += d[index].title;
                                    html += '</a>';
                                    html += '</div>';
                                    html += '<div class="meta"><p class = "article-date" >' + d[index]
                                        .published_at + ' | </p>';
                                    html += '<p class="article-author">';
                                    html += '<a href="' + d[index].author.url + '"> ' + d[index].author.name +
                                        '</a></p>';

                                    html += '</div>';
                                    html += '</div>';
                                    html += '</div>';
                                    html += '</div>';
                                }


                                scrollContent.insertAdjacentHTML('beforeend', html);
                                page++;
                                loading = 0;
                            }
                        })
                }
            }
        }
    </script>
</body>

</html>
