<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Add new SEO content fields
        Schema::table('dynamic_pages', function (Blueprint $table) {
            $table->json('faqs')->nullable()->after('meta_keywords');
            $table->text('city_specific_content')->nullable()->after('description');
            $table->text('seo_content')->nullable()->after('city_specific_content');
        });

        // Update slugs to include "b2b" for consistency with target keywords
        $slugUpdates = [
            'europe-dmc-in-chennai' => 'europe-b2b-dmc-in-chennai',
            'scandinavia-dmc-in-chennai' => 'scandinavia-b2b-dmc-in-chennai',
            'europe-dmc-in-delhi' => 'europe-b2b-dmc-in-delhi',
            'scandinavia-dmc-in-delhi' => 'scandinavia-b2b-dmc-in-delhi',
            'europe-dmc-in-mumbai' => 'europe-b2b-dmc-in-mumbai',
            'scandinavia-dmc-in-mumbai' => 'scandinavia-b2b-dmc-in-mumbai',
            'europe-dmc-in-bangalore' => 'europe-b2b-dmc-in-bangalore',
            'scandinavia-dmc-in-bangalore' => 'scandinavia-b2b-dmc-in-bangalore',
            'europe-dmc-in-kolkata' => 'europe-b2b-dmc-in-kolkata',
            'scandinavia-dmc-in-kolkata' => 'scandinavia-b2b-dmc-in-kolkata',
            'europe-dmc-in-hyderabad' => 'europe-b2b-dmc-in-hyderabad',
            'scandinavia-dmc-in-hyderabad' => 'scandinavia-b2b-dmc-in-hyderabad',
            // Fix Maharashtra spelling
            'europe-b2b-travel-dmc-in-maharastra' => 'europe-b2b-travel-dmc-in-maharashtra',
        ];

        foreach ($slugUpdates as $oldSlug => $newSlug) {
            DB::table('dynamic_pages')
                ->where('slug', $oldSlug)
                ->update(['slug' => $newSlug]);
        }

        // Fix Maharashtra spelling in title and meta fields
        DB::table('dynamic_pages')
            ->where('slug', 'europe-b2b-travel-dmc-in-maharashtra')
            ->update([
                'title' => 'Europe B2B Travel DMC in Maharashtra',
                'meta_title' => 'Europe B2B Travel DMC in Maharashtra | GYF Holidays',
            ]);
    }

    public function down(): void
    {
        // Reverse slug updates
        $slugReverts = [
            'europe-b2b-dmc-in-chennai' => 'europe-dmc-in-chennai',
            'scandinavia-b2b-dmc-in-chennai' => 'scandinavia-dmc-in-chennai',
            'europe-b2b-dmc-in-delhi' => 'europe-dmc-in-delhi',
            'scandinavia-b2b-dmc-in-delhi' => 'scandinavia-dmc-in-delhi',
            'europe-b2b-dmc-in-mumbai' => 'europe-dmc-in-mumbai',
            'scandinavia-b2b-dmc-in-mumbai' => 'scandinavia-dmc-in-mumbai',
            'europe-b2b-dmc-in-bangalore' => 'europe-dmc-in-bangalore',
            'scandinavia-b2b-dmc-in-bangalore' => 'scandinavia-dmc-in-bangalore',
            'europe-b2b-dmc-in-kolkata' => 'europe-dmc-in-kolkata',
            'scandinavia-b2b-dmc-in-kolkata' => 'scandinavia-dmc-in-kolkata',
            'europe-b2b-dmc-in-hyderabad' => 'europe-dmc-in-hyderabad',
            'scandinavia-b2b-dmc-in-hyderabad' => 'scandinavia-dmc-in-hyderabad',
            'europe-b2b-travel-dmc-in-maharashtra' => 'europe-b2b-travel-dmc-in-maharastra',
        ];

        foreach ($slugReverts as $newSlug => $oldSlug) {
            DB::table('dynamic_pages')
                ->where('slug', $newSlug)
                ->update(['slug' => $oldSlug]);
        }

        DB::table('dynamic_pages')
            ->where('slug', 'europe-b2b-travel-dmc-in-maharastra')
            ->update([
                'title' => 'Europe B2B Travel DMC in Maharastra',
                'meta_title' => 'Europe B2B Travel DMC in Maharastra | GYF Holidays',
            ]);

        Schema::table('dynamic_pages', function (Blueprint $table) {
            $table->dropColumn(['faqs', 'city_specific_content', 'seo_content']);
        });
    }
};
