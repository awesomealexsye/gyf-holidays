@extends('layouts.admin')

@section('page_title', 'Create Blog Tag')

@section('content')
    <div class="max-w-4xl mx-auto">
        <a href="{{ route('admin.blog-tags') }}" class="inline-flex items-center text-primary-600 font-bold mb-6">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Tags
        </a>

        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <form action="{{ route('admin.blog-tag.store') }}" method="POST" class="p-10 space-y-8">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Tag Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none" placeholder="e.g. Beach Holidays">
                    </div>
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">URL Slug</label>
                        <input type="text" name="slug" value="{{ old('slug') }}" required class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary-600 outline-none" placeholder="e.g. beach-holidays">
                    </div>
                </div>

                <div class="pt-8">
                    <button type="submit" class="w-full py-5 gradient-primary text-white rounded-2xl font-black text-lg shadow-xl shadow-primary-600/20 transform hover:-translate-y-1 transition-all">
                        Create Tag
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.querySelector('input[name="name"]').addEventListener('input', function() {
    const slugInput = document.querySelector('input[name="slug"]');
    if (!slugInput.dataset.manual) {
        slugInput.value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
    }
});
document.querySelector('input[name="slug"]').addEventListener('input', function() { this.dataset.manual = '1'; });
</script>
@endpush
