@extends('layouts.app')

@section('title', $blog->meta_title ?? $blog->title . ' - GYF Holidays Blog')
@section('meta_description', $blog->meta_description ?? $blog->excerpt)
@section('meta_keywords', $blog->meta_keywords)
@section('og_image', $blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('logo.png'))

@section('meta_tags')
<meta property="og:type" content="article">
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

@push('schema')
    <!-- BlogPosting Schema -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "BlogPosting",
        "headline": "{{ $blog->meta_title ?? $blog->title }}",
        "description": "{{ $blog->meta_description ?? $blog->excerpt }}",
        "image": "{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('logo.png') }}",
        "datePublished": "{{ $blog->published_at->toISOString() }}",
        "dateModified": "{{ $blog->updated_at->toISOString() }}",
        "wordCount": {{ str_word_count(strip_tags($blog->content)) }},
        @if($blog->category)
        "articleSection": "{{ $blog->category->name }}",
        @endif
        "author": {
            "@type": "Person",
            "name": "{{ $blog->author_name ?? 'GYF Holidays' }}"
        },
        "publisher": {
            "@type": "Organization",
            "name": "{{ config('gyf.company.name') }}",
            "logo": {
                "@type": "ImageObject",
                "url": "{{ asset('logo.png') }}"
            }
        },
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "{{ url()->current() }}"
        }
    }
    </script>

    <!-- BreadcrumbList Schema -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "Home",
                "item": "{{ url('/') }}"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "Blog",
                "item": "{{ route('blog.index') }}"
            },
            {
                "@type": "ListItem",
                "position": 3,
                "name": "{{ $blog->title }}",
                "item": "{{ url()->current() }}"
            }
        ]
    }
    </script>

    @if($blog->faqs && count($blog->faqs) > 0)
    <!-- FAQPage Schema -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            @foreach($blog->faqs as $index => $faq)
            {
                "@type": "Question",
                "name": "{{ $faq['question'] }}",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "{{ $faq['answer'] }}"
                }
            }@if(!$loop->last),@endif
            @endforeach
        ]
    }
    </script>
    @endif
@endpush

