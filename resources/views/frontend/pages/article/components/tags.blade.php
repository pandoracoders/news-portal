<div class="tags">
    @foreach ($article->tags as $tag)
        <div class="single-tag">
            <a href="{{ route('tags', $tag->slug) }}"># {{ $tag->original_title }}</a>
        </div>
    @endforeach
</div>
