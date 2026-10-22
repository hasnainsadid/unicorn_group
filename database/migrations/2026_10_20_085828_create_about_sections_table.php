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
        Schema::create('about_sections', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // home_about, about_who
            $table->string('label');         // admin e je naam dekhabe
            $table->string('eyebrow')->nullable();
            $table->string('title');
            $table->string('highlight')->nullable();
            $table->text('body')->nullable(); // paragraph, majhe faka line
            $table->string('image_main')->nullable();
            $table->string('image_sub')->nullable();
            $table->string('btn_text')->nullable();
            $table->string('btn_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_sections');
    }
};
