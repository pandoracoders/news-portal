{{-- article grid --}}
{{-- @foreach ($articles as $article)
    <div class="col-md-4 col-lg-3 post-section article-card">
        <div class="similar-post">
            <div class="image">
                <figure class="m-0">
                    <a href="{{ route('singleArticle', $article->slug) }}">
                        <img src="{{ $article->image }}" alt="" class="image_img img-fluid">
                    </a>
                </figure>
            </div>
            <div class="similar-post-title">
                <div class="title mb-3">
                    <a href="{{ route('singleArticle', $article->slug) }}">
                        {{ $article->title }}
                    </a>
                </div>

                <div class="meta">
                    <p class="article-date">
                        {{ $article->published_at }}
                        |
                    </p>
                    <p class="article-author">
                        <a href="{{ route('author', $article->author->slug) }}">
                            {{ $article->author->name }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endforeach --}}

{{-- read more articles with section title --}}
{{--  --}}


<div id="slider" style="display: block">
    <section id="glider" class="my-4">
        <div class="splide">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($articles as $article)
                        <li class="splide__slide">
                            <figure class="slider-image">
                                <a href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                                    <img src="{{ asset('image-placeholder.png') }}"
                                        data-src="{{ asset($article->image) }}" alt="{{ $article->title }}"
                                        class="slider-image-img">
                                </a>
                                <p class="slider-category">

                                    <a href="{{ route('singleArticle', ['slug' => $article->category->slug]) }}"
                                        class="text-white">{{ $article->category->title }}</a>
                                </p>
                                <p class="slider-title">
                                    <a href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                                        {{ $article->title }}
                                    </a>
                                </p>
                                <p class="article-date">
                                    {{ carbon($article->published_at)->format('M d, Y') }}
                                </p>|
                                <p class="article-author">
                                    <a
                                        href="{{ route('authorArticle', ['author' => $article->writer->slug]) }}">{{ $article->writer->alias_name }}</a>
                                </p>
                            </figure>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
</div>
