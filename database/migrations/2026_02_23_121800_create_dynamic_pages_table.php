<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dynamic_pages', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('slug')->unique();
            $blueprint->string('title');
            $blueprint->text('description');
            $blueprint->string('category_id')->nullable();
            
            // SEO Fields
            $blueprint->string('meta_title')->nullable();
            $blueprint->text('meta_description')->nullable();
            $blueprint->string('meta_keywords')->nullable();
            
            $blueprint->boolean('is_active')->default(true);
            $blueprint->timestamps();

            $blueprint->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dynamic_pages');
    }
};
