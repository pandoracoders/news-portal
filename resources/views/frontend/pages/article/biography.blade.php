@php
$factsOrder = ['full-name', 'popular-name', 'birth-place', 'birth-day', 'death-day', 'death-cause', 'nationality', 'ethnicity', 'father', 'mother', 'siblings', 'profession', 'net-worth', 'height', 'weight', 'body-measurement', 'gender-identity', 'marital-status', 'spouse', 'children'];
@endphp

@push('styles')
    <link rel="stylesheet" href="{{ asset('') }}frontend/css/biography.min.css" type="text/css">
@endpush



<main>
    <div class="row">
        <div class="col-12 biography">
            <div class="row">
                <div class="col-lg-9 col-md-12 main-content-section">
                    <div class="bc">
                        <ul class="breadcrumb-container">
                            <li class="breadcrumb">
                                <a href="{{ url('/') }}">
                                    <i class="fa fa-solid fa-home"></i>
                                </a>
                            </li>
                            ⇢
                            <li class="breadcrumb">
                                <a href="{{ route('singleArticle', $article->category->slug) }}"
                                    class="text-capitalize">
                                    {{ $article->category->slug }}
                                </a>
                            </li>
                            ⇢
                            <li class="breadcrumb active">
                                <span>
                                    {{ $article->slug }}
                                </span>
                            </li>
                        </ul>

                    </div>

                    <div class="row">
                        @include('frontend.pages.article.components.title-section')


                        <div class="col-lg-4">
                            <div class="left-section">
                                <div class="featured-image">
                                    <div class="image">
                                        <figure class="m-0">
                                            <img src="{{ asset($article->image) }}" alt="{{ $article->title }}"
                                                class="image_img img-fluid">

                                        </figure>
                                    </div>
                                </div>
                                <div class="facts">
                                    @foreach ($article->tables as $title => $table)
                                        {{-- {{ dd($table , $title) }} --}}
                                        <div class="heading">
                                            <div class="category-segment">
                                                <span>{{ $title }}</span>
                                            </div>
                                        </div>
                                        <table class="table facts-table">
                                            @php
                                                // dd($table)
                                            @endphp
                                            <tbody>
                                                @foreach ($factsOrder as $tr)
                                                    @if (array_key_exists($tr, $table))
                                                        @if ($tr == 'birth-day')
                                                            <tr>
                                                                <td class="fact-title">
                                                                    Birthday
                                                                </td>
                                                                <td class="fact-detail">
                                                                    {!! $table['birth-month']['html'] !!} {!! $table['birth-day']['html'] !!}, {!! $table['birth-year']['html'] !!}
                                                                </td>
                                                            </tr>
                                                        @else
                                                            <tr>
                                                                <td class="fact-title">
                                                                    {!! $table[$tr]['title'] !!}
                                                                </td>
                                                                <td class="fact-detail">
                                                                    {!! $table[$tr]['html'] !!}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <div class="right-section col-lg-8">
                            @include('frontend.pages.article.components.table_of_content')
                            <div class="content-detail">
                                <p>
                                    {!! $article->body !!}
                                </p>
                            </div>
                            <div class="col-md-12">
                                @include('frontend.pages.article.components.tags')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 sidebar-section">
                    <div class="sidebar-section-wrap">

                    </div>
                </div>
            </div>
            <div class="similar-post-section">
            </div>
        </div>
    </div>
</main>
