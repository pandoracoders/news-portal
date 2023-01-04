@if (count($born_today))

    <section class="row outer-section">
        <div class="heading mt-4 mb-4">
            <div class="category-segment">
                <span>Born Today</span>
            </div>
        </div>

        @forelse ($born_today as $article)
            <div class="col-md-4">
                <figure class="textover">
                    <a href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                        <img width="350" height="230" src="{{ asset($article->image) }}"
                            loading="lazy" alt="{{ $article->title }}" class="image_img img-fluid">
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
        @empty
        @endforelse
        <div class="row">
            <div class="col-12">
                <h2 class="text-center load">
                    <a href="{{ route('facts.search', ['birth', str_slug(($article['tables']['quick-facts']['birth-month']['value'].' '.$article['tables']['quick-facts']['birth-day']['value']))]) }}" class="btn">View
                        All</a>
                </h2>
            </div>
        </div>
    </section>
@endif
