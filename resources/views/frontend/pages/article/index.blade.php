@extends('frontend.layouts.index', [
    'meta_title' => $article->seo->meta_title,
    'meta_description' => $article->seo->meta_description,
    'meta_keyword' => $article->seo->meta_keyword,
    'image' => $article->image,
    'type' => 'article',
])


@push('schema')
    {!! $article->schema !!}
@endpush

@push('head')
    <meta name="article:author" content="{{ $article->author->alias_name }}">
    <meta name="article:published_time" content="{{ $article->published_at }}">
    <meta property="og:article:published_time" content="{{ $article->published_at }}">
@endpush

@section('content')
    @if ($article->tables)
        @include('frontend.pages.article.biography')
    @else
        @include('frontend.pages.article.other')
    @endif
@endsection



@push('scripts')
    <script async src="//www.instragram.com/embed.js"></script>
    <script async src="https://platform.twitter.com/widgets.js"></script>

    <script>
        var headingList = document.querySelector('.content-detail').querySelectorAll("h2,h3,h4,h5,h6");
        var contentSection = document.querySelector('.list');

        // Slugify function
        function string_to_slug(str) {
            str = str.toLowerCase().trim();
            str = str.replace(/\s+/g, '-') // collapse whitespace and replace by -
                .replace(/-+/g, '-'); // collapse dashes

            return str;
        }

        if (headingList.length == 0) {
            document.querySelector('.table-of-contents').style = "display:none;"
        }

        for (var i = 0; i < headingList.length; i++) {
            if (headingList[i].localName == 'h2') {
                var slug = string_to_slug(headingList[i].innerText);
                headingList[i].id = `${slug}`
                contentSection.innerHTML += `<li class="head-2"><a href="#${slug}">${headingList[i].innerText}</a></li>`
            } else if (headingList[i].localName == 'h3') {
                var slug = string_to_slug(headingList[i].innerText);
                contentSection.innerHTML += `<li class="head-3"><a href="#${slug}">${headingList[i].innerText}</a></li>`
                headingList[i].id = `${slug}`
            } else if (headingList[i].localName == 'h4') {
                var slug = string_to_slug(headingList[i].innerText);
                contentSection.innerHTML += `<li class="head-4"><a href="#${slug}">${headingList[i].innerText}</a></li>`
                headingList[i].id = `${slug}`
            } else if (headingList[i].localName == 'h5') {
                var slug = string_to_slug(headingList[i].innerText);
                contentSection.innerHTML += `<li class="head-5"><a href="#${slug}">${headingList[i].innerText}</a></li>`
                headingList[i].id = `${slug}`
            } else if (headingList[i].localName == 'h6') {
                var slug = string_to_slug(headingList[i].innerText);
                contentSection.innerHTML += `<li class="head-6"><a href="#${slug}">${headingList[i].innerText}</a></li>`
                headingList[i].id = `${slug}`
            }
        }
    </script>

    <script>
        fetch("{{ route('ajaxyouMayAlsoLike', $article->id) }}")
            .then(res => res.json())
            .then(res => {
                console.log(res)
                document.querySelector('.sidebar-section-wrap').innerHTML = res.data.youMayAlsoLike;
                document.querySelector('.similar-post-section').innerHTML = res.data.more;

                // document.querySelector('.view-count').innerHTML = res.value;
            })
    </script>


    <script>
        if (window) {

            window.ajax_url = "{{ route('categoryArticles', $article->category->slug) }}";
            window.col_lg = 3;
        }
    </script>
@endpush
