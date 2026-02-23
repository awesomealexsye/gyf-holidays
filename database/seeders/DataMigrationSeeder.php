<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\DynamicPage;
use App\Models\Package;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DataMigrationSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Migrate Categories
        $categoriesJson = json_decode(File::get(resource_path('data/categories.json')), true);
        foreach ($categoriesJson as $cat) {
            Category::updateOrCreate(['id' => $cat['id']], [
                'name' => $cat['name'],
                'image' => $cat['image'],
                'description' => $cat['description']
            ]);
        }

        // 2. Migrate Packages
        $packagesJson = json_decode(File::get(resource_path('data/packages.json')), true);
        foreach ($packagesJson as $pkg) {
            Package::updateOrCreate(['id' => $pkg['id']], [
                'category_id' => $pkg['categoryId'],
                'name' => $pkg['name'],
                'destination' => $pkg['destination'],
                'duration' => $pkg['duration'],
                'description' => $pkg['description'],
                'highlights' => $pkg['highlights'],
                'image' => $pkg['image'],
                'gallery' => $pkg['gallery'],
                'itinerary' => $pkg['itinerary']
            ]);
        }

        // 3. Add Initial Dynamic Pages (SEO Pages)
        $locations = ['Chennai', 'Delhi', 'Mumbai', 'Bangalore', 'Kolkata', 'Hyderabad'];
        foreach ($locations as $location) {
            DynamicPage::updateOrCreate(['slug' => "europe-dmc-in-" . strtolower($location)], [
                'title' => "Europe B2B DMC in $location",
                'description' => "GYF Holidays is one of the most trusted B2B DMC for Europe in $location. We have an excellent track record of ensuring that our partners get the best value for their clients. We provide well-informed travel advice on where in Europe would be best suited as well as how much time should be spent at each destination.",
                'category_id' => 'europe-package',
                'meta_title' => "Best Europe B2B DMC in $location | GYF Holidays",
                'meta_description' => "Looking for a reliable Europe B2B DMC in $location? GYF Holidays provides premium ground handling, hotel bookings, and tour packages for Europe.",
                'meta_keywords' => "Europe DMC $location, B2B Europe Travel $location, Europe Tour Operator $location"
            ]);

            DynamicPage::updateOrCreate(['slug' => "scandinavia-dmc-in-" . strtolower($location)], [
                'title' => "Scandinavia B2B DMC in $location",
                'description' => "Explore the Nordic wonders with the leading Scandinavia B2B DMC in $location. From Northern Lights tours to fjord cruises, we manage everything for your clients with precision.",
                'category_id' => 'scandinavia',
                'meta_title' => "Top Scandinavia B2B DMC in $location | GYF Holidays",
                'meta_description' => "Expert Scandinavia B2B DMC in $location. We offer customized tour packages for Norway, Sweden, Finland, and Denmark.",
                'meta_keywords' => "Scandinavia DMC $location, Nordic B2B Travel $location, Scandinavia Packages $location"
            ]);
        }

        // 4. Add Specific Requested Dynamic Pages
        $additionalPages = [
            [
                'slug' => 'europe-b2b-travel-dmc-in-nagpur',
                'title' => 'Europe B2B Travel DMC in Nagpur',
                'category_id' => 'europe-package',
                'description' => 'GYF Holidays is the leading Europe B2B travel DMC in Nagpur, providing comprehensive travel solutions, hotel bookings, and ground handling for European tours.'
            ],
            [
                'slug' => 'europe-b2b-travel-dmc-in-maharastra',
                'title' => 'Europe B2B Travel DMC in Maharastra',
                'category_id' => 'europe-package',
                'description' => 'As a premier Europe B2B travel DMC in Maharastra, we offer customized itineraries and competitive rates for all your European travel requirements.'
            ],
            [
                'slug' => 'europe-b2b-dmc-in-pune',
                'title' => 'Europe B2B DMC in Pune',
                'category_id' => 'europe-package',
                'description' => 'Looking for a reliable Europe B2B DMC in Pune? GYF Holidays offers specialized B2B travel services for Europe, ensuring the best experiences for your clients.'
            ],
            [
                'slug' => 'uk-b2b-travel-dmc-in-mumbai',
                'title' => 'UK B2B Travel DMC in Mumbai',
                'category_id' => 'uk-ireland-scotland',
                'description' => 'GYF Holidays is your trusted UK B2B travel DMC in Mumbai, specializing in comprehensive tour packages across the United Kingdom and Ireland.'
            ],
        ];

        foreach ($additionalPages as $page) {
            DynamicPage::updateOrCreate(['slug' => $page['slug']], [
                'title' => $page['title'],
                'description' => $page['description'],
                'category_id' => $page['category_id'],
                'meta_title' => $page['title'] . " | GYF Holidays",
                'meta_description' => $page['description'],
                'meta_keywords' => str_replace(' ', ', ', $page['title'])
            ]);
        }
    }
}
