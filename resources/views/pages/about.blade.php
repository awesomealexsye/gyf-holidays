@extends('layouts.app')

@section('title', 'About Us - GYF Holidays | Trusted B2B Travel Partner')
@section('meta_description', 'Learn about GYF Holidays (GYF PLANNERS PVT LTD), our mission, vision, and how we provide exceptional B2B travel solutions since 2018.')

@section('content')
    <x-hero
        title="About GYF Holidays"
        subtitle="GYF PLANNERS PVT LTD - Your Trusted Partner in Creating Unforgettable Travel Experiences"
        backgroundImage="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=1920&auto=format&fit=crop&q=80"
        :showCTA="false"
        height="h-[400px]"
    />

    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                        Our Story
                    </h2>
                    <p class="text-gray-600 mb-4">
                        <b>Founded in 2018</b>, GYF Holidays began with a clear vision 
                        — to redefine destination management by offering reliable, 
                        professional, and partner-focused travel solutions for the 
                        global B2B market. 
                    </p>
                    <p class="text-gray-600 mb-4">
                        Every great journey begins with a vision. At GYF Holidays, our
                        journey began with a simple idea — to create a reliable and
                        professional destination management partner that travel
                        businesses can truly depend on.
                    </p>
                    <p class="text-gray-600 mb-4">
                        What started as a small team with deep knowledge of European
                        destinations has grown into a trusted B2B travel solutions
                        provider, supporting travel agencies, tour operators, and
                        corporate clients with seamless ground services and customized
                        travel experiences.
                    </p>
                    <p class="text-gray-600 mb-4">
                        Over the years, we have developed strong partnerships with
                        hotels, local service providers, and on-ground experts across
                        Europe, the UK, and Scandinavia.
                    </p>
                    <p class="text-gray-600">
                        Today, GYF Holidays stands as a growing destination management
                        company, empowering travel businesses with dependable solutions,
                        personalized support, and memorable travel experiences across
                        multiple international destinations. Our story continues with
                        every partner we serve and every journey we help create.
                    </p>
                </div>

                <div class="relative">
                    <img
                        src="https://images.unsplash.com/photo-1521737711867-e3b97375f902?w=800&auto=format&fit=crop&q=80"
                        alt="Our Story"
                        class="rounded-2xl shadow-2xl"
                    >
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="text-primary-600 w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Our Mission</h3>
                    <p class="text-gray-600">
                        To empower businesses with exceptional travel solutions that combine quality, value, and personalized service.
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <div class="w-16 h-16 bg-secondary-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="text-secondary-600 w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Our Vision</h3>
                    <p class="text-gray-600">
                        To be the most trusted and innovative B2B travel partner globally, recognized for creating extraordinary experiences.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
