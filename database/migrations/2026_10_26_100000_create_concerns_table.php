<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('concerns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('concerns')->cascadeOnDelete();
            $table->string('title');
            $table->string('slug');
            $table->string('path')->unique();            // full url path, e.g. elevator/premium/hidoks
            $table->string('layout', 20)->default('feature');   // feature | brand
            $table->string('eyebrow')->nullable();
            $table->string('heading')->nullable();       // feature layout big heading
            $table->string('heading_highlight')->nullable();
            $table->string('tagline')->nullable();       // short line (brand layout + cards)
            $table->text('body')->nullable();            // paragraphs, blank line between them
            $table->json('features')->nullable();        // "What We Offer" list
            $table->json('cards')->nullable();           // up to 3 cards: icon, title, text
            $table->string('image')->nullable();
            $table->string('image2')->nullable();
            $table->string('children_heading')->nullable();
            $table->string('children_text')->nullable();
            $table->string('home_icon', 20)->nullable();
            $table->string('home_image')->nullable();
            $table->string('home_text', 300)->nullable();
            $table->unsignedSmallInteger('home_order')->nullable();   // top-level only
            $table->string('catalogue')->nullable();     // uploaded PDF
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 300)->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['parent_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('concerns');
    }
};
