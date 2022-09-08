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

                                            <tbody>
                                                @foreach ($table as $tr)
                                                    <tr>
                                                        <td class="fact-title">{!! $tr['title'] !!}</td>
                                                        <td class="fact-detail">{!! $tr['html'] !!}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <div class="right-section col-lg-8">
                            <div class="table-of-contents col-lg-8">
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <a data-bs-toggle="collapse" data-bs-parent="#accordion"
                                                data-bs-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <span class="contents-heading panel-title">Contents</span>
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
