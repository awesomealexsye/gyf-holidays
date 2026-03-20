# Blog Module — Complete Implementation Plan

**Project:** GYF Holidays Laravel App
**Date:** 2026-03-20
**Goal:** Add a full blog module with SEO-optimized categories, tags, rich text editor, frontend image optimization, and structured data for Google rankings.

---

## Table of Contents

1. [Overview](#1-overview)
2. [Database Schema](#2-database-schema)
3. [Models & Relationships](#3-models--relationships)
4. [Routes](#4-routes)
5. [Admin — Blog Posts CRUD](#5-admin--blog-posts-crud)
6. [Admin — Blog Categories CRUD](#6-admin--blog-categories-crud)
7. [Admin — Blog Tags CRUD](#7-admin--blog-tags-crud)
8. [Rich Text Editor — TinyMCE](#8-rich-text-editor--tinymce)
9. [Frontend Image Optimization (JS Canvas)](#9-frontend-image-optimization-js-canvas)
10. [Public Pages — Blog Listing](#10-public-pages--blog-listing)
11. [Public Pages — Blog Detail](#11-public-pages--blog-detail)
12. [Public Pages — Category & Tag Pages](#12-public-pages--category--tag-pages)
13. [SEO — Complete Checklist](#13-seo--complete-checklist)
14. [Navigation Updates](#14-navigation-updates)
15. [Sitemap Updates](#15-sitemap-updates)
16. [File List — All Files to Create/Edit](#16-file-list--all-files-to-createedit)
17. [Execution Order](#17-execution-order)

---

## 1. Overview

The blog module adds a content marketing layer to GYF Holidays for SEO ranking. It follows the existing codebase patterns:

- **Admin CRUD** — same pattern as `AdminController` DynamicPage management
- **Blade views** — same styling (rounded-[2rem] cards, gray-50 inputs, primary-600 accents, Alpine.js interactivity)
- **SEO** — same `@section`/`@yield` meta tag system, `@push('schema')` for JSON-LD, same layout
- **Image handling** — frontend JS Canvas optimization (not backend GD), converting to WebP before upload

### Key Decision: Frontend Image Optimization Over Backend

We chose **browser-side Canvas API** over server-side GD processing because:

- Only admin users upload — modern browsers guaranteed
- Upload is instant (~50KB WebP vs 3-10MB raw JPEG over network)
- Browser auto-fixes EXIF rotation from phone photos — no PHP code needed
- Admin sees **live preview of the exact 1200x630 crop** before submitting
- Zero server CPU load for image processing
- No extra PHP dependency needed

---

## 2. Database Schema

### 2.1 `blog_categories` table

```
| Column           | Type              | Notes                              |
|------------------|-------------------|------------------------------------|
| id               | bigIncrements     | PK                                 |
| name             | string(255)       | required — "Travel Tips"           |
| slug             | string, unique    | required — "travel-tips"           |
| description      | text, nullable    | For category page content          |
| meta_title       | string(255), null | Custom SEO title                   |
| meta_description | text, nullable    | Custom meta description            |
| timestamps       |                   | created_at, updated_at             |
```

### 2.2 `blog_tags` table

```
| Column     | Type              | Notes                        |
|------------|-------------------|------------------------------|
| id         | bigIncrements     | PK                           |
| name       | string(255)       | required — "Visa Tips"       |
| slug       | string, unique    | required — "visa-tips"       |
| timestamps |                   | created_at, updated_at       |
```

### 2.3 `blogs` table

```
| Column            | Type              | Notes                                      |
|-------------------|-------------------|--------------------------------------------|
| id                | bigIncrements     | PK                                         |
| title             | string(255)       | required — H1 of the blog post             |
| slug              | string, unique    | required — URL-friendly "best-europe-trips" |
| excerpt           | text, nullable    | Short summary for cards & meta fallback     |
| content           | longText          | Rich HTML from TinyMCE editor              |
| featured_image    | string, nullable  | Path to optimized WebP image               |
| blog_category_id  | FK, nullable      | FK to blog_categories table                |
| author_name       | string(255), null | Display name for E-E-A-T signal            |
| meta_title        | string(255), null | Custom SEO title                           |
| meta_description  | text, nullable    | Custom meta description                    |
| meta_keywords     | string, nullable  | Target keywords                            |
| faqs              | json, nullable    | FAQ Q&A pairs for rich snippets            |
| is_published      | boolean           | default false — draft/published toggle     |
| published_at      | timestamp, null   | Controls publish date for sorting/SEO      |
| is_active         | boolean           | default true — soft visibility toggle      |
| timestamps        |                   | created_at, updated_at                     |
```

### 2.4 `blog_blog_tag` pivot table

```
| Column      | Type         | Notes                    |
|-------------|--------------|--------------------------|
| blog_id     | FK           | FK to blogs table        |
| blog_tag_id | FK           | FK to blog_tags table    |
```

Composite unique index on `(blog_id, blog_tag_id)`.

---

## 3. Models & Relationships

### 3.1 `Blog` model

**File:** `app/Models/Blog.php`

```php
// Fillable
'title', 'slug', 'excerpt', 'content', 'featured_image',
'blog_category_id', 'author_name', 'meta_title', 'meta_description',
'meta_keywords', 'faqs', 'is_published', 'published_at', 'is_active'

// Casts
'faqs'         => 'array',
'is_published' => 'boolean',
'is_active'    => 'boolean',
'published_at' => 'datetime',

// Relationships
belongsTo(BlogCategory::class)
belongsToMany(BlogTag::class)

// Scopes
scopePublished($q) → where('is_published', true)
                     ->where('is_active', true)
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now())

// Accessors
getReadingTimeAttribute() → ceil(str_word_count(strip_tags($this->content)) / 200)
```

### 3.2 `BlogCategory` model

**File:** `app/Models/BlogCategory.php`

```php
// Fillable
'name', 'slug', 'description', 'meta_title', 'meta_description'

// Relationships
hasMany(Blog::class)
```

### 3.3 `BlogTag` model

**File:** `app/Models/BlogTag.php`

```php
// Fillable
'name', 'slug'

// Relationships
belongsToMany(Blog::class)
```

---

## 4. Routes

### 4.1 Public Routes

Add to `routes/web.php` — **ABOVE the `/{slug}` catch-all route**.

```php
// Blog public routes
Route::get('/blog', [PageController::class, 'blogIndex'])->name('blog.index');
Route::get('/blog/category/{slug}', [PageController::class, 'blogCategory'])->name('blog.category');
Route::get('/blog/tag/{slug}', [PageController::class, 'blogTag'])->name('blog.tag');
Route::get('/blog/{slug}', [PageController::class, 'blogShow'])->name('blog.show');
```

### 4.2 Admin Routes

Add inside the existing `Route::middleware(['auth'])->prefix('admin')` group:

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

## 5. Admin — Blog Posts CRUD

### 5.1 Controller Methods (in `AdminController`)

**`blogs()`** — List all blogs, paginated (10/page), ordered by `published_at desc`. Show title, category, status badge (Published green / Draft yellow), published date, actions.

**`createBlog()`** — Load create form with `$categories = BlogCategory::all()` and `$tags = BlogTag::all()`.

**`storeBlog(Request $request)`**
- Validation rules:
  - `title` → required|string|max:255
  - `slug` → required|string|unique:blogs
  - `excerpt` → nullable|string
  - `content` → required|string
  - `featured_image` → nullable|file|max:10240 (10MB — allows large because JS already optimized it to WebP)
  - `blog_category_id` → nullable|exists:blog_categories,id
  - `author_name` → nullable|string|max:255
  - `meta_title` → nullable|string|max:255
  - `meta_description` → nullable|string
  - `meta_keywords` → nullable|string
  - `faqs` → nullable|array
  - `faqs.*.question` → required_with:faqs|string
  - `faqs.*.answer` → required_with:faqs|string
  - `tags` → nullable|array
  - `tags.*` → exists:blog_tags,id
  - `is_published` → boolean
  - `published_at` → nullable|date
- Filter empty FAQs (same pattern as DynamicPage `storePage`)
- Store featured_image to `blogs/featured/` via `public` disk if present
- Create blog record
- Sync tags via `$blog->tags()->sync($request->tags ?? [])`
- Redirect to `admin.blogs` with success message

**`editBlog($id)`** — Load blog with category/tag data for form pre-fill.

**`updateBlog($id)`** — Same as store but:
- Slug unique check excludes current ID
- If new featured_image uploaded, delete old one from storage, store new one
- Sync tags

**`deleteBlog($id)`** — Delete featured image from storage, detach tags, delete record.

**`uploadBlogImage(Request $request)`** — For TinyMCE inline images:
- Accept image file, store to `blogs/content/` via `public` disk
- Return JSON: `{ "location": "/storage/blogs/content/filename.webp" }`
- TinyMCE expects this response format

### 5.2 Admin Blog Views

#### `resources/views/admin/blogs/index.blade.php`

Table with columns:

| Title & Slug | Category | Status | Published Date | Actions |
|--------------|----------|--------|----------------|---------|
| Post title + `/blog/{slug}` link | Category name or "—" | Green "Published" / Yellow "Draft" badge | Formatted date or "—" | View (external link) · Edit · Delete |

Same styling as `admin/pages/index.blade.php`. Include "Create New Post" gradient button at top.

#### `resources/views/admin/blogs/create.blade.php`

Form sections (matching existing admin form styling):

**Section 1 — Basic Info (2-column grid):**
- Title (required text input)
- URL Slug (text input with auto-generate from title via JS)
- Blog Category (dropdown from `$categories`)
- Author Name (text input)

**Section 2 — Featured Image:**
- Alpine.js image optimizer component (see Section 9)
- Helper text: "Recommended: 1200 × 630px. Auto-resized and converted to WebP."
- Drag & drop zone + file input
- Live preview of the 1200×630 crop with file size display

**Section 3 — Content:**
- Excerpt (textarea, 3 rows)
- Content (textarea with `id="blog-content"`, replaced by TinyMCE — see Section 8)

**Section 4 — Tags:**
- Multi-checkbox or multi-select from `$tags`
- Each tag as a clickable badge: unselected = `bg-gray-100 text-gray-600`, selected = `bg-primary-100 text-primary-600`
- Alpine.js toggle: `x-data="{ selectedTags: [] }"`
- Hidden inputs for each selected tag

**Section 5 — FAQ Section:**
- Same Alpine.js `faqManager()` pattern from `admin/pages/create.blade.php`
- Dynamic add/remove FAQ pairs

**Section 6 — SEO Configuration:**
- Meta Title (text input)
- Meta Description (textarea, 3 rows)
- Meta Keywords (text input, comma-separated)

**Section 7 — Publishing:**
- `is_published` toggle (checkbox styled as toggle switch)
- `published_at` date picker (datetime-local input)
- Helper text: "Leave unpublished to save as draft"

#### `resources/views/admin/blogs/edit.blade.php`

Same layout as create but:
- All fields pre-filled with `old('field', $blog->field)` pattern
- Featured image section shows current image with "Replace" option
- Tags pre-selected from `$blog->tags->pluck('id')->toArray()`
- FAQs initialized with `@json(old('faqs', $blog->faqs ?? []))`
- PUT method via `@method('PUT')`

---

## 6. Admin — Blog Categories CRUD

### 6.1 Controller Methods

**`blogCategories()`** — List all categories with blog count, paginated.

**`createBlogCategory()`** — Simple form.

**`storeBlogCategory(Request $request)`**
- Validation: `name` required|string|max:255, `slug` required|string|unique:blog_categories, `description` nullable|string, `meta_title` nullable|string|max:255, `meta_description` nullable|string

**`editBlogCategory($id)`** — Load category.

**`updateBlogCategory($id)`** — Same validation, slug unique excludes current ID.

**`deleteBlogCategory($id)`** — Check if category has posts. If yes, show error "Cannot delete category with existing posts." If no, delete.

### 6.2 Admin Category Views

#### `resources/views/admin/blog-categories/index.blade.php`

Table: Name & Slug | Posts Count | Actions (Edit · Delete)
"Create New Category" gradient button at top.

#### `resources/views/admin/blog-categories/create.blade.php`

Simple form:
- Name (required)
- Slug (auto-generate from name)
- Description (textarea)
- Meta Title
- Meta Description

#### `resources/views/admin/blog-categories/edit.blade.php`

Same as create, pre-filled.

---

## 7. Admin — Blog Tags CRUD

### 7.1 Controller Methods

**`blogTags()`** — List all tags with post count, paginated.

**`createBlogTag()`** — Simple form.

**`storeBlogTag(Request $request)`** — Validation: `name` required|string|max:255, `slug` required|string|unique:blog_tags.

**`editBlogTag($id)`** — Load tag.

**`updateBlogTag($id)`** — Same validation, slug unique excludes current ID.

**`deleteBlogTag($id)`** — Detach from all blogs, then delete.

### 7.2 Admin Tag Views

#### `resources/views/admin/blog-tags/index.blade.php`

Table: Name & Slug | Posts Count | Actions (Edit · Delete)
"Create New Tag" gradient button at top.

#### `resources/views/admin/blog-tags/create.blade.php`

Simple form: Name + Slug (auto-generate).

#### `resources/views/admin/blog-tags/edit.blade.php`

Same as create, pre-filled.

---

## 8. Rich Text Editor — TinyMCE

### Why TinyMCE

- Free self-hosted CDN version, no API key required
- Clean HTML output, good heading structure
- Built-in image upload handler
- Works with Blade forms

### Integration

Load TinyMCE **only in admin blog create/edit views** (not globally):

```html
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
```

### Configuration

```javascript
tinymce.init({
    selector: '#blog-content',
    plugins: 'lists link image table code wordcount autolink media',
    toolbar: 'undo redo | blocks | bold italic | bullist numlist | link image blockquote table | code',
    block_formats: 'Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4',
    height: 500,
    menubar: false,
    branding: false,
    images_upload_url: '/admin/blog/upload-image',
    images_upload_credentials: true,
    automatic_uploads: true,
    content_style: 'body { font-family: Poppins, sans-serif; font-size: 16px; line-height: 1.8; }',
    setup: function(editor) {
        // Sync content to textarea before form submit
        editor.on('change', function() {
            editor.save();
        });
    }
});
```

### Key Config Decisions

| Setting | Value | Reason |
|---------|-------|--------|
| `block_formats` | H2, H3, H4 only | H1 is the blog title — no H1 in body content |
| `images_upload_url` | `/admin/blog/upload-image` | Server stores inline images |
| `automatic_uploads` | true | Images pasted/dropped upload immediately |
| `menubar` | false | Cleaner UI, toolbar is sufficient |
| `height` | 500 | Comfortable writing area |

### TinyMCE Inline Image Upload — JS Canvas Optimization

Override `images_upload_handler` in TinyMCE config to optimize inline images before uploading:

```javascript
images_upload_handler: function(blobInfo, progress) {
    return new Promise((resolve, reject) => {
        const img = new Image();
        img.onload = function() {
            const canvas = document.createElement('canvas');
            const MAX_WIDTH = 800;
            let width = img.width;
            let height = img.height;

            if (width > MAX_WIDTH) {
                height = Math.round((height * MAX_WIDTH) / width);
                width = MAX_WIDTH;
            }

            canvas.width = width;
            canvas.height = height;
            canvas.getContext('2d').drawImage(img, 0, 0, width, height);

            canvas.toBlob(function(blob) {
                const formData = new FormData();
                formData.append('file', blob, 'image.webp');
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

                fetch('/admin/blog/upload-image', {
                    method: 'POST',
                    body: formData,
                    credentials: 'same-origin'
                })
                .then(res => res.json())
                .then(json => resolve(json.location))
                .catch(() => reject('Image upload failed'));
            }, 'image/webp', 0.80);
        };
        img.src = URL.createObjectURL(blobInfo.blob());
    });
}
```

This ensures even images pasted into the editor body are optimized to WebP, max 800px wide, before uploading.

---

## 9. Frontend Image Optimization (JS Canvas)

### Why Frontend Instead of Backend

| Factor | Frontend JS (Canvas API) | Backend GD |
|--------|--------------------------|------------|
| Server load | Zero — browser does all work | CPU spike on every upload |
| Upload size | Small (~50-80KB WebP sent) | Large (3-10MB raw JPEG sent, then processed) |
| Upload speed | Fast (small file over network) | Slow (big file over network) |
| EXIF rotation | Browser auto-fixes when drawing to Canvas | Need manual EXIF read + rotate in PHP |
| Preview | Live preview of exact crop before submit | No preview |
| Dependency | Zero — native browser API | GD extension |
| Security risk | None — admin panel only, modern browsers | N/A |

### Alpine.js Image Optimizer Component

This component is used in the blog create/edit forms for featured image upload:

```javascript
function imageOptimizer() {
    return {
        imagePreview: null,
        optimizedBlob: null,
        fileSize: null,
        dragOver: false,

        TARGET_WIDTH: 1200,
        TARGET_HEIGHT: 630,
        WEBP_QUALITY: 0.82,

        handleFile(file) {
            if (!file || !file.type.startsWith('image/')) return;

            const img = new Image();
            img.onload = () => {
                // Smart center crop to 1200x630
                const canvas = document.createElement('canvas');
                canvas.width = this.TARGET_WIDTH;
                canvas.height = this.TARGET_HEIGHT;
                const ctx = canvas.getContext('2d');

                const targetRatio = this.TARGET_WIDTH / this.TARGET_HEIGHT;
                const imgRatio = img.width / img.height;

                let sx, sy, sw, sh;
                if (imgRatio > targetRatio) {
                    // Image is wider — crop sides
                    sh = img.height;
                    sw = img.height * targetRatio;
                    sx = (img.width - sw) / 2;
                    sy = 0;
                } else {
                    // Image is taller — crop top/bottom
                    sw = img.width;
                    sh = img.width / targetRatio;
                    sx = 0;
                    sy = (img.height - sh) / 2;
                }

                ctx.drawImage(img, sx, sy, sw, sh, 0, 0, this.TARGET_WIDTH, this.TARGET_HEIGHT);

                // Convert to WebP
                canvas.toBlob((blob) => {
                    this.optimizedBlob = blob;
                    this.imagePreview = URL.createObjectURL(blob);
                    this.fileSize = (blob.size / 1024).toFixed(1); // KB

                    // Replace the file input with the optimized blob
                    const dataTransfer = new DataTransfer();
                    const optimizedFile = new File([blob], 'featured-image.webp', { type: 'image/webp' });
                    dataTransfer.items.add(optimizedFile);
                    this.$refs.fileInput.files = dataTransfer.files;
                }, 'image/webp', this.WEBP_QUALITY);
            };
            img.src = URL.createObjectURL(file);
        },

        handleDrop(event) {
            this.dragOver = false;
            const file = event.dataTransfer.files[0];
            this.handleFile(file);
        },

        handleInput(event) {
            const file = event.target.files[0];
            this.handleFile(file);
        }
    };
}
```

### Admin Form HTML for Featured Image

```html
<div x-data="imageOptimizer()">
    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">
        Featured Image
    </label>
    <p class="text-xs text-gray-400 mb-3">
        Recommended: 1200 × 630px. Auto-resized and converted to WebP on selection.
    </p>

    <!-- Drop Zone -->
    <div
        @dragover.prevent="dragOver = true"
        @dragleave="dragOver = false"
        @drop.prevent="handleDrop($event)"
        @click="$refs.fileInput.click()"
        class="border-2 border-dashed rounded-2xl p-8 text-center cursor-pointer transition-all"
        :class="dragOver ? 'border-primary-400 bg-primary-50' : 'border-gray-300 hover:border-primary-400'"
    >
        <template x-if="!imagePreview">
            <div>
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3">...</svg>
                <p class="text-gray-500 font-bold">Drop image here or click to browse</p>
                <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP up to 10MB</p>
            </div>
        </template>
        <template x-if="imagePreview">
            <div>
                <img :src="imagePreview" class="w-full max-w-lg h-52 object-cover rounded-xl mx-auto">
                <p class="text-sm text-green-600 font-bold mt-3">
                    ✓ Resized to 1200×630 · WebP · <span x-text="fileSize"></span> KB
                </p>
            </div>
        </template>
    </div>

    <input type="file" name="featured_image" x-ref="fileInput" @change="handleInput($event)"
           accept="image/jpeg,image/png,image/webp,image/gif" class="hidden">
</div>
```

### Size Comparison (Expected Results)

| Upload Scenario | Before (raw) | After (optimized) |
|-----------------|--------------|-------------------|
| Phone photo 4000×3000 JPEG | 3-5 MB | 45-80 KB WebP |
| DSLR photo 6000×4000 JPEG | 8-12 MB | 50-90 KB WebP |
| Canva graphic 1200×630 PNG | 500 KB-2 MB | 30-60 KB WebP |
| Small image 800×400 JPEG | 100 KB | 25-40 KB WebP |

---

## 10. Public Pages — Blog Listing

### `resources/views/pages/blog-index.blade.php`

**Controller:** `PageController::blogIndex()` — `Blog::published()->with('category')->latest('published_at')->paginate(9)`

**Layout:**

```
┌─────────────────────────────────────────────────────┐
│  HERO: "Travel Blog" / "Insights & Travel Tips"     │
│  <x-hero> component, h-[400px]                      │
├─────────────────────────────────────────────────────┤
│  3-column grid of blog cards (9 per page)            │
│                                                      │
│  ┌──────────┐  ┌──────────┐  ┌──────────┐          │
│  │ Featured │  │ Featured │  │ Featured │          │
│  │  Image   │  │  Image   │  │  Image   │          │
│  │ h-52     │  │ h-52     │  │ h-52     │          │
│  ├──────────┤  ├──────────┤  ├──────────┤          │
│  │ Category │  │ Category │  │ Category │          │
│  │ badge    │  │ badge    │  │ badge    │          │
│  │          │  │          │  │          │          │
│  │ Title    │  │ Title    │  │ Title    │          │
│  │ Excerpt  │  │ Excerpt  │  │ Excerpt  │          │
│  │          │  │          │  │          │          │
│  │ Date ·   │  │ Date ·   │  │ Date ·   │          │
│  │ Read time│  │ Read time│  │ Read time│          │
│  └──────────┘  └──────────┘  └──────────┘          │
│                                                      │
│           ← 1  2  3  4  ... →                        │
│         (Pagination with rel next/prev)              │
└─────────────────────────────────────────────────────┘
```

**Card design** — same style as package cards in `dynamic.blade.php`:
- `bg-white rounded-[2.5rem] shadow-xl shadow-gray-200/30 overflow-hidden group hover:shadow-2xl transition-all`
- Featured image: `h-52 object-cover` with `loading="lazy"` and `alt="{{ $blog->title }}"`
- Category badge: `absolute top-6 left-6 bg-white/95 backdrop-blur px-4 py-2 rounded-2xl text-xs font-black text-primary-600`
- Title: `text-xl font-black text-gray-900 group-hover:text-primary-600`
- Excerpt: `text-gray-500 text-sm` — `Str::limit($blog->excerpt, 120)`
- Footer: `Published date · {{ $blog->reading_time }} min read`
- Link wraps entire card: `/blog/{{ $blog->slug }}`

**SEO sections:**
```blade
@section('title', 'Travel Blog - GYF Holidays')
@section('meta_description', 'Travel tips, destination guides, and industry insights from GYF Holidays.')

@section('meta_tags')
@if($blogs->previousPageUrl())
<link rel="prev" href="{{ $blogs->previousPageUrl() }}">
@endif
@if($blogs->nextPageUrl())
<link rel="next" href="{{ $blogs->nextPageUrl() }}">
@endif
@endsection

@push('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "CollectionPage",
    "name": "GYF Holidays Travel Blog",
    "description": "Travel tips, destination guides, and industry insights.",
    "url": "{{ route('blog.index') }}"
}
</script>
@endpush
```

---

## 11. Public Pages — Blog Detail

### `resources/views/pages/blog-details.blade.php`

**Controller:** `PageController::blogShow($slug)` — Load blog with category + tags. Load related posts (same category, limit 3, exclude current). Return 404 if not published.

**Layout — 2/3 Article + 1/3 Sidebar** (same pattern as `package-details.blade.php`):

```
┌─────────────────────────────────────────────────────┐
│  HERO: Featured image background, h-[450px]          │
│  <x-hero> with blog title (H1), category badge       │
│  Published date · Author · Reading time              │
├─────────────────────────────────────────────────────┤
│  Breadcrumb: Home > Blog > {Title}                   │
├────────────────────────────┬────────────────────────┤
│                            │                        │
│  ARTICLE (2/3 width)       │  SIDEBAR (1/3 width)   │
│  <article> semantic tag    │  sticky top-32          │
│                            │                        │
│  Rich HTML content from    │  ┌────────────────────┐│
│  TinyMCE rendered with     │  │ Table of Contents  ││
│  Tailwind prose classes:   │  │ (auto from H2/H3)  ││
│  prose prose-lg max-w-none │  └────────────────────┘│
│                            │                        │
│  H2, H3, H4 headings      │  ┌────────────────────┐│
│  Paragraphs, lists         │  │ Related Posts      ││
│  Images with alt text      │  │ (same category,    ││
│  Links, tables, quotes     │  │  max 3)            ││
│                            │  └────────────────────┘│
│  ──────────────────────    │                        │
│  Tags displayed as badges  │  ┌────────────────────┐│
│  (links to /blog/tag/slug) │  │ CTA Card           ││
│                            │  │ "Get Quote"        ││
│  ──────────────────────    │  │ WhatsApp link      ││
│  Author info section       │  └────────────────────┘│
│                            │                        │
├────────────────────────────┴────────────────────────┤
│  FAQ SECTION (if FAQs exist)                         │
│  Same accordion as dynamic.blade.php                 │
├─────────────────────────────────────────────────────┤
│  CTA SECTION                                         │
│  Same dark CTA block + contact form                  │
│  pattern from dynamic.blade.php                      │
└─────────────────────────────────────────────────────┘
```

### Table of Contents — Alpine.js Auto-Generated

Parses H2 and H3 tags from article content on page load, generates anchor links:

```javascript
function tableOfContents() {
    return {
        headings: [],
        init() {
            const article = document.querySelector('#blog-article');
            const hTags = article.querySelectorAll('h2, h3');
            hTags.forEach((el, i) => {
                const id = 'section-' + i;
                el.id = id;
                this.headings.push({
                    text: el.textContent,
                    id: id,
                    level: el.tagName // 'H2' or 'H3'
                });
            });
        }
    };
}
```

Sidebar TOC HTML:
```html
<div x-data="tableOfContents()" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <h3 class="font-bold text-gray-900 mb-4">Table of Contents</h3>
    <nav>
        <template x-for="heading in headings" :key="heading.id">
            <a :href="'#' + heading.id"
               :class="heading.level === 'H3' ? 'pl-4' : ''"
               class="block py-1.5 text-sm text-gray-500 hover:text-primary-600 transition"
               x-text="heading.text">
            </a>
        </template>
    </nav>
</div>
```

### SEO — Meta Tags & Sections

```blade
@section('title', $blog->meta_title ?? $blog->title . ' - GYF Holidays Blog')
@section('meta_description', $blog->meta_description ?? $blog->excerpt)
@section('meta_keywords', $blog->meta_keywords)
@section('og_type', 'article')
@section('og_image', $blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('logo.png'))

@section('meta_tags')
<meta property="article:published_time" content="{{ $blog->published_at->toISOString() }}">
<meta property="article:modified_time" content="{{ $blog->updated_at->toISOString() }}">
<meta property="article:author" content="{{ $blog->author_name ?? 'GYF Holidays' }}">
@if($blog->category)
<meta property="article:section" content="{{ $blog->category->name }}">
@endif
@foreach($blog->tags as $tag)
<meta property="article:tag" content="{{ $tag->name }}">
@endforeach
@endsection
```

### SEO — Structured Data (JSON-LD)

Push to `@push('schema')`:

**1. BlogPosting Schema:**
```json
{
    "@context": "https://schema.org",
    "@type": "BlogPosting",
    "headline": "{{ $blog->title }}",
    "description": "{{ $blog->excerpt }}",
    "image": "{{ featured image full URL }}",
    "datePublished": "{{ $blog->published_at ISO 8601 }}",
    "dateModified": "{{ $blog->updated_at ISO 8601 }}",
    "wordCount": "{{ str_word_count(strip_tags($blog->content)) }}",
    "articleSection": "{{ $blog->category->name ?? 'Travel' }}",
    "author": {
        "@type": "Person",
        "name": "{{ $blog->author_name ?? 'GYF Holidays' }}"
    },
    "publisher": {
        "@type": "Organization",
        "name": "GYF Holidays",
        "logo": {
            "@type": "ImageObject",
            "url": "{{ asset('logo.png') }}"
        }
    },
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ route('blog.show', $blog->slug) }}"
    }
}
```

**2. BreadcrumbList Schema** — Home > Blog > {Post Title} (same pattern as `dynamic.blade.php`)

**3. FAQPage Schema** — if `$blog->faqs` exist (same pattern as `dynamic.blade.php`)

---

## 12. Public Pages — Category & Tag Pages

### Blog Category Page

**URL:** `/blog/category/{slug}`
**Controller:** `PageController::blogCategory($slug)` — Find BlogCategory by slug, load published blogs in that category, paginate 9.

**View:** `resources/views/pages/blog-index.blade.php` (reuse the same listing view)
- Pass `$category` to display category name in hero title: "Travel Tips — Blog"
- Meta title: `$category->meta_title ?? $category->name . ' - GYF Holidays Blog'`
- Meta description: `$category->meta_description ?? $category->description`
- CollectionPage JSON-LD schema

### Blog Tag Page

**URL:** `/blog/tag/{slug}`
**Controller:** `PageController::blogTag($slug)` — Find BlogTag by slug, load published blogs with that tag, paginate 9.

**View:** Reuse the same `blog-index.blade.php` listing view
- Pass `$tag` to display tag name in hero title: "Posts tagged: Visa Tips"
- Meta title: `$tag->name . ' - GYF Holidays Blog'`

---

## 13. SEO — Complete Checklist

### What Already Works (from existing layout)

| Feature | Location | Status |
|---------|----------|--------|
| Meta title | `layouts/app.blade.php` line 9 — `@yield('title')` | Works |
| Meta description | Layout line 10 — `@yield('meta_description')` | Works |
| Meta keywords | Layout line 11 — `@yield('meta_keywords')` | Works |
| Canonical URL | Layout line 16 — `url()->current()` | Works |
| OG title, description, URL, image | Layout lines 19-27 | Works |
| Twitter Card | Layout lines 30-38 | Works |
| Google Analytics (GA4) | Layout lines 58-82 | Works |
| Organization JSON-LD | Layout lines 84-122 | Works |
| Schema push stack | Layout line 124 — `@stack('schema')` | Works |
| Robots meta | Layout line 13 — `@yield('robots')` | Works |

### What Needs Fixing in Layout

| Issue | Fix |
|-------|-----|
| `og:type` hardcoded as `"website"` (line 19) | Change to `@yield('og_type', 'website')` — blog detail sets `"article"` |
| No `@yield('meta_tags')` for extra meta | Already exists at line 40 — works |

### New SEO Features for Blog Module

| Feature | Location |
|---------|----------|
| `og:type = "article"` for blog posts | `blog-details.blade.php` via `@section('og_type', 'article')` |
| `article:published_time` OG tag | `blog-details.blade.php` via `@section('meta_tags')` |
| `article:modified_time` OG tag | Same |
| `article:author` OG tag | Same |
| `article:section` OG tag | Same |
| `article:tag` OG tags (one per tag) | Same |
| `BlogPosting` JSON-LD schema | `blog-details.blade.php` via `@push('schema')` |
| `BreadcrumbList` JSON-LD schema | `blog-details.blade.php` via `@push('schema')` |
| `FAQPage` JSON-LD schema (if FAQs) | `blog-details.blade.php` via `@push('schema')` |
| `CollectionPage` JSON-LD schema | `blog-index.blade.php` via `@push('schema')` |
| `rel="next"` / `rel="prev"` | `blog-index.blade.php` via `@section('meta_tags')` |
| Proper heading hierarchy (H1 title, H2-H4 body) | TinyMCE config blocks H1 in body |
| Featured image dimensions 1200×630 (OG spec) | Frontend JS Canvas auto-crop |
| Featured image WebP format | Frontend JS Canvas conversion |
| Image lazy loading on listing | `loading="lazy"` on card images |
| Image alt text from title | Template: `alt="{{ $blog->title }}"` |
| Clean URLs `/blog/{slug}` | Routes |
| Category URLs `/blog/category/{slug}` | Routes |
| Tag URLs `/blog/tag/{slug}` | Routes |
| Internal linking (related posts) | Blog detail sidebar |
| Table of Contents (anchor links) | Alpine.js auto-parse H2/H3 |
| Reading time display | Controller calculation |
| Author E-E-A-T signal | Author section + BlogPosting schema |
| Sitemap with all blog URLs | `sitemap.blade.php` update |
| WebP via `ImageHelper::webp()` | For featured images in templates |

---

## 14. Navigation Updates

### Navbar (`resources/views/components/navbar.blade.php`)

Add to `$navLinks` array:

```php
['path' => '/blog', 'label' => 'Blog'],
```

Place between "Coach and Transportation" and "Contact Us":

```php
$navLinks = [
    ['path' => '/', 'label' => 'Home'],
    ['path' => '/about', 'label' => 'About Us'],
    ['path' => '/services', 'label' => 'Services'],
    ['path' => '/destinations', 'label' => 'Destinations'],
    ['path' => '/coach-transportation', 'label' => 'Coach and Transportation'],
    ['path' => '/blog', 'label' => 'Blog'],           // ← NEW
    ['path' => '/contact', 'label' => 'Contact Us'],
];
```

### Footer (`resources/views/components/footer.blade.php`)

Add "Blog" to Quick Links `<ul>` (after "Coaches", before "Contact Us"):

```html
<li><a href="/blog" class="hover:text-primary-400 transition">Blog</a></li>
```

### Admin Sidebar (`resources/views/layouts/admin.blade.php`)

Add a "Blog" section with sub-links between "SEO Pages" and the external links section:

```
Dashboard
Enquiries
SEO Pages
─────────────
Blog
  ├── All Posts      → admin.blogs
  ├── Categories     → admin.blog-categories
  └── Tags           → admin.blog-tags
─────────────
View Website
Logout
```

---

## 15. Sitemap Updates

### `app/Http/Controllers/SitemapController.php`

Add to the `index()` method:

```php
$blogs = Blog::published()->get();
$blogCategories = BlogCategory::has('blogs')->get();
$blogTags = BlogTag::has('blogs')->get();
```

Pass all three to the sitemap view.

### `resources/views/sitemap.blade.php`

Add after the dynamic pages section:

```xml
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
```

---

## 16. File List — All Files to Create/Edit

### New Files (20)

| # | File | Purpose |
|---|------|---------|
| 1 | `database/migrations/xxxx_create_blog_categories_table.php` | Blog categories schema |
| 2 | `database/migrations/xxxx_create_blog_tags_table.php` | Blog tags schema |
| 3 | `database/migrations/xxxx_create_blogs_table.php` | Blogs schema |
| 4 | `database/migrations/xxxx_create_blog_blog_tag_table.php` | Pivot table |
| 5 | `app/Models/Blog.php` | Blog model with scopes, casts, relationships |
| 6 | `app/Models/BlogCategory.php` | Blog category model |
| 7 | `app/Models/BlogTag.php` | Blog tag model |
| 8 | `resources/views/admin/blogs/index.blade.php` | Admin blog list |
| 9 | `resources/views/admin/blogs/create.blade.php` | Admin blog create (TinyMCE + image optimizer) |
| 10 | `resources/views/admin/blogs/edit.blade.php` | Admin blog edit |
| 11 | `resources/views/admin/blog-categories/index.blade.php` | Admin category list |
| 12 | `resources/views/admin/blog-categories/create.blade.php` | Admin category create |
| 13 | `resources/views/admin/blog-categories/edit.blade.php` | Admin category edit |
| 14 | `resources/views/admin/blog-tags/index.blade.php` | Admin tag list |
| 15 | `resources/views/admin/blog-tags/create.blade.php` | Admin tag create |
| 16 | `resources/views/admin/blog-tags/edit.blade.php` | Admin tag edit |
| 17 | `resources/views/pages/blog-index.blade.php` | Public blog listing (reused for category/tag) |
| 18 | `resources/views/pages/blog-details.blade.php` | Public blog detail with sidebar |

### Existing Files to Edit (7)

| # | File | Changes |
|---|------|---------|
| 19 | `app/Http/Controllers/AdminController.php` | Add ~19 methods (blog CRUD + category CRUD + tag CRUD + image upload) |
| 20 | `app/Http/Controllers/PageController.php` | Add 4 methods (blogIndex, blogShow, blogCategory, blogTag) |
| 21 | `app/Http/Controllers/SitemapController.php` | Add blog queries, pass to view |
| 22 | `routes/web.php` | Add ~22 routes (4 public + 18 admin) |
| 23 | `resources/views/components/navbar.blade.php` | Add Blog to `$navLinks` |
| 24 | `resources/views/components/footer.blade.php` | Add Blog to Quick Links |
| 25 | `resources/views/layouts/admin.blade.php` | Add Blog section to sidebar |
| 26 | `resources/views/layouts/app.blade.php` | Change `og:type` to `@yield('og_type', 'website')` |
| 27 | `resources/views/sitemap.blade.php` | Add blog, category, tag URLs |

**Total: 27 files** (20 new + 7 edited)

---

## 17. Execution Order

| Step | What | Dependencies |
|------|------|-------------|
| 1 | Create migrations (4 files) | None |
| 2 | Create models (3 files) | Migrations |
| 3 | Run `php artisan migrate` | Models |
| 4 | Run `php artisan storage:link` (if not done) | None |
| 5 | Add routes to `web.php` | Models |
| 6 | Add admin CRUD methods to `AdminController` | Models + Routes |
| 7 | Create admin blog views (create, edit, index) | Controller methods |
| 8 | Create admin category views (create, edit, index) | Controller methods |
| 9 | Create admin tag views (create, edit, index) | Controller methods |
| 10 | Add Blog section to admin sidebar | None |
| 11 | Add public blog methods to `PageController` | Models + Routes |
| 12 | Create public blog-index view | Controller methods |
| 13 | Create public blog-details view with all SEO | Controller methods |
| 14 | Fix `og:type` in `layouts/app.blade.php` | None |
| 15 | Update navbar + footer with Blog link | None |
| 16 | Update sitemap controller + view | Models |
| 17 | Test full flow: create category → create tag → create blog → view on site | All above |

---

## Open Questions — Need Your Input

1. **TinyMCE CDN vs Self-hosted:** The free CDN (`cdn.tiny.cloud/1/no-api-key/...`) works but shows a small "powered by TinyMCE" notice. Alternatively we can download TinyMCE and serve it from `public/vendor/tinymce/`. Which do you prefer?

2. **Blog URL prefix:** Currently planned as `/blog/{slug}`. Do you want a different prefix like `/blogs/` or `/travel-blog/`?

3. **Default author:** When no author is specified, should it default to "GYF Holidays" or the logged-in admin user's name?

4. **Featured image required or optional?** Should the system allow publishing a blog without a featured image, or enforce it?

5. **Storage link:** Need to run `php artisan storage:link` once to make uploaded images publicly accessible. Has this been run on your deployment server?
