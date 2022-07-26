@extends('frontend.layouts.index')
@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/homepage.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('frontend') }}/js/splide.min.js" defer></script>
    <script>
        // document.getQuery
    </script>




    <script>
        const loadImages = () => {
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
            var slider = document.querySelector("div.splide");
            if (slider) {
                document.getElementById("slider").style.display = "";
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

            }
            loadImages();
        }, 5000)

        setTimeout(() => {

            fetch("{{ route('ajax.getHomePageAjax') }}")
                .then(response => response.json())
                .then(({
                    data
                }) => {
                    console.log(data)
                    document.getElementById('more-category-section').innerHTML = data.category_section_html;
                    document.getElementById('born-today').innerHTML = data.born_today;
                    document.getElementById('died-today').innerHTML = data.died_today;

                    loadImages();
                });



        }, 5000);
    </script>
@endpush


@section('content')
    <!-- Slider -->

    <main class="container">
        @if ($data['featured_articles']->count())
            @include('frontend.pages.home.components.slider')
        @endif

        @foreach ($data['category_section'] as $key => $section)
            @include('frontend.pages.home.components.category-section', [
                'section' => $section,
            ])
        @endforeach
        <div id="more-category-section">
        </div>

        <section id="born-today">
        </section>
        <section id="died-today">
        </section>
    </main>
@endsection
