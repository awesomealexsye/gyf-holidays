<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $blueprint) {
            $blueprint->string('id')->primary(); // Using string ID to match JSON
            $blueprint->string('name');
            $blueprint->string('image');
            $blueprint->text('description');
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
