<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id', 'category_id', 'name', 'destination', 'duration', 
        'description', 'highlights', 'image', 'gallery', 'itinerary'
    ];

    protected $casts = [
        'highlights' => 'array',
        'gallery' => 'array',
        'itinerary' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
