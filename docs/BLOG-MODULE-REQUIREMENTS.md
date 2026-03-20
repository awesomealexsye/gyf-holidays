# Blog Module — Implementation Requirements for Claude

**Purpose:** This document is a complete, actionable specification for Claude Code to build the blog module. Read `docs/BLOG-MODULE-PLAN.md` for the full design rationale. Read this file for exact implementation instructions.

**Important:** Before starting, read these files to understand existing patterns to follow:
- `CLAUDE.md` — project overview and commands
- `app/Http/Controllers/AdminController.php` — CRUD pattern for DynamicPages (copy this pattern for blogs)
- `resources/views/admin/pages/create.blade.php` — admin form styling + FAQ manager Alpine.js
- `resources/views/admin/pages/index.blade.php` — admin table styling
- `resources/views/pages/dynamic.blade.php` — public page with SEO schemas, breadcrumbs, FAQ accordion
- `resources/views/pages/package-details.blade.php` — 2/3 + 1/3 sidebar layout
- `resources/views/layouts/app.blade.php` — SEO meta tags, OG tags, schema stack
- `resources/views/layouts/admin.blade.php` — admin sidebar navigation
- `resources/views/components/navbar.blade.php` — `$navLinks` array
- `resources/views/components/footer.blade.php` — Quick Links list
- `resources/views/sitemap.blade.php` — XML sitemap template
- `app/Http/Controllers/SitemapController.php` — sitemap data queries
- `resources/css/app.css` — Tailwind theme colors and custom utilities

---

## CRITICAL RULES

1. **Route order:** All `/blog/*` routes MUST go ABOVE the `/{slug}` catch-all at the bottom of `web.php`.
2. **Admin form styling:** Match EXACTLY the existing pattern — `px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none` for inputs, `text-xs font-black uppercase tracking-widest text-gray-400` for labels, `bg-white rounded-[2rem] shadow-sm border border-gray-100` for cards, `gradient-primary` for submit buttons.
3. **No H1 in blog content:** TinyMCE must restrict to H2-H4. The blog title is the H1.
4. **Image optimization is frontend JS only:** Do NOT add any backend GD/Imagick image processing. The Alpine.js Canvas component handles resize/crop/WebP conversion in the browser before upload. Server just stores the file as-is.
5. **og:type fix:** Change line 19 of `layouts/app.blade.php` from `content="website"` to `content="@yield('og_type', 'website')"`.
6. **Storage:** Images go to `storage/app/public/blogs/featured/` (featured images) and `storage/app/public/blogs/content/` (TinyMCE inline images) via the `public` disk. Run `php artisan storage:link` if the symlink doesn't exist.
7. **Reuse blog-index view:** The category page and tag page reuse the same `blog-index.blade.php` view — pass different `$title`, `$description`, and optional `$category`/`$tag` variables to customize the hero and meta tags.
8. **Follow existing `@section`/`@yield` pattern for SEO** — see `dynamic.blade.php` for how it's done.
9. **Follow existing `@push('schema')` pattern for JSON-LD** — see `dynamic.blade.php` for BreadcrumbList, FAQPage patterns.
10. **Use `@json()` for Alpine.js data initialization** — see existing FAQ manager pattern.

---

## STEP 1: Migrations (4 files)

Create these 4 migration files. Use the current timestamp prefix.

### Migration 1: `create_blog_categories_table`

```php
Schema::create('blog_categories', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->text('description')->nullable();
    $table->string('meta_title')->nullable();
    $table->text('meta_description')->nullable();
    $table->timestamps();
});
```

### Migration 2: `create_blog_tags_table`

```php
Schema::create('blog_tags', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->timestamps();
});
```

### Migration 3: `create_blogs_table`

```php
Schema::create('blogs', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('slug')->unique();
    $table->text('excerpt')->nullable();
    $table->longText('content');
    $table->string('featured_image')->nullable();
    $table->foreignId('blog_category_id')->nullable()->constrained('blog_categories')->nullOnDelete();
    $table->string('author_name')->nullable();
    $table->string('meta_title')->nullable();
    $table->text('meta_description')->nullable();
    $table->string('meta_keywords')->nullable();
    $table->json('faqs')->nullable();
    $table->boolean('is_published')->default(false);
    $table->timestamp('published_at')->nullable();
    $table->boolean('is_active')->default(true);
    $table->timestamps();
});
```

