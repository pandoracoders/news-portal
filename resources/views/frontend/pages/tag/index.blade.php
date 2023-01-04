@extends('frontend.layouts.index')

@push('styles')
    @include('frontend.assets.css.category_min')
@endpush

@push('schema')
    {!! $schema !!}
@endpush

@section('content')
    <main class="container">
        <!-- BreadCrumb -->
        <div class="bc m-3">
            <ul class="breadcrumb-container">
                <li class="breadcrumb">
                    <a href="{{ url('/') }}">
                        <span>Home</span>
                    </a>
                </li>
                ⇢
                <li class="breadcrumb active">
                    <span class="text-capitalize">
                        {{ $tag->original_title }}
                    </span>
                </li>
            </ul>
        </div>

        <section class="category-div">
            <div class="container category-title">
                <h1 class="text-capitalize">Tag : <span class="colored">
                        {{ $tag->original_title }}
                    </span></h1>
            </div>
        </section>

        <!-- List -->
        <section class="category-section">
            <div class="container">
                @include('frontend.pages.articles', [
                    'articles' => $tag->articles()->limit(9)->get(),
                ])
            </div>
        </section>
    </main>
@endsection


@push('scripts')
    <script>
        if (window)
            window.ajax_url = "{{ route('tagArticles', $tag->slug) }}";
    </script>
@endpush
