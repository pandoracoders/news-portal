<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ carbon()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    {{-- @foreach ($static_routes as $url)
        <url>
            <loc>{{ route('singleArticle', $url) }}</loc>
            <lastmod>{{ carbon('2022-2-2')->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach --}}

    @foreach ($category as $url)
        <url>
            <loc>{{ route('singleArticle', $url->slug) }}</loc>
            <lastmod>{{ $url->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    @foreach ($tags as $url)
        <url>
            <loc>{{ route('singleArticle', $url->slug) }}</loc>
            <lastmod>{{ $url->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    @foreach ($articles as $url)
        <url>
            <loc>{{ route('singleArticle', $url->slug) }}</loc>
            <lastmod>{{ $url->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

</urlset>
