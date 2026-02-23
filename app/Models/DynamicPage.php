<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DynamicPage extends Model
{
    protected $fillable = [
        'slug', 'title', 'description', 'category_id', 
        'meta_title', 'meta_description', 'meta_keywords', 'is_active'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
