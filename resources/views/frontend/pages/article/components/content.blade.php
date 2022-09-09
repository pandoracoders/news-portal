@if ($article->tables)
        @include('frontend.pages.article.biography')
    @else
        @include('frontend.pages.article.other')
@endif
