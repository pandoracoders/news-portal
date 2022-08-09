@push('styles')
    <link rel="stylesheet" href="{{ asset('') }}/frontend/css/article.css" type="text/css">

    <style>
        .similar-post-section .row {
            display: flex !important;

        }

        .similar-post-section .row>[class*='col-'] {
            display: flex !important;
            flex-direction: row !important;
        }
    </style>

    <style>
        .featured-image>img {
            width: 100% !important;
        }
    </style>
@endpush


@section('content')
    <main class="container">

        <div class="row main-section">
            <div class="col-lg-8 article-section">
                <div class="bc">
                    <ul class="breadcrumb-container">
                        <li class="breadcrumb">
                            <a href="/">
                                <i class="fa fa-solid fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb">
                            <a href="{{ route('singleArticle', $article->category->slug) }}" class="text-capitalize">
                                {{ $article->category->title }}
                            </a>
                        </li>
                        <li class="breadcrumb active">
                            <span class="text-capitalize">
                                {{ $article->title }}
                            </span>
                        </li>
                    </ul>
                </div>

                @include('frontend.pages.article.components.title-section')

                <div class="featured-image">
                    <img src="{{ $article->image }}" class="img-fluid" alt="{{ $article->title }}">
                </div>
                <div class="table-of-contents col-lg-8">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <a data-bs-toggle="collapse" data-bs-parent="#accordion" data-bs-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    <h5 class="contents-heading panel-title">Contents</h5>
                                </a>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in show" role="tabpanel"
                                aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <ul class="list">

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-detail">
                    {!! $article->body !!}
                </div>
            </div>
            <div class="col-lg-4 sidebar-section mt-3">
                <div class="sidebar-section-wrap">
                    <div class="heading">
                        <div class="category-segment">
                            <span>You May Also Like</span>
                        </div>
                    </div>
                    @include('frontend.pages.article.components.sidebar')
                </div>
            </div>
            <div class="col-md-12">
                @include('frontend.pages.article.components.tags')
            </div>
        </div>
        <div class="similar-post-section">
            <div class="heading mt-4 mb-4">
                <div class="category-segment">
                    <span>More </span>
                </div>
            </div>
            @include('frontend.pages.article.components.more')
        </div>
    </main>
@endsection