### Migration 4: `create_blog_blog_tag_table`

```php
Schema::create('blog_blog_tag', function (Blueprint $table) {
    $table->foreignId('blog_id')->constrained()->cascadeOnDelete();
    $table->foreignId('blog_tag_id')->constrained()->cascadeOnDelete();
    $table->primary(['blog_id', 'blog_tag_id']);
});
```

---

## STEP 2: Models (3 files)

### `app/Models/Blog.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'featured_image',
        'blog_category_id', 'author_name', 'meta_title', 'meta_description',
        'meta_keywords', 'faqs', 'is_published', 'published_at', 'is_active',
    ];

    protected $casts = [
        'faqs' => 'array',
        'is_published' => 'boolean',
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(BlogTag::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->where('is_active', true)
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    public function getReadingTimeAttribute()
    {
        $words = str_word_count(strip_tags($this->content ?? ''));
        return max(1, ceil($words / 200));
    }
}
```

### `app/Models/BlogCategory.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'meta_title', 'meta_description'];

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
```

### `app/Models/BlogTag.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    protected $fillable = ['name', 'slug'];

    public function blogs()
    {
        return $this->belongsToMany(Blog::class);
    }
}
```

---

## STEP 3: Routes

Add to `routes/web.php`. Public blog routes go ABOVE the `/{slug}` catch-all. Admin blog routes go inside the existing `Route::middleware(['auth'])->prefix('admin')` group.

### Public Routes (add ABOVE `/{slug}` catch-all)

```php
// Blog
Route::get('/blog', [PageController::class, 'blogIndex'])->name('blog.index');
Route::get('/blog/category/{slug}', [PageController::class, 'blogCategory'])->name('blog.category');
Route::get('/blog/tag/{slug}', [PageController::class, 'blogTag'])->name('blog.tag');
Route::get('/blog/{slug}', [PageController::class, 'blogShow'])->name('blog.show');
```

### Admin Routes (add inside auth middleware group)

```php
// Blog Posts
Route::get('/blogs', [AdminController::class, 'blogs'])->name('admin.blogs');
Route::get('/blog/create', [AdminController::class, 'createBlog'])->name('admin.blog.create');
Route::post('/blog/store', [AdminController::class, 'storeBlog'])->name('admin.blog.store');
Route::get('/blog/{id}/edit', [AdminController::class, 'editBlog'])->name('admin.blog.edit');
Route::put('/blog/{id}', [AdminController::class, 'updateBlog'])->name('admin.blog.update');
Route::delete('/blog/{id}', [AdminController::class, 'deleteBlog'])->name('admin.blog.delete');
Route::post('/blog/upload-image', [AdminController::class, 'uploadBlogImage'])->name('admin.blog.upload-image');

// Blog Categories
Route::get('/blog-categories', [AdminController::class, 'blogCategories'])->name('admin.blog-categories');
Route::get('/blog-category/create', [AdminController::class, 'createBlogCategory'])->name('admin.blog-category.create');
Route::post('/blog-category/store', [AdminController::class, 'storeBlogCategory'])->name('admin.blog-category.store');
Route::get('/blog-category/{id}/edit', [AdminController::class, 'editBlogCategory'])->name('admin.blog-category.edit');
Route::put('/blog-category/{id}', [AdminController::class, 'updateBlogCategory'])->name('admin.blog-category.update');
Route::delete('/blog-category/{id}', [AdminController::class, 'deleteBlogCategory'])->name('admin.blog-category.delete');

