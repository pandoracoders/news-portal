@extends('frontend.layouts.index')


@push('styles')
    <style>
        .similar-post-section .row {
            display: flex !important;

        }

        .similar-post-section .row>[class*='col-'] {
            display: flex !important;
            flex-direction: row !important;
        }

        .instagram-media {
            margin: auto !important;
        }

        figcaption {
            text-align: center !important;
        }

        figure {
            display: block !important;
        }
    </style>
@endpush

@if ($article->tables)
    @include('frontend.pages.article.biography')
@else
    @include('frontend.pages.article.other')
@endif



@push('scripts')
    {{-- <script>
        $(document).ready(function() {
            $('.article-content img').addClass('img-fluid');
            $('.article-content img').addClass('img-thumbnail');
            $('.article-content img').addClass('mb-3');
            $('.article-content img').addClass('mx-auto');
            $('.article-content img').addClass('d-block');
        });
    </script> --}}

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
@endpush
