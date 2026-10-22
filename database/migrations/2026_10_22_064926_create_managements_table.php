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
        Schema::create('managements', function (Blueprint $table) {
            $table->id();
            $table->string('role_title'); // Chairman's Message
            $table->string('name');
            $table->string('designation'); // Chairman, Unicorn Group
            $table->string('quote', 300)->nullable();
            $table->text('message');             // paragraph, majhe faka line
            $table->string('photo')->nullable(); // na thakle naam er initials dekhabe
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('managements');
    }
};
