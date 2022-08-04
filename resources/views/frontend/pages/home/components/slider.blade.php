<section id="glider" class="my-2">
    <div class="splide">
        <div class="splide__track">
            <ul class="splide__list">
                @foreach ($data['featured_articles'] as $article)
                    <li class="splide__slide">
                        <figure class="slider-image">
                            <a href="{{ route('singlePage', ['slug' => $article->slug]) }}">
                                <img src="{{ asset($article->image) }}" loading="lazy" alt="{{ $article->title }}"
                                    class="slider-image-img img-fluid">
                            </a>
                            <p class="article-date">
                                {{ carbon($article->published_at)->format('M d, Y') }}
                            </p>|
                            <p class="article-author">
                                <a
                                    href="{{ route('authorArticle', ['author' => $article->writer->slug]) }}">{{ $article->writer->alias_name }}</a>
                            </p>
                            <p class="slider-category">

                                <a href="{{ route('singlePage', ['slug' => $article->category->slug]) }}"
                                    class="text-white">{{ $article->category->title }}</a>
                            </p>
                            <p class="slider-title">
                                <a href="{{ route('singlePage', ['slug' => $article->slug]) }}">
                                    {{ $article->title }}
                                </a>
                            </p>
                        </figure>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
