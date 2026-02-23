@extends('layouts.admin')

@section('page_title', 'All Enquiries')

@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-xs font-bold uppercase tracking-wider">
                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4">Contact</th>
                        <th class="px-6 py-4">Business</th>
                        <th class="px-6 py-4">Destination</th>
                        <th class="px-6 py-4">Received On</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($enquiries as $enquiry)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-800">{{ $enquiry->name }}</div>
                                <div class="text-xs text-primary-600 font-medium">{{ $enquiry->company_type }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-700">{{ $enquiry->email }}</div>
                                <div class="text-xs text-gray-500">{{ $enquiry->phone }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $enquiry->business_name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $enquiry->destination ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $enquiry->created_at->format('d M, Y h:i A') }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end items-center space-x-2">
                                    <a href="{{ route('admin.enquiry.details', $enquiry->id) }}" class="inline-flex items-center px-3 py-1 bg-primary-50 text-primary-600 rounded-lg text-xs font-bold hover:bg-primary-100 transition">
                                        View
                                    </a>
                                    <form action="{{ route('admin.enquiry.delete', $enquiry->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this enquiry?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1 text-red-400 hover:text-red-600 transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @if($enquiries->isEmpty())
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500 italic">No enquiries found yet.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        @if($enquiries->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $enquiries->links() }}
            </div>
        @endif
    </div>
@endsection
