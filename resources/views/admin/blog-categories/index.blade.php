@extends('layouts.admin')

@section('page_title', 'Blog Categories')

@section('content')
    <div class="mb-8 flex justify-between items-center">
        <p class="text-gray-500 font-medium text-sm italic">Manage blog categories.</p>
        <a href="{{ route('admin.blog-category.create') }}" class="px-6 py-3 gradient-primary text-white rounded-xl font-bold shadow-lg shadow-primary-600/20 hover:-translate-y-0.5 transition-all">
            + Create New Category
        </a>
    </div>

    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 text-gray-400 text-[10px] font-black uppercase tracking-[0.2em]">
                        <th class="px-8 py-4">Name & Slug</th>
                        <th class="px-8 py-4">Posts</th>
                        <th class="px-8 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($categories as $category)
                        <tr class="hover:bg-primary-50/30 transition-colors group">
                            <td class="px-8 py-5">
                                <div class="font-bold text-gray-900">{{ $category->name }}</div>
                                <div class="text-xs text-primary-600 font-medium">/blog/category/{{ $category->slug }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-xs font-bold">{{ $category->blogs_count }} posts</span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex justify-end items-center space-x-2">
                                    <a href="{{ route('admin.blog-category.edit', $category->id) }}" class="p-2 text-gray-400 hover:text-primary-600 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.blog-category.delete', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-gray-400 hover:text-red-600 transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $categories->links() }}</div>

    @if(session('error'))
        <script>alert('{{ session('error') }}')</script>
    @endif
@endsection
