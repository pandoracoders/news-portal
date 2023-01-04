<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ carbon()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>


    @foreach ($categories as $url)
        <url>
            <loc>{{ route('singleArticle', $url->slug) }}</loc>
            <lastmod>{{ $url->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    <url>
        <loc>{{ route('singleArticle', $privacy_policy->key) }}</loc>
        <lastmod>{{ carbon($privacy_policy->updated_at)->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route('singleArticle', $contact_us->key) }}</loc>
        <lastmod>{{ carbon($contact_us->updated_at)->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route('singleArticle', $about_us->key) }}</loc>
        <lastmod>{{ carbon($about_us->updated_at)->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>

    @foreach ($articles as $url)
        <url>
            <loc>{{ route('singleArticle', $url->slug) }}</loc>
            <lastmod>{{ $url->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

</urlset>
