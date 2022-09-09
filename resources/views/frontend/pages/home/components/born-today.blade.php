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
                        <img src="{{ asset('image-placeholder.png') }}" default-src="{{ asset($article->image) }}"
                            loading="lazy" alt="{{ $article->title }}" class="image_img img-fluid">
                    </a>
                    <figcaption>
                        <a class="text-white" href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                            {{ $article->title }}
                        </a>
                    </figcaption>
                    <div class="image_overlay">

                        <p class="image_description">
                            {{ $article->summary }}
                        </p>
                    </div>
                </figure>
            </div>
        @empty
        @endforelse
    </section>
@endif
