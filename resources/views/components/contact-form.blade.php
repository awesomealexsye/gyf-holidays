@props(['title' => 'Send Us an Inquiry', 'compact' => false])

@php
    $companyTypes = [
        'Travel Agency',
        'Corporate',
        'Event Management',
        'Tour Operator',
        'Other',
    ];
@endphp

<div class="bg-white rounded-xl shadow-xl p-6 {{ $compact ? 'md:p-6' : 'md:p-8' }}">
    <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">{{ $title }}</h3>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg text-red-800 text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form 
        action="{{ route('enquiry.submit') }}" 
        method="POST" 
        class="space-y-4"
        x-data="{ isSubmitting: false }"
        @submit="isSubmitting = true"
    >
        @csrf
        <div class="grid {{ $compact ? 'grid-cols-1' : 'grid-cols-1 md:grid-cols-2' }} gap-4">
            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Full Name *
                </label>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        placeholder="John Doe"
                    >
                </div>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Email Address *
                </label>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        placeholder="john@example.com"
                    >
                </div>
            </div>

            <!-- Phone -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Phone Number *
                </label>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path></svg>
                    <input
                        type="tel"
                        name="phone"
                        value="{{ old('phone') }}"
                        required
                        pattern="^([0-9\s\-\+\(\)]*)$"
                        title="Please enter a valid phone number (digits, space, -, +, () allowed)"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        placeholder="+91 98765 43210"
                    >
                </div>
            </div>

            <!-- Business Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Business Name *
                </label>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"></path></svg>
                    <input
                        type="text"
                        name="businessName"
                        value="{{ old('businessName') }}"
                        required
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        placeholder="Your Company Name"
                    >
                </div>
            </div>

            <!-- Company Type -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Company Type *
                </label>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 z-10 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"></path><path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"></path></svg>
                    <select
                        name="companyType"
                        id="companyType"
                        required
                        aria-label="Company Type"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent appearance-none bg-white"
                    >
                        <option value="">Select Type</option>
                        @foreach($companyTypes as $type)
                            <option value="{{ $type }}" {{ old('companyType') == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Number of Travelers -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Number of Travelers
                </label>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path></svg>
                    <input
                        type="number"
                        name="numberOfTravelers"
                        value="{{ old('numberOfTravelers') }}"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        placeholder="10"
                        min="1"
                    >
                </div>
            </div>

            <!-- Travel Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Preferred Travel Date
                </label>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                    <input
                        type="date"
                        name="travelDate"
                        id="travelDate"
                        value="{{ old('travelDate') }}"
                        aria-label="Preferred Travel Date"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                    >
                </div>
            </div>

            <!-- Destination Interest -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Destination of Interest
                </label>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                    <input
                        type="text"
                        name="destination"
                        value="{{ old('destination') }}"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        placeholder="e.g., Bali, Dubai, Europe"
                    >
                </div>
            </div>
        </div>

        <!-- Message -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Message / Special Requirements
            </label>
            <div class="relative">
                <svg class="absolute left-3 top-4 text-gray-400 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path></svg>
                <textarea
                    name="message"
                    rows="4"
                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                    placeholder="Tell us more about your requirements..."
                >{{ old('message') }}</textarea>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="grid grid-cols-1">
            <button
                type="submit"
                class="flex items-center justify-center space-x-2 py-4 px-6 rounded-lg font-semibold transition-all hover:shadow-lg transform hover:-translate-y-0.5 bg-primary-600 hover:bg-primary-700 text-white disabled:bg-gray-300 disabled:text-gray-500 disabled:cursor-not-allowed"
                :disabled="isSubmitting"
            >
                <template x-if="isSubmitting">
                    <div class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        <span>Sending Inquiry...</span>
                    </div>
                </template>
                <template x-if="!isSubmitting">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                        <span class="hidden sm:inline">Submit Inquiry</span>
                        <span class="sm:hidden">Submit</span>
                    </div>
                </template>
            </button>
        </div>
    </form>
</div>
