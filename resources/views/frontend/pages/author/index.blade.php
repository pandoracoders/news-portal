@extends('frontend.layouts.index', [
    'meta_title' => $author->alias_name,
    'meta_description' => "All the articles from {$author->alias_name}",
    'meta_keyword' => getSettingValue('meta_keyword'),
    'image' => getSettingValue('logo'),
    'type' => 'website'
])

@push('styles')
    <link rel="stylesheet" href="{{ asset('') }}frontend/css/category.min.css" type="text/css">



@endpush


@section('content')
    <main class="container">
        <!-- BreadCrumb -->
        <div class="bc">
            <ul class="breadcrumb-container">
                <li class="breadcrumb">
                    <a href="{{ url('/') }}">
                        <span>Home</span>
                    </a>
                </li>
                ⇢
                <li class="breadcrumb active">
                    <span class="text-capitalize">
                        {{ $author->alias_name }}
                    </span>
                </li>
            </ul>
        </div>

        <section class="category-div">
            <div class="container category-title">
                <h1 class="text-capitalize">All Posts from :
                    <span class="colored">
                        {{ $author->alias_name }}
                    </span>
                </h1>
            </div>
        </section>

        <!-- List -->
        <section class="category-section">
            <div class="container">
                @include('frontend.pages.articles', [
                    'articles' => $author->articles()->limit(9)->get(),
                ])

            </div>
        </section>
    </main>
@endsection

<script>
    if (window)
        window.ajax_url = "{{ route('authorArticles', $author->slug) }}";
</script>
