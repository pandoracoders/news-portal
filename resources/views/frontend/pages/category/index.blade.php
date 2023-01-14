@extends('frontend.layouts.index', [
    'meta_title' => $category->seo?->meta_title ?? $category->title,
    'meta_description' => $category->seo?->meta_title ?? "All the articles on {$category->title}",
    'meta_keyword' => $category->seo?->meta_keyword ?? getSettingValue('meta_keyword'),
    'image' => getSettingValue('logo'),
    'type' => 'website',
])

@push('styles')
    @include('frontend.assets.css.category_min')
@endpush

@push('schema')
    {!! $schema !!}
@endpush

@section('content')
    <main class="container">
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
                        {{ $category->title }}
                    </span>
                </li>
            </ul>
        </div>

        <section class="category-div mt-3 mb-3">
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
                    'articles' => $category->articles()->orderBy('published_at')->limit(9)->get(),
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
    @include('frontend.assets.js.category')
@endpush
