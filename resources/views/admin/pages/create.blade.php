@extends('layouts.admin')

@section('page_title', 'Create SEO Page')

@section('content')
    <div class="max-w-4xl mx-auto">
        <a href="{{ route('admin.pages') }}" class="inline-flex items-center text-primary-600 font-bold mb-6">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Pages
        </a>

        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <form action="{{ route('admin.page.store') }}" method="POST" class="p-10 space-y-8">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Page Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" required class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none" placeholder="e.g. Europe B2B DMC in Chennai">
                    </div>
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">URL Slug</label>
                        <input type="text" name="slug" value="{{ old('slug') }}" required class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none" placeholder="e.g. europe-dmc-in-chennai">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Linked Category</label>
                    <select name="category_id" class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none appearance-none">
                        <option value="">Select a Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Page Description</label>
                    <textarea name="description" rows="6" required class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none" placeholder="Tell us about your services in this region...">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">City-Specific Content</label>
                    <textarea name="city_specific_content" rows="5" class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none" placeholder="Unique content about why travel agents in this city choose GYF...">{{ old('city_specific_content') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Additional SEO Content</label>
                    <textarea name="seo_content" rows="5" class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none" placeholder="Extra content for SEO depth...">{{ old('seo_content') }}</textarea>
                </div>

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

                <div class="pt-8 border-t border-gray-50">
                    <h3 class="text-sm font-black uppercase tracking-widest text-primary-600 mb-6">SEO Configuration</h3>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Meta Title</label>
                            <input type="text" name="meta_title" value="{{ old('meta_title') }}" class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Meta Description</label>
                            <textarea name="meta_description" rows="3" class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none">{{ old('meta_description') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Meta Keywords</label>
                            <input type="text" name="meta_keywords" value="{{ old('meta_keywords') }}" class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none" placeholder="comma, separated, keywords">
                        </div>
                    </div>
                </div>

                <div class="pt-8">
                    <button type="submit" class="w-full py-5 gradient-primary text-white rounded-2xl font-black text-lg shadow-xl shadow-primary-600/20 transform hover:-translate-y-1 transition-all">
                        Create SEO Page
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
function faqManager() {
    return {
        faqs: @json(old('faqs', [])),
        addFaq() {
            this.faqs.push({ question: '', answer: '' });
        },
        removeFaq(index) {
            this.faqs.splice(index, 1);
        }
    };
}
</script>
@endpush
