{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- Static Pages --}}
    @foreach($staticPages as $url)
        <url>
            <loc>{{ $url }}</loc>
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    {{-- Category Pages --}}
    @foreach($categories as $category)
        <url>
            <loc>{{ route('package-category', $category->id) }}</loc>
            <lastmod>{{ ($category->updated_at ?? now())->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach

    {{-- Package Details --}}
    @foreach($packages as $package)
        <url>
            <loc>{{ route('package-details', $package->id) }}</loc>
            <lastmod>{{ ($package->updated_at ?? now())->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach

    {{-- Dynamic SEO Pages --}}
    @foreach($dynamicPages as $page)
        <url>
            <loc>{{ url($page->slug) }}</loc>
            <lastmod>{{ ($page->updated_at ?? now())->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach
</urlset>
