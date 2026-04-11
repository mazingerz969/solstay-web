<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('property_photos', function (Blueprint $table) {
            $table->id();
            $table->string('property_id');
            $table->string('path');
            $table->string('caption_es')->nullable();
            $table->string('caption_en')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->foreign('property_id')->references('id')->on('properties')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_photos');
    }
};
