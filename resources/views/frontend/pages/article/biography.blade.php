@push('styles')
    @include('frontend.assets.css.biography_min')
@endpush



<main>

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
                            <li class="breadcrumb active text-capitalize">
                                <span class="bc-title">
                                    {{ $article->title }}
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
                                            <img src="{{ asset($article->image) }}" alt="{{ $article->featured_image_alt_text }}"
                                                class="image_img" width="425" height="300">
                                        </figure>
                                    </div>
                                </div>
                                @include('frontend.pages.article.components.facts')
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
            <div class="heading mt-4 mb-4">
                <div class="category-segment">
                    <span>More on  {{$article->category->title}}</span>
                </div>
            </div>
            <div class="similar-post-section">

            </div>
        </div>

</main>
