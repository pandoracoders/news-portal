<div class="row similar-post-container">
    @foreach ($article->more() as $article)
        <div class="col-md-4 col-lg-3">
            <div class="similar-post">
                <div class="image">
                    <figure class="m-0">
                        <a href="{{ route('singleArticle', $article->slug) }}">
                            <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" class="image_img img-fluid">
                        </a>
                    </figure>
                </div>
                <div class="similar-post-title">
                    <div class="title"><a href="{{ route('singleArticle', $article->slug) }}"> {{ $article->title }}</a>
                    </div>
                    <div class="meta">
                        <p class="article-date"> {{ dateFormat($article->published_at) }} | </p><p class="article-author"><a href="{{ route('authorArticle', $article->writer->slug) }}">
                            {{ $article->writer->alias_name }} 
                        </a></p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
