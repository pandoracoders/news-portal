<div class="social-share">
    <a href="#"><i class="fa-brands fa-facebook facebook"></i></a>
    <a href="#"><i class="fa-brands fa-twitter twitter"></i></a>
    <a href="#"><i class="fa-brands fa-pinterest pinterest"></i></a>
</div>
<div class="title">
    <h1> {{ $article->title }} </h1>
    <div class="meta-property">
        <span class="mx-1">
            <span class="published-on"><i class="fa-solid fa-clock"></i> </span><span class="published-date">
                {{ dateFormat($article->published_at) }} </span>
        </span>
        @if ($article->updated_at > $article->published_at)
            <span>
                <i class="fa-solid fa-pen-to-square"></i></span><span class="updated-date">
                {{ dateFormat($article->updated_at) }}
            </span>
        @endif
        | By <a href="{{ route('authorArticle', $article->author->slug) }}"><span
                class="article-author">{{ $article->author->alias_name }}</span></a>
    </div>
</div>
