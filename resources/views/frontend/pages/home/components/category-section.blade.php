

@if (count($section)>0)
<section class="row outer-section">
    <div class="heading mt-4 mb-4">
        <div class="category-segment">
            <span>{{ $section[0]->category->title }}</span>
        </div>
    </div>

    @forelse ($section as $article)
        @if ($loop->iteration < 7)
            <div class="col-md-4">
                <figure class="textover">
                    <a href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                        <img src="{{ asset($article->image) }}"
                            alt="{{ $article->title }}" class="image_img img-fluid">
                    </a>
                    <figcaption>
                        <a class="text-white" href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                            {{ ($article['tables']['quick-facts']['full-name']['value'])??$article->title }}
                        </a>
                    </figcaption>
                    <div class="image_overlay">
                        <p class="image_description">
                            {{ $article->summary }}
                        </p>
                        <a href="{{ $article->slug }}" class="btn btn-info btn-sm m-2 text-white">Read More</a>
                    </div>
                </figure>
            </div>
        @endif
    @empty
    @endforelse
    <div class="row">
        <div class="col-12">
            <h2 class="text-center load">
                <a href="{{ route('singleArticle', ['slug' => $section[0]->category->slug]) }}" class="btn">View
                    All</a>
            </h2>
        </div>
    </div>
</section>
@endif
