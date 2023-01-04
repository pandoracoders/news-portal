<div id="slider">
    <section id="glider" class="my-4">
        <div class="splide">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($data['featured_articles'] as $article)
                        <li class="splide__slide">
                            <figure class="slider-image">
                                <a href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                                    <img width="390" height="240" src="{{ asset($article->image) }}"
                                        alt="{{ $article->title }}" class="slider-image-img">
                                </a>
                                <p class="slider-category">

                                    <a href="{{ route('singleArticle', ['slug' => $article->category->slug]) }}"
                                        class="text-white">{{ $article->category->title }}</a>
                                </p>
                                <div class="title-section">
                                    <p class="slider-title">
                                        <a href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                                            {{ $article->title }}
                                        </a>
                                    </p>
                                    <p class="article-date">
                                        {{ carbon($article->published_at)->format('M d, Y') }} |
                                        <span class="article-author">
                                            <a
                                                href="{{ route('authorArticle', ['author' => $article->writer->slug]) }}">{{ $article->writer->alias_name }}</a>
                                        </span>
                                    </p>
                                </div>
                            </figure>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
</div>