// Blog Tags
Route::get('/blog-tags', [AdminController::class, 'blogTags'])->name('admin.blog-tags');
Route::get('/blog-tag/create', [AdminController::class, 'createBlogTag'])->name('admin.blog-tag.create');
Route::post('/blog-tag/store', [AdminController::class, 'storeBlogTag'])->name('admin.blog-tag.store');
Route::get('/blog-tag/{id}/edit', [AdminController::class, 'editBlogTag'])->name('admin.blog-tag.edit');
Route::put('/blog-tag/{id}', [AdminController::class, 'updateBlogTag'])->name('admin.blog-tag.update');
Route::delete('/blog-tag/{id}', [AdminController::class, 'deleteBlogTag'])->name('admin.blog-tag.delete');
```

---

## STEP 4: Admin Controller Methods

Add these methods to `app/Http/Controllers/AdminController.php`. Follow the exact same pattern as the existing `pages()`, `createPage()`, `storePage()`, `editPage()`, `updatePage()`, `deletePage()` methods.

### Blog Posts (7 methods)

- `blogs()` — `Blog::with('category')->latest('published_at')->paginate(10)`, return view `admin.blogs.index`
- `createBlog()` — pass `BlogCategory::all()` and `BlogTag::all()`, return view `admin.blogs.create`
- `storeBlog(Request $request)` — validate (see plan for rules), filter empty FAQs, store featured_image to `blogs/featured` disk `public` if present, create Blog, sync tags, redirect with success
- `editBlog($id)` — find Blog, pass with categories and tags, return view `admin.blogs.edit`
- `updateBlog($id, Request $request)` — validate (slug unique excludes $id), if new image delete old + store new, update Blog, sync tags, redirect with success
- `deleteBlog($id)` — delete featured_image from storage, detach tags, delete Blog, redirect with success
- `uploadBlogImage(Request $request)` — validate image file, store to `blogs/content` disk `public`, return JSON `{ "location": "/storage/blogs/content/filename" }` (TinyMCE format)

### Blog Categories (6 methods)

- `blogCategories()` — `BlogCategory::withCount('blogs')->paginate(10)`, return view `admin.blog-categories.index`
- `createBlogCategory()` — return view `admin.blog-categories.create`
- `storeBlogCategory(Request $request)` — validate name/slug/description/meta fields, create, redirect with success
- `editBlogCategory($id)` — find, return view `admin.blog-categories.edit`
- `updateBlogCategory($id, Request $request)` — validate (slug unique excludes $id), update, redirect
- `deleteBlogCategory($id)` — check `$category->blogs()->count()`, if > 0 redirect with error "Cannot delete category with existing posts", else delete

### Blog Tags (6 methods)

- `blogTags()` — `BlogTag::withCount('blogs')->paginate(10)`, return view `admin.blog-tags.index`
- `createBlogTag()` — return view `admin.blog-tags.create`
- `storeBlogTag(Request $request)` — validate name/slug, create, redirect
- `editBlogTag($id)` — find, return view `admin.blog-tags.edit`
- `updateBlogTag($id, Request $request)` — validate (slug unique excludes $id), update, redirect
- `deleteBlogTag($id)` — detach from all blogs via `$tag->blogs()->detach()`, delete tag, redirect

---

## STEP 5: Admin Views

### Blog Post Views (3 files)

Create `resources/views/admin/blogs/index.blade.php`, `create.blade.php`, `edit.blade.php`.

**index.blade.php:** Copy the structure from `admin/pages/index.blade.php`. Table columns: Title & Slug | Category | Status (Published=green badge, Draft=yellow badge) | Published Date | Actions (View external, Edit, Delete with JS confirm).

**create.blade.php:** Copy form structure from `admin/pages/create.blade.php`. Sections in order:
1. Basic Info (2-col grid): Title, Slug, Blog Category dropdown, Author Name
2. Featured Image: Alpine.js `imageOptimizer()` component with drag-drop zone, live 1200x630 preview, file size display. Helper text "Recommended: 1200 × 630px. Auto-resized and converted to WebP." (See BLOG-MODULE-PLAN.md Section 9 for full JS code)
3. Content: Excerpt textarea (3 rows) + Content textarea with `id="blog-content"` (TinyMCE replaces this)
4. Tags: Alpine.js multi-select badges. Each tag as clickable badge toggling between `bg-gray-100 text-gray-600` (unselected) and `bg-primary-100 text-primary-600 ring-2 ring-primary-600` (selected). Hidden checkbox inputs for form submission.
5. FAQ Section: Copy exact Alpine.js `faqManager()` from `admin/pages/create.blade.php`
6. SEO Configuration: Meta Title, Meta Description, Meta Keywords (same fields as pages)
7. Publishing: `is_published` checkbox toggle + `published_at` datetime-local input

Include TinyMCE CDN script and init at bottom in `@push('scripts')`. Include `imageOptimizer()` and `faqManager()` functions. Include auto-slug generation from title.

**edit.blade.php:** Same as create but:
- All fields use `old('field', $blog->field)` pattern
- Featured image section shows current image if exists, with option to replace
- Tags pre-selected: check `in_array($tag->id, old('tags', $blog->tags->pluck('id')->toArray()))`
- FAQs init: `@json(old('faqs', $blog->faqs ?? []))`
- Form uses `@method('PUT')`

### Blog Category Views (3 files)

Create `resources/views/admin/blog-categories/index.blade.php`, `create.blade.php`, `edit.blade.php`.

Simple forms — name, slug (auto-generate), description (textarea), meta_title, meta_description. Same styling as blog views. Index table: Name & Slug | Posts Count | Actions.

### Blog Tag Views (3 files)

Create `resources/views/admin/blog-tags/index.blade.php`, `create.blade.php`, `edit.blade.php`.

Simplest forms — just name and slug (auto-generate). Index table: Name & Slug | Posts Count | Actions.

---

## STEP 6: Public Controller Methods

Add to `app/Http/Controllers/PageController.php`:

### `blogIndex()`

```php
public function blogIndex()
{
    $blogs = Blog::published()
        ->with('category')
        ->latest('published_at')
        ->paginate(9);

    return view('pages.blog-index', [
        'blogs' => $blogs,
        'title' => 'Travel Blog',
        'description' => 'Travel tips, destination guides, and industry insights from GYF Holidays.',
    ]);
}
```

### `blogShow($slug)`

```php
public function blogShow($slug)
{
    $blog = Blog::where('slug', $slug)
        ->published()
        ->with(['category', 'tags'])
        ->firstOrFail();

    $relatedPosts = Blog::published()
        ->where('id', '!=', $blog->id)
        ->when($blog->blog_category_id, function ($q) use ($blog) {
            $q->where('blog_category_id', $blog->blog_category_id);
        })
        ->latest('published_at')
        ->take(3)
        ->get();

    return view('pages.blog-details', compact('blog', 'relatedPosts'));
}
```

### `blogCategory($slug)`

```php
public function blogCategory($slug)
{
    $category = BlogCategory::where('slug', $slug)->firstOrFail();

    $blogs = Blog::published()
        ->where('blog_category_id', $category->id)
        ->with('category')
        ->latest('published_at')
        ->paginate(9);

    return view('pages.blog-index', [
        'blogs' => $blogs,
        'category' => $category,
        'title' => $category->name,
        'description' => $category->meta_description ?? $category->description ?? 'Blog posts in ' . $category->name,
    ]);
}
```

### `blogTag($slug)`

```php
public function blogTag($slug)
{
    $tag = BlogTag::where('slug', $slug)->firstOrFail();

    $blogs = Blog::published()
        ->whereHas('tags', fn($q) => $q->where('blog_tags.id', $tag->id))
        ->with('category')
        ->latest('published_at')
        ->paginate(9);

    return view('pages.blog-index', [
        'blogs' => $blogs,
        'tag' => $tag,
        'title' => 'Tagged: ' . $tag->name,
        'description' => 'Blog posts tagged with ' . $tag->name,
    ]);
}
```

Add `use App\Models\Blog;`, `use App\Models\BlogCategory;`, `use App\Models\BlogTag;` imports.

---

## STEP 7: Public Blog Views

### `resources/views/pages/blog-index.blade.php`

- Extends `layouts.app`
- `@section('title')`: use `$category->meta_title` if category page, else `$title . ' - GYF Holidays'`
- `@section('meta_description')`: use provided `$description`
- `@section('meta_tags')`: add `rel="prev"` / `rel="next"` from pagination
- `@push('schema')`: CollectionPage JSON-LD
- Hero: `<x-hero :title="$title" :subtitle="$description" :showCTA="false" height="h-[400px]" />`
- Grid: `grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10` of blog cards
- Each card: featured image (h-52, object-cover, loading=lazy), category badge overlay, title, excerpt (Str::limit 120), published date + reading time footer
- Card links to `/blog/{{ $blog->slug }}`
- Featured image: `src="{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('logo.png') }}"`
- Pagination: `{{ $blogs->links() }}`

### `resources/views/pages/blog-details.blade.php`

- Extends `layouts.app`
- SEO sections: title, meta_description, meta_keywords, og_type ("article"), og_image
- `@section('meta_tags')`: article:published_time, article:modified_time, article:author, article:section, article:tag (loop)
- `@push('schema')`: BlogPosting JSON-LD, BreadcrumbList JSON-LD, FAQPage JSON-LD (if faqs)
- Hero: `<x-hero>` with featured image as background
- Breadcrumb: Home > Blog > {Title} (same pattern as dynamic.blade.php)
- 2/3 + 1/3 layout (same as package-details.blade.php):
  - Left (2/3): `<article id="blog-article">` with `prose prose-lg max-w-none` class on content div. Tags as linked badges below. Author info.
  - Right (1/3): Sticky sidebar with Table of Contents (Alpine.js auto-parsed from H2/H3), Related Posts cards, CTA card (Get Quote + WhatsApp)
- FAQ section below (if faqs exist) — same accordion as dynamic.blade.php
- CTA section at bottom — same dark CTA block as dynamic.blade.php

**Table of Contents Alpine.js:** Parse all `h2, h3` inside `#blog-article`, add IDs, generate anchor link list. H3 items indented with `pl-4`.

