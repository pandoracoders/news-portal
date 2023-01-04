<p class="readmore-text">Also Read:</p>
<div class="readmore-container row">
    @foreach ($articles as $article)
        <div class="readmore-article col-6 col-md-3">
            <div class="readmore-image">
                <a href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                    <img src="{{ asset($article->image) }}" alt="{{ $article->title }}"
                        class="readmore-image-img" width="190" height="120">
                </a>
                <p class="readmore-title">
                    <a href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                        {{ $article->title }}
                    </a>
                </p>
            </div>
        </div>
    @endforeach
</div>
