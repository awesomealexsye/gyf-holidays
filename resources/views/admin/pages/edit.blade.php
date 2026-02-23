@extends('layouts.admin')

@section('page_title', 'Edit SEO Page')

@section('content')
    <div class="max-w-4xl mx-auto">
        <a href="{{ route('admin.pages') }}" class="inline-flex items-center text-primary-600 font-bold mb-6">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Pages
        </a>

        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <form action="{{ route('admin.page.update', $page->id) }}" method="POST" class="p-10 space-y-8">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Page Title</label>
                        <input type="text" name="title" value="{{ old('title', $page->title) }}" required class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">URL Slug</label>
                        <input type="text" name="slug" value="{{ old('slug', $page->slug) }}" required class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Linked Category</label>
                    <select name="category_id" class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none appearance-none">
                        <option value="">Select a Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $page->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Page Description</label>
                    <textarea name="description" rows="6" required class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none">{{ old('description', $page->description) }}</textarea>
                </div>

                <div class="pt-8 border-t border-gray-50">
                    <h3 class="text-sm font-black uppercase tracking-widest text-primary-600 mb-6">SEO Configuration</h3>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Meta Title</label>
                            <input type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Meta Description</label>
                            <textarea name="meta_description" rows="3" class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none">{{ old('meta_description', $page->meta_description) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Meta Keywords</label>
                            <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $page->meta_keywords) }}" class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none">
                        </div>
                    </div>
                </div>

                <div class="pt-8">
                    <button type="submit" class="w-full py-5 gradient-primary text-white rounded-2xl font-black text-lg shadow-xl shadow-primary-600/20 transform hover:-translate-y-1 transition-all">
                        Update SEO Page
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