---

## STEP 8: Layout & Navigation Updates

### `resources/views/layouts/app.blade.php`

Line 19 — change:
```html
<meta property="og:type" content="website">
```
To:
```html
<meta property="og:type" content="@yield('og_type', 'website')">
```

### `resources/views/components/navbar.blade.php`

Add to `$navLinks` array between Coach and Transportation and Contact Us:
```php
['path' => '/blog', 'label' => 'Blog'],
```

### `resources/views/components/footer.blade.php`

Add to Quick Links `<ul>` after Coaches, before Contact Us:
```html
<li><a href="/blog" class="hover:text-primary-400 transition">Blog</a></li>
```

### `resources/views/layouts/admin.blade.php`

Add Blog section to sidebar nav between SEO Pages link and the external links section. Include sub-links for All Posts, Categories, Tags. Highlight active link based on current route.

---

## STEP 9: Sitemap Updates

### `app/Http/Controllers/SitemapController.php`

Add to `index()` method:
```php
$blogs = \App\Models\Blog::published()->get();
$blogCategories = \App\Models\BlogCategory::has('blogs')->get();
$blogTags = \App\Models\BlogTag::has('blogs')->get();
```

Pass to view.

### `resources/views/sitemap.blade.php`

Add after dynamic pages section:
- Blog index URL (priority 0.8, changefreq daily)
- Each blog post URL (priority 0.6, changefreq monthly, lastmod from updated_at)
- Each blog category URL with posts (priority 0.5, changefreq weekly)
- Each blog tag URL with posts (priority 0.4, changefreq weekly)

---

## STEP 10: Verify & Test

After building all files:

1. Run `php artisan migrate`
2. Run `php artisan storage:link` (if symlink doesn't exist)
3. Run `vendor/bin/pint` to format all new PHP files
4. Verify admin: create a category → create a tag → create a blog post with image + TinyMCE content + FAQs → verify listing and detail pages render correctly
5. Verify SEO: check page source for meta tags, OG tags, JSON-LD schemas, canonical URL, breadcrumbs
6. Verify sitemap: visit `/sitemap.xml` and confirm blog URLs appear
7. Verify navigation: Blog link visible in navbar and footer
