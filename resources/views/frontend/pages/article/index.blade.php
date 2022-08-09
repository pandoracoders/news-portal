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
    </style>
@endpush

@if ($article->category->slug == 'biography')
    @include('frontend.pages.article.biography')
@else
    @include('frontend.pages.article.other')
@endif



@push('scripts')
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
