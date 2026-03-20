@extends('layouts.app')

@section('title', isset($category) ? ($category->meta_title ?? $category->name . ' - GYF Holidays Blog') : (isset($tag) ? $tag->name . ' - GYF Holidays Blog' : $title . ' - GYF Holidays'))
@section('meta_description', $description)

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
    "@@context": "https://schema.org",
    "@type": "CollectionPage",
    "name": "{{ $title }} - GYF Holidays",
    "description": "{{ $description }}",
    "url": "{{ url()->current() }}"
}
</script>
@endpush

@section('content')
    <x-hero
        :title="$title"
        :subtitle="$description"
        :showCTA="false"
        height="h-[400px]"
    />

    <!-- Breadcrumb -->
    <nav class="bg-white border-b border-gray-100" aria-label="Breadcrumb">
        <div class="container mx-auto px-4 py-3">
            <ol class="flex items-center space-x-2 text-sm text-gray-500">
                <li>
                    <a href="{{ url('/') }}" class="hover:text-primary-600 transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                    </a>
                </li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    @if(isset($category) || isset($tag))
                        <a href="{{ route('blog.index') }}" class="ml-2 hover:text-primary-600 transition">Blog</a>
                    @else
                        <span class="ml-2 text-gray-900 font-semibold">Blog</span>
                    @endif
                </li>
                @if(isset($category))
                <li class="flex items-center">
                    <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="ml-2 text-gray-900 font-semibold">{{ $category->name }}</span>
                </li>
                @endif
                @if(isset($tag))
                <li class="flex items-center">
                    <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="ml-2 text-gray-900 font-semibold">{{ $tag->name }}</span>
                </li>
                @endif
            </ol>
        </div>
    </nav>

    <!-- Blog Grid -->
    <section class="py-24 bg-gray-50/50">
        <div class="container mx-auto px-4">
            @if($blogs->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach($blogs as $blog)
                        <a href="{{ route('blog.show', $blog->slug) }}" class="bg-white rounded-[2.5rem] shadow-xl shadow-gray-200/30 overflow-hidden group hover:shadow-2xl transition-all duration-500 flex flex-col h-full border border-gray-100/50">
                            <div class="relative h-52 overflow-hidden">
                                <img
                                    src="{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('logo.png') }}"
                                    alt="{{ $blog->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000"
                                    loading="lazy"
                                >
                                @if($blog->category)
                                <div class="absolute top-6 left-6 bg-white/95 backdrop-blur px-4 py-2 rounded-2xl text-xs font-black text-primary-600 shadow-xl border border-primary-50">
                                    {{ $blog->category->name }}
                                </div>
                                @endif
                            </div>
                            <div class="p-8 flex-grow flex flex-col">
                                <h2 class="text-xl font-black text-gray-900 mb-3 leading-tight group-hover:text-primary-600 transition-colors">
                                    {{ $blog->title }}
                                </h2>
                                <p class="text-gray-500 text-sm mb-6 flex-grow">
                                    {{ Str::limit($blog->excerpt ?? strip_tags($blog->content), 120) }}
                                </p>
                                <div class="flex items-center justify-between text-xs text-gray-400 font-bold pt-4 border-t border-gray-50">
                                    <span>{{ $blog->published_at?->format('M d, Y') }}</span>
                                    <span>{{ $blog->reading_time }} min read</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="mt-12">
                    {{ $blogs->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    <p class="text-gray-500 font-bold text-lg">No blog posts yet.</p>
                    <p class="text-gray-400 mt-2">Check back soon for travel tips and insights!</p>
                </div>
            @endif
        </div>
    </section>
@endsection
