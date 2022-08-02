 <!-- Biography Section -->
 <section class="row outer-section">
     <div class="col-md-8 mt-4">
         <div class="heading">
             <div class="category-segment">
                 <span>{{ $section['category']->title }}</span>
             </div>
         </div>
         <div class="row my-3">
             <div class="biography-left col-md-6">
                 @forelse ($section['articles'][0] as $key => $article)
                     <div class="biography-single">
                         <div class="col-4 image">
                             <figure class="m-0">
                                 <a href="{{ route('singlePage', ['slug' => $article->slug]) }}">
                                     <img src="{{ asset($article->image) }}" loading="lazy" alt="{{ $article->title }}"
                                         class="image_img img-fluid">
                                 </a>
                             </figure>
                         </div>
                         <div class="col-8 biography-title">
                             <p class="article-date"> {{ carbon($article->published_at)->format('M d, Y') }}</p>|<p
                                 class="article-author">
                                 <a href="#">{{ $article->writer->name }}</a>
                             </p>
                             <h2>
                                 <a href="{{ route('singlePage', ['slug' => $article->slug]) }}">
                                     {{ $article->title }}
                                 </a>
                             </h2>

                         </div>
                     </div>
                 @empty
                 @endforelse

             </div>

             <div class="biography-right col-md-6">
                 @foreach ($section['articles'][1] ?? [] as $key => $article)
                     <figure class="textover">
                         <img src="{{ asset($article->image) }}" loading="lazy" alt="{{ $article->title }}"
                             class="image_img img-fluid">
                         <figcaption>
                             <a class="text-white" href="{{ route('singlePage', ['slug' => $article->slug]) }}">
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
                     <a href="{{ route('singlePage', ['slug' => $section['category']->slug]) }}" class="btn">View
                         All</a>
                 </h2>
             </div>
         </div>
     </div>
     <!-- Trending Section -->
     <div class="col-md-4 mt-4">
         <div class="heading">
             <div class="category-segment">
                 <span>{{ $section['second']['title'] }}</span>
             </div>
         </div>
         <div class="trending mt-3">
             @forelse ($section["second"]["articles"] as $article)
                 <div class="trending-single">
                     <div class="image">
                         <figure class="m-0">
                             <a href="{{ route('singlePage', ['slug' => $article->slug]) }}">
                                 <img src="{{ asset($article->image) }}" loading="lazy" alt="{{ $article->title }}"
                                     class="image_img img-fluid">
                             </a>
                         </figure>
                     </div>
                     <div class="trending-title">
                         <p class="article-date">{{ carbon($article->published_at)->format('M d, Y') }}</p>|<p
                             class="article-author">{{ $article->writer->name }}</p>

                         <h2>
                             <a class="" href="{{ route('singlePage', ['slug' => $article->slug]) }}">
                                 {{ $article->title }}
                             </a>
                         </h2>
                     </div>
                 </div>
             @empty

             @endforelse

         </div>
     </div>
 </section>
