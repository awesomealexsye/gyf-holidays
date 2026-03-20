<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'featured_image',
        'blog_category_id', 'author_name', 'meta_title', 'meta_description',
        'meta_keywords', 'faqs', 'is_published', 'published_at', 'is_active',
    ];

    protected $casts = [
        'faqs' => 'array',
        'is_published' => 'boolean',
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(BlogTag::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->where('is_active', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function getReadingTimeAttribute()
    {
        $words = str_word_count(strip_tags($this->content ?? ''));

        return max(1, ceil($words / 200));
    }
}
