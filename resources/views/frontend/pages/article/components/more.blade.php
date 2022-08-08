<div class="row similar-post-container">
    @foreach ($article->more() as $article)
        <div class="col-md-4 col-lg-3">
            <div class="similar-post d-flex" style="flex-direction: column !important">
                <div class="image">
                    <figure class="m-0">
                        <a href="{{ route('singleArticle', $article->slug) }}">
                            <img src="{{ asset($article->image) }}" alt="{{ $article->title }}"
                                class="image_img img-fluid">
                        </a>
                    </figure>
                </div>
                <div class="similar-post-title"
                    style="display: flex; flex-direction: column;justify-content: space-between; flex:1">

                    <div class="title">
                        <a href="{{ route('singleArticle', $article->slug) }}">
                            {{ $article->title }}
                        </a>
                    </div>
                    <div class="d-flex" style="justify-content: end">
                        <a href="{{ route('authorArticle', $article->writer->slug) }}">By
                            {{ $article->writer->alias_name }} on
                        </a>

                        <span class="mx-1">
                            {{ dateFormat($article->published_at) }}
                        </span>
                    </div>
                </div>






            </div>

        </div>
    @endforeach
</div>
