@extends('frontend.layouts.index')

@push('styles')
    <link rel="stylesheet" href="{{ asset('') }}frontend/css/homepage.css" type="text/css">
@endpush

@push('scripts')
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
@endpush


@section('content')
    <!-- Slider -->

    @include('frontend.pages.home.components.slider')

    @foreach ($data['category_section'] as $key => $section)
        {{-- {{ dd($key) }} --}}
        @if ($key == 'biography')
            @include('frontend.pages.home.components.category-section', [
                'section' => $section,
            ])
        @endif
    @endforeach
    
    @if (count($data['born_today']))
        <section class="row outer-section">
            <div class="heading mt-4 mb-4">
                <div class="category-segment">
                    <span>Born Today</span>
                </div>
            </div>

            @forelse ($data['born_today'] as $article)
                <div class="col-md-4">
                    <figure class="textover">
                        <a href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                            <img src="{{ asset($article->image) }}" loading="lazy" alt="{{ $article->title }}"
                                class="image_img img-fluid">
                        </a>
                        <figcaption>
                            <a class="text-white" href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                                {{ $article->title }}
                            </a>
                        </figcaption>
                        <div class="image_overlay">
                            <div class="image_title">
                                <a class="text-white" href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                                    {{ $article->title }}
                                </a>
                            </div>
                            <p class="image_description">
                                {{ $article->summary }}
                            </p>
                        </div>
                    </figure>
                </div>
            @empty
            @endforelse
        </section>
    @endif

    @if (count($data['died_today']))
        <section class="row outer-section">
            <div class="heading mt-4 mb-4">
                <div class="category-segment">
                    <span>Died Today</span>
                </div>
            </div>

            @forelse ($data['died_today'] as $article)
                <div class="col-md-4">
                    <figure class="textover">
                        <a href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                            <img src="{{ asset($article->image) }}" loading="lazy" alt="{{ $article->title }}"
                                class="image_img img-fluid">
                        </a>
                        <figcaption>
                            <a class="text-white" href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                                {{ $article->title }}
                            </a>
                        </figcaption>
                        <div class="image_overlay">
                            <div class="image_title">
                                <a class="text-white" href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                                    {{ $article->title }}
                                </a>
                            </div>
                            <p class="image_description">
                                {{ $article->summary }}
                            </p>
                        </div>
                    </figure>
                </div>
            @empty
            @endforelse
        </section>
    @endif
@endsection
