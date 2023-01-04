@extends('frontend.layouts.index',[
    'meta_title' =>  unSlug($page->key)
])

@push('styles')
    @include('frontend.assets.css.statitc-page_min')
@endpush


@section('content')
    <main class="container">
        <div class="row main-section">
            <div class="col-lg-8 article-section">
                <div class="bc">
                    <ul class="breadcrumb-container">
                        <li class="breadcrumb">
                            <a href="{{ url('/') }}">
                                <i class="fa fa-solid fa-home"></i>
                            </a>
                        </li>
                        ⇢
                        <li class="breadcrumb active">
                            <span class="text-capitalize">
                                {{ unSlug($page->key) }}
                            </span>
                        </li>
                    </ul>
                </div>


                <div class="title">
                    <h1> {{ unSlug($page->key) }} </h1>

                </div>
                <div class="content-detail">
                    {!! $page->value !!}
                </div>
            </div>
        </div>

    </main>
@endsection
