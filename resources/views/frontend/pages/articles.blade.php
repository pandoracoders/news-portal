<div class="row category-post-container" id="scroll-content">
    @forelse ($articles as $article)
        <div class="col-md-6 col-lg-4 mb-1">
            <div class="category-post d-flex" style="flex-direction: column !important">
                <div class="image">
                    <figure class="m-0">
                        <a href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                            <img src="{{ asset($article->image) }}" alt="" class="image_img img-fluid">
                        </a>
                    </figure>
                </div>
                <div class="category-post-title"
                    style="display: flex; flex-direction: column;justify-content: space-between; flex:1">
                    <div class="title mb-3">
                        <a href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                            {{ $article->title }}
                        </a>
                    </div>

                    <span class="category-post-author">
                        <div class="d-flex" style="justify-content: end">
                            <a href="{{ route('authorArticle', $article->writer->slug) }}">By
                                {{ $article->writer->alias_name }} on
                            </a>

                            <span class="mx-1">
                                {{ dateFormat($article->published_at) }}
                            </span>
                        </div>

                    </span>
                </div>
            </div>
        </div>
    @empty
        No Articles Found
    @endforelse


</div>
