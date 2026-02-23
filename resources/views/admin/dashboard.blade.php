@extends('layouts.admin')

@section('page_title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
        <!-- Stat Card -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 flex items-center group hover:shadow-xl hover:shadow-primary-900/5 transition-all duration-300">
            <div class="w-16 h-16 bg-primary-100 text-primary-600 rounded-2xl flex items-center justify-center mr-6 group-hover:scale-110 transition-transform duration-300">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Enquiries</p>
                <h3 class="text-4xl font-black text-gray-900 leading-none">{{ $totalEnquiries }}</h3>
            </div>
        </div>
    </div>

    <!-- Recent Enquiries Section -->
    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-50 flex items-center justify-between">
            <div>
                <h3 class="font-bold text-gray-900 text-lg tracking-tight">Recent Enquiries</h3>
                <p class="text-xs text-gray-500 font-medium">Last 5 submissions received</p>
            </div>
            <a href="{{ route('admin.enquiries') }}" class="px-4 py-2 bg-gray-50 text-primary-600 hover:bg-primary-50 rounded-xl text-xs font-bold transition-colors">View All Submissions</a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 text-gray-400 text-[10px] font-black uppercase tracking-[0.2em]">
                        <th class="px-8 py-4">Customer</th>
                        <th class="px-8 py-4">Business Details</th>
                        <th class="px-8 py-4">Destination</th>
                        <th class="px-8 py-4">Date Received</th>
                        <th class="px-8 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($recentEnquiries as $enquiry)
                        <tr class="hover:bg-primary-50/30 transition-colors group">
                            <td class="px-8 py-5">
                                <div class="font-bold text-gray-900 group-hover:text-primary-700 transition-colors">{{ $enquiry->name }}</div>
                                <div class="text-xs text-gray-500 font-medium">{{ $enquiry->email }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="text-sm font-bold text-gray-700">{{ $enquiry->business_name }}</div>
                                <div class="text-[10px] text-primary-600 font-black uppercase tracking-tighter">{{ $enquiry->company_type }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-700 rounded-lg text-xs font-bold">
                                    <svg class="w-3 h-3 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ $enquiry->destination ?? 'N/A' }}
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="text-sm font-medium text-gray-600">{{ $enquiry->created_at->format('d M, Y') }}</div>
                                <div class="text-[10px] text-gray-400 font-bold">{{ $enquiry->created_at->format('h:i A') }}</div>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <a href="{{ route('admin.enquiry.details', $enquiry->id) }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-xl text-xs font-bold shadow-lg shadow-primary-600/20 hover:bg-primary-700 hover:-translate-y-0.5 transition-all">
                                    Details
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    @if($recentEnquiries->isEmpty())
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <p class="text-gray-400 font-bold text-sm italic">No enquiries received yet.</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
