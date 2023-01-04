<div class="title">
    <h1> {{ $article->title }} </h1>
    <div class="meta-section">
        <div class="meta-property">
            <span class="mx-1">
                <span class="published-on"><i class="fa-solid fa-clock"></i> </span><span class="published-date">
                    {{ dateFormat($article->published_at) }} &nbsp; |</span>
            </span>
            @if ($article->updated_at > $article->published_at)
                <span>
                    <i class="fa-solid fa-pen-to-square"></i></span><span class="updated-date">
                    {{ dateFormat($article->updated_at) }} &nbsp;|&nbsp;
                </span>
            @endif
            <span class="article-author"><a
                    href="{{ route('authorArticle', $article->author->slug) }}"><i class="fa-solid fa-user-pen"></i> {{ $article->author->alias_name }}</a>
            </span>
        </div>
        <div class="social-share">
            Share:
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}" target="_blank"><i class="fa-brands fa-facebook facebook"></i></a>
            <a href="https://twitter.com/intent/tweet?url={{ Request::url() }}" target="_blank"><i class="fa-brands fa-twitter twitter"></i></a>
            <a href="https://pinterest.com/pin-builder/?url={{ Request::url() }}/&media={{ $article->image }}&description={{ $article->meta_description}}" target="_blank"><i class="fa-brands fa-pinterest pinterest"></i></a>
        </div>
    </div>
</div>
