@extends('layouts.admin')

@section('page_title', 'Edit Blog Post')

@section('content')
    <div class="max-w-4xl mx-auto">
        <a href="{{ route('admin.blogs') }}" class="inline-flex items-center text-primary-600 font-bold mb-6">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Blog Posts
        </a>

        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data" class="p-10 space-y-8">
                @csrf
                @method('PUT')

                @if($errors->any())
                    <div class="p-4 bg-red-50 text-red-700 rounded-2xl">
                        <p class="font-bold mb-2">Please fix the following errors:</p>
                        <ul class="list-disc list-inside text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Basic Info --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Title</label>
                        <input type="text" name="title" value="{{ old('title', $blog->title) }}" required class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none" placeholder="e.g. Top 10 European Destinations for 2026">
                    </div>
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Slug</label>
                        <input type="text" name="slug" value="{{ old('slug', $blog->slug) }}" required class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none" placeholder="auto-generated-from-title">
                    </div>
                </div>

                {{-- Category & Author --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Blog Category</label>
                        <select name="blog_category_id" class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none appearance-none">
                            <option value="">Select a Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('blog_category_id', $blog->blog_category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Author Name</label>
                        <input type="text" name="author_name" value="{{ old('author_name', $blog->author_name) }}" class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none" placeholder="e.g. John Doe">
                    </div>
                </div>

                {{-- Featured Image --}}
                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Featured Image</label>
                    <p class="text-xs text-gray-400 mb-3">Recommended: 1200 x 630px. Auto-resized and converted to WebP.</p>

                    @if($blog->featured_image)
                        <div class="mb-4">
                            <p class="text-xs font-bold text-gray-500 mb-2">Current featured image</p>
                            <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="max-h-48 rounded-xl">
                        </div>
                    @endif

                    <div x-data="imageOptimizer()" class="relative">
                        <div
                            class="border-2 border-dashed rounded-2xl p-8 text-center transition-all cursor-pointer"
                            :class="dragOver ? 'border-primary-600 bg-primary-50' : 'border-gray-300 hover:border-primary-400'"
                            @dragover.prevent="dragOver = true"
                            @dragleave.prevent="dragOver = false"
                            @drop.prevent="handleDrop($event)"
                            @click="$refs.fileInput.click()"
                        >
                            <template x-if="!imagePreview">
                                <div>
                                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <p class="text-sm font-bold text-gray-500">{{ $blog->featured_image ? 'Drop new image to replace' : 'Drop image here or click to browse' }}</p>
                                    <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP up to 10MB</p>
                                </div>
                            </template>
                            <template x-if="imagePreview">
                                <div>
                                    <img :src="imagePreview" class="max-h-64 mx-auto rounded-xl mb-3">
                                    <p class="text-xs text-green-600 font-bold">Resized to 1200x630 &middot; WebP &middot; <span x-text="fileSize"></span> KB</p>
                                </div>
                            </template>
                        </div>
                        <input type="file" name="featured_image" x-ref="fileInput" @change="handleInput($event)" accept="image/*" class="hidden">
                    </div>
                </div>

                {{-- Content --}}
                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Excerpt</label>
                    <textarea name="excerpt" rows="3" class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none" placeholder="A short summary of the blog post...">{{ old('excerpt', $blog->excerpt) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Content</label>
                    <input type="hidden" name="content" id="blog-content-input" value="{{ old('content', $blog->content) }}">
                    <div id="blog-editor" class="bg-gray-50 rounded-2xl overflow-hidden" style="min-height: 400px;"></div>
                </div>

                {{-- Tags --}}
                <div class="pt-8 border-t border-gray-50">
                    <h3 class="text-sm font-black uppercase tracking-widest text-primary-600 mb-6">Tags</h3>
                    <div x-data="tagSelector()" class="flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                            <button
                                type="button"
                                class="px-4 py-2 rounded-xl text-sm font-bold cursor-pointer transition-all"
                                :class="isSelected({{ $tag->id }}) ? 'bg-primary-100 text-primary-600 ring-2 ring-primary-600' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                                @click="toggle({{ $tag->id }})"
                            >
                                {{ $tag->name }}
                            </button>
                        @endforeach
                        @if($tags->isEmpty())
                            <p class="text-sm text-gray-400">No tags created yet. <a href="{{ route('admin.blog-tag.create') }}" class="text-primary-600 font-bold">Create one</a></p>
                        @endif
                        <template x-for="id in selectedTags" :key="id">
                            <input type="hidden" name="tags[]" :value="id">
                        </template>
                    </div>
                </div>

                {{-- FAQ Section --}}
                <div class="pt-8 border-t border-gray-50">
                    <h3 class="text-sm font-black uppercase tracking-widest text-primary-600 mb-6">FAQ Section</h3>
                    <div x-data="faqManager()" class="space-y-4">
                        <template x-for="(faq, index) in faqs" :key="index">
                            <div class="bg-gray-50 rounded-2xl p-6 space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-black uppercase tracking-widest text-gray-400" x-text="'FAQ #' + (index + 1)"></span>
                                    <button type="button" @click="removeFaq(index)" class="text-red-500 hover:text-red-700 text-sm font-bold">Remove</button>
                                </div>
                                <input type="text" :name="'faqs[' + index + '][question]'" x-model="faq.question" placeholder="Question" class="w-full px-4 py-3 bg-white border-0 rounded-xl focus:ring-2 focus:ring-primary-600 outline-none">
                                <textarea :name="'faqs[' + index + '][answer]'" x-model="faq.answer" rows="3" placeholder="Answer" class="w-full px-4 py-3 bg-white border-0 rounded-xl focus:ring-2 focus:ring-primary-600 outline-none"></textarea>
                            </div>
                        </template>
                        <button type="button" @click="addFaq()" class="w-full py-3 border-2 border-dashed border-gray-300 rounded-2xl text-gray-500 font-bold hover:border-primary-400 hover:text-primary-600 transition">
                            + Add FAQ
                        </button>
                    </div>
                </div>

                {{-- SEO Configuration --}}
                <div class="pt-8 border-t border-gray-50">
                    <h3 class="text-sm font-black uppercase tracking-widest text-primary-600 mb-6">SEO Configuration</h3>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Meta Title</label>
                            <input type="text" name="meta_title" value="{{ old('meta_title', $blog->meta_title) }}" class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Meta Description</label>
                            <textarea name="meta_description" rows="3" class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none">{{ old('meta_description', $blog->meta_description) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Meta Keywords</label>
                            <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $blog->meta_keywords) }}" class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none" placeholder="comma, separated, keywords">
                        </div>
                    </div>
                </div>

                {{-- Publishing --}}
                <div class="pt-8 border-t border-gray-50">
                    <h3 class="text-sm font-black uppercase tracking-widest text-primary-600 mb-6">Publishing</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Status</label>
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="hidden" name="is_published" value="0">
                                <input type="checkbox" name="is_published" value="1" {{ old('is_published', $blog->is_published) ? 'checked' : '' }} class="w-5 h-5 rounded-lg text-primary-600 focus:ring-primary-600">
                                <span class="font-bold text-gray-700">Publish this post</span>
                            </label>
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Publish Date</label>
                            <input type="datetime-local" name="published_at" value="{{ old('published_at', $blog->published_at?->format('Y-m-d\TH:i')) }}" class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none">
                        </div>
                    </div>
                </div>

                <div class="pt-8">
                    <button type="submit" class="w-full py-5 gradient-primary text-white rounded-2xl font-black text-lg shadow-xl shadow-primary-600/20 transform hover:-translate-y-1 transition-all">
                        Update Blog Post
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<style>
    .ql-editor { min-height: 350px; font-family: Poppins, sans-serif; font-size: 16px; line-height: 1.8; }
    .ql-toolbar.ql-snow { border: none; background: #e5e7eb; border-radius: 1rem 1rem 0 0; }
    .ql-container.ql-snow { border: none; border-radius: 0 0 1rem 1rem; }
</style>
<script>
function faqManager() {
    return {
        faqs: @json(old('faqs', $blog->faqs ?? [])),
        addFaq() { this.faqs.push({ question: '', answer: '' }); },
        removeFaq(index) { this.faqs.splice(index, 1); }
    };
}

function tagSelector() {
    return {
        selectedTags: @json(old('tags', $blog->tags->pluck('id')->toArray())),
        isSelected(id) { return this.selectedTags.includes(id); },
        toggle(id) {
            if (this.isSelected(id)) {
                this.selectedTags = this.selectedTags.filter(t => t !== id);
            } else {
                this.selectedTags.push(id);
            }
        }
    };
}

function imageOptimizer() {
    return {
        imagePreview: null, fileSize: null, dragOver: false,
        TARGET_WIDTH: 1200, TARGET_HEIGHT: 630, WEBP_QUALITY: 0.82,
        handleFile(file) {
            if (!file || !file.type.startsWith('image/')) return;
            const img = new Image();
            img.onload = () => {
                const canvas = document.createElement('canvas');
                canvas.width = this.TARGET_WIDTH;
                canvas.height = this.TARGET_HEIGHT;
                const ctx = canvas.getContext('2d');
                const targetRatio = this.TARGET_WIDTH / this.TARGET_HEIGHT;
                const imgRatio = img.width / img.height;
                let sx, sy, sw, sh;
                if (imgRatio > targetRatio) { sh = img.height; sw = img.height * targetRatio; sx = (img.width - sw) / 2; sy = 0; }
                else { sw = img.width; sh = img.width / targetRatio; sx = 0; sy = (img.height - sh) / 2; }
                ctx.drawImage(img, sx, sy, sw, sh, 0, 0, this.TARGET_WIDTH, this.TARGET_HEIGHT);
                canvas.toBlob((blob) => {
                    this.imagePreview = URL.createObjectURL(blob);
                    this.fileSize = (blob.size / 1024).toFixed(1);
                    const dt = new DataTransfer();
                    dt.items.add(new File([blob], 'featured-image.webp', { type: 'image/webp' }));
                    this.$refs.fileInput.files = dt.files;
                }, 'image/webp', this.WEBP_QUALITY);
            };
            img.src = URL.createObjectURL(file);
        },
        handleDrop(event) { this.dragOver = false; this.handleFile(event.dataTransfer.files[0]); },
        handleInput(event) { this.handleFile(event.target.files[0]); }
    };
}

// Auto-slug from title
document.querySelector('input[name="title"]').addEventListener('input', function() {
    const slugInput = document.querySelector('input[name="slug"]');
    if (!slugInput.dataset.manual) {
        slugInput.value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
    }
});
document.querySelector('input[name="slug"]').addEventListener('input', function() { this.dataset.manual = '1'; });

// Quill Editor
const quill = new Quill('#blog-editor', {
    theme: 'snow',
    modules: {
        toolbar: [
            [{ 'header': [2, 3, 4, false] }],
            ['bold', 'italic', 'underline'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            ['blockquote', 'link', 'image'],
            ['clean']
        ]
    },
    placeholder: 'Write your blog content here...'
});

// Load existing content
const existingContent = document.getElementById('blog-content-input').value;
if (existingContent) {
    quill.root.innerHTML = existingContent;
}

// Sync Quill content to hidden input on every change
quill.on('text-change', function() {
    const html = quill.root.innerHTML;
    const input = document.getElementById('blog-content-input');
    input.value = quill.getText().trim().length === 0 ? '' : html;
});

// Also sync on form submit to be safe
document.querySelector('form').addEventListener('submit', function(e) {
    const html = quill.root.innerHTML;
    const input = document.getElementById('blog-content-input');
    input.value = quill.getText().trim().length === 0 ? '' : html;
});
</script>
@endpush
