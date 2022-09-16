@extends('frontend.layouts.index', [
    'meta_title' => $author->alias_name,
    'meta_description' => "All the articles from {$author->alias_name}",
    'meta_keyword' => getSettingValue('meta_keyword'),
    'image' => getSettingValue('logo'),
    'type' => 'website'
])

@push('styles')
    <link rel="stylesheet" href="{{ asset('') }}frontend/css/category.min.css" type="text/css">



@endpush


@section('content')
    <main class="container">
        <!-- BreadCrumb -->
        <div class="bc">
            <ul class="breadcrumb-container">
                <li class="breadcrumb">
                    <a href="{{ url('/') }}">
                        <span>Home</span>
                    </a>
                </li>
                ⇢
                <li class="breadcrumb active">
                    <span class="text-capitalize">
                        {{ $author->alias_name }}
                    </span>
                </li>
            </ul>
        </div>

        <section class="category-div">
            <div class="container category-title">
                <h1 class="text-capitalize">All Posts from
                    <span class="colored">
                        {{ $author->alias_name }}
                    </span>
                </h1>
            </div>
        </section>

        <!-- List -->
        <section class="category-section">
            <div class="container">
                @include('frontend.pages.articles', [
                    'articles' => $author->articles()->limit(9)->get(),
                ])

            </div>
        </section>
    </main>
@endsection

@push('scripts')
<script>
    var page = 1;
    var loading = 0;
    var extra = 500;
    window.onscroll = function() {
        const scrollContent = document.getElementById('scroll-content');
        if (window.innerHeight + window.scrollY > scrollContent.offsetHeight - extra && loading === 0) {
            // extra = 0;
            loading = 1;
            fetch("{{ route('authorArticles', $author->slug) }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        "X-Requested-With": "XMLHttpRequest",
                        'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        page,
                    })
                })
                .then(response => response.json())
                .then(d => {

                    if (d && d.length > 0) {
                        // var r = d.data;
                        var html = '';

                        for (let index = 0; index < d.length; index++) {
                            html += `<div class="col-md-6 col-lg-4 mb-1 single-post">`;
                            html +=
                                '<div class="category-post">';
                            html += '<div class="image">';
                            html += '<figure class="m-0">';
                            html += '<a href="' + d[index].url + '">';
                            html += '<img src="' + d[index].image + '" alt="" class="image_img img-fluid">';
                            html += '</a>';
                            html += '</figure>';
                            html += '</div>';
                            html +=
                                '<div class="category-post-title">';
                            html += '<div class="title mb-3">';
                            html += '<a href="' + d[index].url + '">';
                            html += d[index].title;
                            html += '</a>';
                            html += '</div>';
                            html += '<div class="meta"><p class = "article-date" >' + d[index]
                                .published_at + ' | </p>';
                            html += '<p class="article-author">';
                            html += '<a href="' + d[index].author.url + '"> ' + d[index].author.name +
                                '</a></p>';

                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                        }


                        scrollContent.insertAdjacentHTML('beforeend', html);
                        page++;
                        loading = 0;
                    }
                })
        }
    }
</script>
@endpush

