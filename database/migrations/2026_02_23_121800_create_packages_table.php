<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $blueprint) {
            $blueprint->string('id')->primary(); // Using string ID to match JSON
            $blueprint->string('category_id');
            $blueprint->string('name');
            $blueprint->string('destination');
            $blueprint->string('duration');
            $blueprint->text('description');
            $blueprint->json('highlights');
            $blueprint->string('image');
            $blueprint->json('gallery')->nullable();
            $blueprint->json('itinerary');
            $blueprint->timestamps();

            $blueprint->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
