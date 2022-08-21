<div class="row category-post-container" id="scroll-content">
    @forelse ($articles as $article)
        <div class="col-md-6 col-lg-4 mb-1 single-post">
            <div class="category-post">
                <div class="image">
                    <figure class="m-0">
                        <a href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                            <img src="{{ asset($article->image) }}" alt="" class="image_img img-fluid">
                        </a>
                    </figure>
                </div>
                <div class="category-post-title">
                    <div class="title">
                        <a href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                            {{ $article->title }}
                        </a>
                    </div>

                    <div class="meta">
                        <p class="article-date"> {{ dateFormat($article->published_at) }} | </p><p class="article-author"><a href="{{ route('authorArticle', $article->writer->slug) }}">
                            {{ $article->writer->alias_name }} 
                        </a></p>
                    </div>
                </div>
            </div>
        </div>
    @empty
        No Articles Found
    @endforelse


</div>
