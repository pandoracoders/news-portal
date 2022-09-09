<div class="sidebar-post col-md-6 col-lg-12 mt-3">
    <div class="image">
        <figure class="m-0">
            <a href="{{ route('singleArticle', $article->slug) }}">
                <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" class="image_img">
            </a>
        </figure>
    </div>
    <div class="sidebar-post-title mx-2">

        <h2 class="title">
            <a href="{{ route('singleArticle', $article->slug) }}">
                {{ $article->title }}
            </a>
        </h2>
        <div class="meta">
            <span class="article-date">{{ dateFormat($article->published_at) }} | </span><span class="article-author"><a
                    href="{{ route('authorArticle', $article->author->slug) }}">
                    {{ $article->author->alias_name }}</a></span>
        </div>

    </div>

</div>
