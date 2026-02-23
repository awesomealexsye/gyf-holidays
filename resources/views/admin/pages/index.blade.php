@extends('layouts.admin')

@section('page_title', 'SEO Dynamic Pages')

@section('content')
    <div class="mb-8 flex justify-between items-center">
        <p class="text-gray-500 font-medium text-sm italic">Manage your regional SEO landing pages.</p>
        <a href="{{ route('admin.page.create') }}" class="px-6 py-3 gradient-primary text-white rounded-xl font-bold shadow-lg shadow-primary-600/20 hover:-translate-y-0.5 transition-all">
            + Create New Page
        </a>
    </div>

    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 text-gray-400 text-[10px] font-black uppercase tracking-[0.2em]">
                        <th class="px-8 py-4">Title & Slug</th>
                        <th class="px-8 py-4">Linked Category</th>
                        <th class="px-8 py-4">Status</th>
                        <th class="px-8 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($pages as $page)
                        <tr class="hover:bg-primary-50/30 transition-colors group">
                            <td class="px-8 py-5">
                                <div class="font-bold text-gray-900">{{ $page->title }}</div>
                                <div class="text-xs text-primary-600 font-medium">/{{ $page->slug }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-xs font-bold uppercase">
                                    {{ $page->category->name ?? 'None' }}
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                <span class="px-3 py-1 {{ $page->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} rounded-lg text-[10px] font-black uppercase">
                                    {{ $page->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex justify-end items-center space-x-2">
                                    <a href="/{{ $page->slug }}" target="_blank" class="p-2 text-gray-400 hover:text-primary-600 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    <a href="{{ route('admin.page.edit', $page->id) }}" class="p-2 text-gray-400 hover:text-primary-600 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.page.delete', $page->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
@endsection
