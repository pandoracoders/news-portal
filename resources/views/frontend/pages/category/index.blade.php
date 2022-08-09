@extends('frontend.layouts.index')

@push('styles')
    <link rel="stylesheet" href="{{ asset('') }}/frontend/css/category.css" type="text/css">

    <style>
        .row {
            display: flex !important;

        }

        .row>[class*='col-'] {
            display: flex !important;
            flex-direction: row !important;
        }
    </style>
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
                <li class="breadcrumb active">
                    <span class="text-capitalize">
                        {{ $category->title }}
                    </span>
                </li>
            </ul>
        </div>

        <section class="category-div">
            <div class="container category-title">
                <h1 class="text-capitalize">Category : <span class="colored">
                        {{ $category->title }}
                    </span></h1>
            </div>
        </section>

        <!-- List -->
        <section class="category-section">
            <div class="container">
                @include('frontend.pages.articles', [
                    'articles' => $category->articles()->limit(9)->get(),
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
