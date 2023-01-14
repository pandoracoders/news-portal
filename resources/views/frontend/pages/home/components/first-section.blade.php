 <!-- Biography Section -->
 <section class="row outer-section">
    <div class="col-lg-8 mt-4">
        <div class="heading">
            <div class="category-segment">
                <span>{{ $section[0]->category->title }}</span>
            </div>
        </div>
        <div class="row">
            <div class="biography-left col-lg-6">
                <div class="row mt-3">
                    @forelse ($section as $article)
                       @if( $loop->iteration < 7)
                        <div class="col-md-6 col-lg-12">
                            <div class="biography-single">
                                <div class="col-4 image">
                                    <figure class="m-0">
                                        <a href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                                            <img src="{{ asset($article->image) }}"
                                                alt="{{ $article->title }}" class="image_img">
                                        </a>
                                    </figure>
                                </div>
                                <div class="col-8 biography-title">

                                    <h2>
                                        <a href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                                            {{ $article->category->slug == "biography" ? $article->seo->meta_title : $article->title }}
                                        </a>
                                    </h2>

                                    <div class="meta">
                                        <p class="article-date">{{ carbon($article->published_at)->format('M d, Y') }}
                                            | </p> <a
                                            href="{{ route('authorArticle', ['author' => $article->writer->slug]) }}">
                                            <p class="article-author">
                                                {{ $article->writer->alias_name }}
                                            </p>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                       @endif
                    @empty
                    @endforelse
                </div>
            </div>

            @if (count($section) > 6)
               <div class="biography-right col-lg-6 mt-3">
                   @foreach ($section as $article)
                       @if ($loop->iteration > 6)
                           <a class="text-white" href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                               <figure class="textover">
                                   <img width="50" height="50"
                                   src="{{ asset($article->image) }}" alt="{{ $article->title }}"
                                       class="image_img">
                                   <figcaption>
                                       {{ $article->title }}
                                   </figcaption>
                               </figure>
                           </a>
                       @endif
                   @endforeach
               </div>
            @endif
        </div>
        <div class="row">
            <div class="col-12">
                <h2 class="text-center load">
                    <a href="{{ route('singleArticle', ['slug' => $section[0]->category->slug]) }}" class="btn">View
                        All</a>
                </h2>
            </div>
        </div>
    </div>
    <!-- Trending Section -->
    <div class="col-lg-4 mt-4">
        <div class="heading">
            <div class="category-segment">
                <span> Editor Choice</span>
            </div>
        </div>
        <div class="trending mt-3">
            <div class="row">
                @forelse ($second as $article)
                    @if ($loop->iteration < 7)
                    <div class="trending-single col-md-6 col-lg-12">
                       <div class="image">
                           <figure class="m-0">
                               <a href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                                   <img width="50" height="50"
                                   src="{{ asset($article->image) }}" alt="{{ $article->title }}"
                                       class="image_img">
                               </a>
                           </figure>
                       </div>
                       <div class="trending-title">
                           <h2>
                               <a class="" href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                                   {{ $article->title }}
                               </a>
                           </h2>
                           <div class="meta">
                               <p class="article-date">{{ carbon($article->published_at)->format('M d, Y') }} | </p>
                               <a href="{{ route('authorArticle', ['author' => $article->writer->slug]) }}">
                                   <p class="article-author">
                                       {{ $article->writer->alias_name }}
                                   </p>
                               </a>
                           </div>
                       </div>
                   </div>
                    @endif
                @empty
                @endforelse
            </div>
        </div>
    </div>
</section>
