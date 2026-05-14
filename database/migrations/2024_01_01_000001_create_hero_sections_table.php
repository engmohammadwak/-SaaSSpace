<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->default('Available for New Projects');
            $table->string('main_title');
            $table->json('rotating_texts');
            $table->text('description');
            $table->string('primary_btn_text')->default('Book a Call');
            $table->string('primary_btn_url');
            $table->string('secondary_btn_text')->default('Case Studies');
            $table->string('secondary_btn_url');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_sections');
    }
};
