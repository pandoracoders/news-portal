@extends('frontend.layouts.index')
@push('styles')
    {{-- @include('frontend.assets.css.homepage')
    @include('frontend.assets.css.splide') --}}
     @include('frontend.assets.css.homepage_min')
@endpush
@push('schema')
    {!! $schema !!}
@endpush

@push('scripts')
    @include('frontend.assets.js.splide')
    @include('frontend.assets.js.homepage')
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
