@extends('frontend.layouts.index')


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


    <!-- Entertainment Section  -->

    <!-- Genral Born Today Section -->


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
                        <a href="{{ route('singlePage', ['slug' => $article->slug]) }}">
                            <img src="{{ asset($article->image) }}" loading="lazy" alt="{{ $article->title }}"
                                class="image_img img-fluid">
                        </a>
                        <figcaption>
                            <a class="text-white" href="{{ route('singlePage', ['slug' => $article->slug]) }}">
                                {{ $article->title }}
                            </a>
                        </figcaption>
                        <div class="image_overlay">
                            <div class="image_title">
                                <a class="text-white" href="{{ route('singlePage', ['slug' => $article->slug]) }}">
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
                        <a href="{{ route('singlePage', ['slug' => $article->slug]) }}">
                            <img src="{{ asset($article->image) }}" loading="lazy" alt="{{ $article->title }}"
                                class="image_img img-fluid">
                        </a>
                        <figcaption>
                            <a class="text-white" href="{{ route('singlePage', ['slug' => $article->slug]) }}">
                                {{ $article->title }}
                            </a>
                        </figcaption>
                        <div class="image_overlay">
                            <div class="image_title">
                                <a class="text-white" href="{{ route('singlePage', ['slug' => $article->slug]) }}">
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
