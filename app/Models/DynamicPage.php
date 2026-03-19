<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DynamicPage extends Model
{
    protected $fillable = [
        'slug', 'title', 'description', 'city_specific_content', 'seo_content',
        'category_id', 'meta_title', 'meta_description', 'meta_keywords',
        'faqs', 'is_active'
    ];

    protected $casts = [
        'faqs' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Old slug to new slug mapping for 301 redirects.
     */
    public const SLUG_REDIRECTS = [
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
        'europe-b2b-travel-dmc-in-maharastra' => 'europe-b2b-travel-dmc-in-maharashtra',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Extract city name from the page title.
     */
    public function getCityAttribute(): string
    {
        if (preg_match('/in\s+(.+)$/i', $this->title, $matches)) {
            return trim($matches[1]);
        }
        return '';
    }

    /**
     * Extract region (Europe/Scandinavia/UK) from the page title.
     */
    public function getRegionAttribute(): string
    {
        if (preg_match('/^(Europe|Scandinavia|UK)/i', $this->title, $matches)) {
            return trim($matches[1]);
        }
        return '';
    }
}
