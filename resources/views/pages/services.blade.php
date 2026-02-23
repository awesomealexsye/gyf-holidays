@extends('layouts.app')

@section('title', 'Our Services - GYF Holidays | B2B Travel Management')
@section('meta_description', 'Explore our comprehensive B2B travel services: Corporate land travel management, group tours, customized packages, MICE solutions, and private van tours.')
@section('meta_keywords', 'Corporate Travel Management, Group Tour Bookings, MICE Solutions, Private Van Tours, Travel Consultation B2B')

@section('content')
    <x-hero
        title="Our Services"
        subtitle="Global standards of quality, efficiency, and reliability in travel management"
        backgroundImage="/pictures/our-services/img-all.jpg"
        :showCTA="false"
        height="h-[550px]"
    />

    <x-process />

    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Core Offerings</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Providing high-precision land arrangement services tailored for B2B partners.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                    <h3 class="text-2xl font-bold mb-4">Corporate Travel</h3>
                    <p class="text-gray-600">Tailored solutions for business movements across Europe and UK.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                    <h3 class="text-2xl font-bold mb-4">Group Series</h3>
                    <p class="text-gray-600">Efficient handling of large leisure and corporate groups.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
