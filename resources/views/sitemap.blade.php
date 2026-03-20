{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- Static Pages with individual priorities --}}
    @foreach($staticPages as $url)
        @php
            $path = parse_url($url, PHP_URL_PATH) ?? '/';
            $priority = match(true) {
                $path === '/' || $path === '' => '1.0',
                in_array($path, ['/about', '/services', '/destinations']) => '0.8',
                $path === '/coach-transportation' => '0.7',
                $path === '/contact' => '0.5',
                in_array($path, ['/privacy', '/terms']) => '0.3',
                default => '0.6',
            };
            $changefreq = in_array($path, ['/privacy', '/terms']) ? 'yearly' : 'weekly';
        @endphp
        <url>
            <loc>{{ $url }}</loc>
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>{{ $changefreq }}</changefreq>
            <priority>{{ $priority }}</priority>
        </url>
    @endforeach

    {{-- Category Pages --}}
    @foreach($categories as $category)
        <url>
            <loc>{{ route('package-category', $category->id) }}</loc>
            <lastmod>{{ ($category->updated_at ?? now())->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    {{-- Package Details --}}
    @foreach($packages as $package)
        <url>
            <loc>{{ route('package-details', $package->id) }}</loc>
            <lastmod>{{ ($package->updated_at ?? now())->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach

    {{-- Dynamic SEO Pages --}}
    @foreach($dynamicPages as $page)
        <url>
            <loc>{{ url($page->slug) }}</loc>
            <lastmod>{{ ($page->updated_at ?? now())->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach

    {{-- Blog Index --}}
    <url>
        <loc>{{ route('blog.index') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>

    {{-- Blog Posts --}}
    @foreach($blogs as $blog)
        <url>
            <loc>{{ route('blog.show', $blog->slug) }}</loc>
            <lastmod>{{ ($blog->updated_at ?? now())->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach

    {{-- Blog Categories --}}
    @foreach($blogCategories as $blogCategory)
        <url>
            <loc>{{ route('blog.category', $blogCategory->slug) }}</loc>
            <lastmod>{{ ($blogCategory->updated_at ?? now())->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.5</priority>
        </url>
    @endforeach

    {{-- Blog Tags --}}
    @foreach($blogTags as $blogTag)
        <url>
            <loc>{{ route('blog.tag', $blogTag->slug) }}</loc>
            <lastmod>{{ ($blogTag->updated_at ?? now())->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.4</priority>
        </url>
    @endforeach
</urlset>