@section('content')
    <!-- Hero Section -->
    <x-hero
        :title="$blog->title"
        :subtitle="$blog->excerpt"
        :backgroundImage="$blog->featured_image ? asset('storage/' . $blog->featured_image) : 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=1920&auto=format&fit=crop&q=80'"
        :showCTA="false"
        height="h-[450px]"
    />

    <!-- Breadcrumb Navigation -->
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
                    <a href="{{ route('blog.index') }}" class="ml-2 hover:text-primary-600 transition">Blog</a>
                </li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="ml-2 text-gray-900 font-semibold">{{ $blog->title }}</span>
                </li>
            </ol>
        </div>
    </nav>

    <!-- Main Content -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap -mx-4">
                <!-- Left Column (2/3) -->
                <div class="w-full lg:w-2/3 px-4">
                    <article id="blog-article" class="prose prose-lg max-w-none">
                        {!! $blog->content !!}
                    </article>

                    <!-- Author & Date -->
                    <div class="mt-12 pt-8 border-t border-gray-100">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-primary-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">{{ $blog->author_name ?? 'GYF Holidays' }}</p>
                                <p class="text-sm text-gray-500">Published on {{ $blog->published_at?->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tags -->
                    @if($blog->tags->count() > 0)
                    <div class="mt-8">
                        <div class="flex flex-wrap gap-2">
                            @foreach($blog->tags as $tag)
                                <a href="{{ route('blog.tag', $tag->slug) }}" class="bg-primary-50 text-primary-600 px-3 py-1 rounded-full text-sm font-bold hover:bg-primary-100 transition">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Right Sidebar (1/3) -->
                <div class="w-full lg:w-1/3 px-4 mt-12 lg:mt-0">
                    <div class="sticky top-32">
                        <!-- Table of Contents -->
                        <div x-data="tableOfContents()" x-show="headings.length > 0" x-cloak class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
                            <h3 class="font-bold text-gray-900 mb-4 text-sm uppercase tracking-widest">Table of Contents</h3>
                            <nav>
                                <template x-for="heading in headings" :key="heading.id">
                                    <a :href="'#' + heading.id" :class="heading.level === 'H3' ? 'pl-4' : ''" class="block py-1.5 text-sm text-gray-500 hover:text-primary-600 transition" x-text="heading.text"></a>
                                </template>
                            </nav>
                        </div>

                        <!-- Related Posts -->
                        @if($relatedPosts->count() > 0)
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
                            <h3 class="font-bold text-gray-900 mb-4 text-sm uppercase tracking-widest">Related Posts</h3>
                            <div class="space-y-4">
                                @foreach($relatedPosts as $related)
                                <a href="{{ route('blog.show', $related->slug) }}" class="block group">
                                    <h4 class="font-bold text-gray-900 group-hover:text-primary-600 transition text-sm">{{ $related->title }}</h4>
                                    <p class="text-xs text-gray-400 mt-1">{{ $related->published_at?->format('M d, Y') }}</p>
                                </a>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- CTA Card -->
                        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">Need Travel Help?</h3>
                            <div class="space-y-4">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', config('gyf.contact.whatsapp')) }}" target="_blank" class="w-full py-4 bg-green-700 text-white rounded-xl font-bold flex items-center justify-center space-x-2" aria-label="Chat on WhatsApp">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"></path></svg>
                                    <span>Chat on WhatsApp</span>
                                </a>
                                <a href="/contact" class="w-full py-4 bg-primary-600 text-white rounded-xl font-bold flex items-center justify-center">
                                    Get a Quote
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    @if($blog->faqs && count($blog->faqs) > 0)
        <section class="py-20 bg-gray-50/50">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl md:text-4xl font-black text-gray-900 mb-4 tracking-tight">
                            Frequently Asked Questions
                        </h2>
                        <p class="text-gray-500 font-medium">
                            Common questions about this topic.
                        </p>
                    </div>

                    <div class="space-y-4" x-data="{ openFaq: null }">
                        @foreach($blog->faqs as $index => $faq)
                            <div class="bg-white rounded-2xl overflow-hidden border border-gray-100">
                                <button
                                    @click="openFaq = openFaq === {{ $index }} ? null : {{ $index }}"
                                    class="w-full flex items-center justify-between p-6 text-left"
                                >
                                    <h3 class="font-bold text-gray-900 pr-4">{{ $faq['question'] }}</h3>
                                    <svg
                                        class="w-5 h-5 text-gray-400 flex-shrink-0 transition-transform duration-300"
                                        :class="{ 'rotate-180': openFaq === {{ $index }} }"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div
                                    x-show="openFaq === {{ $index }}"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 -translate-y-2"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    class="px-6 pb-6"
                                >
                                    <p class="text-gray-600 leading-relaxed">{{ $faq['answer'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- CTA Section -->
    <section class="py-24 bg-white overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="bg-gray-900 rounded-[3.5rem] p-12 md:p-20 relative overflow-hidden flex flex-col lg:flex-row items-center gap-16">
                <div class="absolute top-0 right-0 w-96 h-96 bg-primary-600/10 blur-[100px] rounded-full"></div>

                <div class="w-full lg:w-1/2 relative z-10">
                    <h2 class="text-3xl md:text-5xl font-black text-white mb-8 leading-tight tracking-tight">
                        Ready to plan your next <span class="text-primary-500">dream holiday</span>?
                    </h2>
                    <p class="text-lg text-white/60 font-medium mb-10 leading-relaxed">
                        Get exclusive B2B rates and customized tour packages for your travel agency. Our dedicated team is ready to help you grow your business.
                    </p>
                    <div class="flex items-center space-x-8">
                        <div class="flex flex-col">
                            <span class="text-4xl font-black text-white">100%</span>
                            <span class="text-[10px] font-black text-primary-400 uppercase tracking-[0.2em]">Reliability</span>
                        </div>
                        <div class="w-px h-12 bg-white/10"></div>
                        <div class="flex flex-col">
                            <span class="text-4xl font-black text-white">24/7</span>
                            <span class="text-[10px] font-black text-primary-400 uppercase tracking-[0.2em]">Support</span>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 relative z-10">
                    <x-contact-form title="Request B2B Quote" :compact="true" />
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    function tableOfContents() {
        return {
            headings: [],
            init() {
                const article = document.querySelector('#blog-article');
                if (!article) return;
                const hTags = article.querySelectorAll('h2, h3');
                hTags.forEach((el, i) => {
                    const id = 'section-' + i;
                    el.id = id;
                    this.headings.push({ text: el.textContent, id: id, level: el.tagName });
                });
            }
        };
    }
</script>
@endpush
