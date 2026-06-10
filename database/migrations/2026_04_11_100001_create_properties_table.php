<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name_es');
            $table->string('name_en');
            $table->text('description_es');
            $table->text('description_en');
            $table->string('address');
            $table->decimal('location_lat', 10, 7)->nullable();
            $table->decimal('location_lon', 10, 7)->nullable();
            $table->integer('price_per_night');
            $table->integer('min_nights')->default(2);
            $table->integer('max_guests')->default(4);
            $table->json('amenities_es');
            $table->json('amenities_en');
            $table->text('house_rules_es')->nullable();
            $table->text('house_rules_en')->nullable();
            $table->string('wifi_name')->nullable();
            $table->string('wifi_password')->nullable();
            $table->text('checkin_instructions_es')->nullable();
            $table->text('checkin_instructions_en')->nullable();
            $table->text('checkout_instructions_es')->nullable();
            $table->text('checkout_instructions_en')->nullable();
            $table->json('local_tips_es')->nullable();
            $table->json('local_tips_en')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
