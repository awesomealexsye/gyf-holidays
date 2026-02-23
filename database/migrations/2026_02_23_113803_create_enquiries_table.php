<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enquiries', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('name');
            $blueprint->string('email');
            $blueprint->string('phone');
            $blueprint->string('business_name')->nullable();
            $blueprint->string('company_type')->nullable();
            $blueprint->integer('number_of_travelers')->nullable();
            $blueprint->date('travel_date')->nullable();
            $blueprint->string('destination')->nullable();
            $blueprint->text('message')->nullable();
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
