<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @include('frontend.layouts.partials.head')

    <link rel="stylesheet" href="{{ asset('frontend') }}/css/splide.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/style.css" type="text/css">

    @stack('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <meta name="atdlayout" content="home">

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


    @stack('scripts')


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
                                    html += '<div class="col-md-6 col-lg-4 mb-1">';
                                    html +=
                                        '<div class="category-post d-flex" style="flex-direction: column !important">';
                                    html += '<div class="image">';
                                    html += '<figure class="m-0">';
                                    html += '<a href="' +  d[index].url + '">';
                                    html += '<img src="' + d[index].image + '" alt="" class="image_img img-fluid">';
                                    html += '</a>';
                                    html += '</figure>';
                                    html += '</div>';
                                    html +=
                                        '<div class="category-post-title" style="display: flex; flex-direction: column;justify-content: space-between; flex:1">';
                                    html += '<div class="title mb-3">';
                                    html += '<a href="' +  d[index].url + '">';
                                    html += d[index].title;
                                    html += '</a>';
                                    html += '</div>';
                                    html += '<span class="category-post-author">';
                                    html += '<div class="d-flex" style="justify-content: end">';
                                    html += '<a href="' + d[index].author.url + '">By ' + d[index].author.name +
                                        ' on </a>';
                                    html += '<span class="mx-1">' + d[index].published_at + '</span>';
                                    html += '</div>';
                                    html += '</span>';
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
