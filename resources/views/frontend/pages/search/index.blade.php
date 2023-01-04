@extends('frontend.layouts.index')

@push('styles')
    @include('frontend.assets.css.search_min')
@endpush

@section('content')
    <main class="container">

        <form action="/search/" method="get" class="col-lg-6 form">
            <input value="{{ isset($search_for)?$search_for:'' }}" type="text" name="q" id="" class="form-control search-place">
            <button type="submit"><i class="fa-solid fa-magnifying-glass submit" ></i></button>
        </form>


        <section class="category-div mt-3 mb-3">
            <div class="container category-title">
                <h3 class="text-capitalize">Search Results On <span class="colored">
                        {{ $search_for }}
                    </span></h3>
            </div>
        </section>
        <section class="search-results col-lg-8 col-md-11">
            @foreach ($articles as $article)
            <div class="single-article">
                <div class="image-section">
                    <a href="/{{ $article->slug}}">
                        <img src="{{asset($article->image)}}" width="300" alt="">
                    </a>
                </div>
                <div class="title-section">
                    <a href="/{{$article->slug}}">
                        <h2 class="article-title">{{ $article->title }}</h2>
                    </a>
                    <p>{!! $article->summary !!}</p>
                </div>
            </div>
            @endforeach

            @foreach ($subArticles as $article)
            <div class="single-article">
                <div class="image-section">
                    <a href="/{{ $article->slug}}">
                        <img src="{{asset($article->image)}}" width="300" alt="">
                    </a>
                </div>
                <div class="title-section">
                    <a href="/{{$article->slug}}">
                        <h2 class="article-title">{{ $article->title }}</h2>
                    </a>
                    <p>{!! $article->summary !!}</p>
                </div>
            </div>
            @endforeach
        </section>
    </main>
@endsection
