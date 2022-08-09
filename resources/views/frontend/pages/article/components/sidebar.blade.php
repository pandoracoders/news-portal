<div class="row">
    @foreach ($article->youMayAlsoLike() as $article)
        <div class="sidebar-post col-md-6 col-lg-12 mt-3 d-flex">
            <div class="image" style="flex:1">
                <figure class="m-0">
                    <a href="{{ route('singleArticle', $article->slug) }}">
                        <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" class="image_img img-fluid">
                    </a>
                </figure>
            </div>
            <div class="sidebar-post-title" style="flex: 1">
                <div class="title">
                    <a href="{{ route('singleArticle', $article->slug) }}">
                        {{ $article->title }}
                    </a>
                </div>
                <span class="article-date">{{ dateFormat($article->published_at) }}</span>
                |<span class="article-author">
                    <a href="{{ route('authorArticle', $article->author->slug) }}">
                        {{ $article->author->alias_name }}</a>
                </span>
            </div>
        </div>
    @endforeach


</div>
