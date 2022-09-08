 <!-- Biography Section -->
 <section class="row outer-section">
     <div class="col-lg-8 mt-4">
         <div class="heading">
             <div class="category-segment">
                 <span>{{ $section['category']->title }}</span>
             </div>
         </div>
         <div class="row">
             <div class="biography-left col-lg-6">
                <div class="row mt-3">
                    @forelse ($section['articles'][0] as $key => $article)
                    <div class="col-md-6 col-lg-12">
                        <div class="biography-single">
                            <div class="col-4 image">
                                <figure class="m-0">
                                    <a href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                                        <img src="{{ asset("image-placeholder.png") }}"   width="50" height="50" data-src="{{ asset($article->image) }}" loading="lazy"
                                            alt="{{ $article->title }}" class="image_img">
                                    </a>
                                </figure>
                            </div>
                            <div class="col-8 biography-title">

                                <h2>
                                    <a href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                                        {{ $article->title }}
                                    </a>
                                </h2>

                                <div class="meta">
                                    <p class="article-date">{{ carbon($article->published_at)->format('M d, Y') }} | </p> <a
                                         href="{{ route('authorArticle', ['author' => $article->writer->slug]) }}"><p
                                         class="article-author">
                                         {{ $article->writer->alias_name }}
                                        </p>
                                    </a>
                                 </div>
                            </div>

                        </div>
                    </div>
                @empty
                @endforelse
                </div>
             </div>

             <div class="biography-right col-lg-6 mt-3">
                 @foreach ($section['articles'][1] ?? [] as $key => $article)
                     <figure class="textover">
                         <img width="50" height="50" src="{{ asset("image-placeholder.png") }}" data-src="{{ asset($article->image) }}" loading="lazy" alt="{{ $article->title }}"
                             class="image_img">
                         <figcaption>
                             <a class="text-white" href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                                 {{ $article->title }}
                             </a>
                         </figcaption>
                     </figure>
                 @endforeach
             </div>
         </div>
         <div class="row">
             <div class="col-12">
                 <h2 class="text-center load">
                     <a href="{{ route('singleArticle', ['slug' => $section['category']->slug]) }}" class="btn">View
                         All</a>
                 </h2>
             </div>
         </div>
     </div>
     <!-- Trending Section -->
     <div class="col-lg-4 mt-4">
         <div class="heading">
             <div class="category-segment">
                 <span>{{ $section['second']['title'] }}</span>
             </div>
         </div>
         <div class="trending mt-3">
             <div class="row">
                @forelse ($section["second"]["articles"] as $article)
                 <div class="trending-single col-md-6 col-lg-12">
                     <div class="image">
                         <figure class="m-0">
                             <a href="{{ route('singleArticle', ['slug' => $article->slug]) }}">
                                 <img width="50" height="50" src="{{ asset("image-placeholder.png") }}" data-src="{{ asset($article->image) }}" loading="lazy" alt="{{ $article->title }}"
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
                            <p class="article-date">{{ carbon($article->published_at)->format('M d, Y') }} | </p> <a
                                 href="{{ route('authorArticle', ['author' => $article->writer->slug]) }}"><p
                                 class="article-author">
                                 {{ $article->writer->alias_name }}
                                </p>
                            </a>
                         </div>
                     </div>
                 </div>
             @empty
             @endforelse
             </div>
         </div>
     </div>
 </section>
