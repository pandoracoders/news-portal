@extends('frontend.layouts.index')

@push('styles')
    <link rel="stylesheet" href="{{ asset('') }}frontend/css/category.css" type="text/css">
@endpush

@section('content')
    <main class="container">
        <!-- BreadCrumb -->
        <div class="bc mx-5 m-3">
            <ul class="breadcrumb-container">
                <li class="breadcrumb">
                    <a href="{{ url('/') }}">
                        <span>Home</span>
                    </a>
                </li>
                ⇢
                <li class="breadcrumb active">
                    <span class="text-capitalize">
                        {{ $category->title }}
                    </span>
                </li>
            </ul>
        </div>

        <section class="category-div mb-3">
            <div class="container category-title">
                <h3 class="text-capitalize">All Posts on <span class="colored">
                        {{ $category->title }}
                    </span></h3>
            </div>
        </section>

        <!-- List -->
        <section class="category-section">
            <div class="container">
                @include('frontend.pages.articles', [
                    'articles' => $category->articles()->orderBy("published_at")->limit(9)->get(),
                ])
            </div>

            <div class="container">
                <div class="row">
                </div>
            </div>


        </section>
    </main>
@endsection


@push('scripts')
    <script>
        if (window)
            window.ajax_url = "{{ route('categoryArticles', $category->slug) }}";
    </script>
@endpush
