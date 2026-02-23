@extends('layouts.app')

@section('title', 'Contact Us - GYF Holidays')
@section('meta_description', 'Get in touch with GYF Holidays for B2B travel inquiries, corporate bookings, and customized tour packages. We provide 24/7 support for our partners.')
@section('meta_keywords', 'Contact GYF Holidays, B2B Travel Inquiry, Corporate Booking Support, Travel Agency Help, Delhi Travel Office')

@section('content')
    <x-hero
        title="Get In Touch"
        subtitle="GYF PLANNERS PVT LTD - We're here to help you create unforgettable travel experiences"
        backgroundImage="https://images.unsplash.com/photo-1423666639041-f56000c27a9a?w=1920&auto=format&fit=crop&q=80"
        :showCTA="false"
        height="h-[400px]"
    />

    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <x-contact-form />
            </div>
        </div>
    </section>
@endsection
