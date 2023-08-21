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
        Schema::create('course_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->unsignedBigInteger('course_id');
            $table->unique(['course_id', 'locale']);
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');     
            $table->string('name');
            $table->text('description');
            $table->string('image')->nullable();
            $table->foreignId('sub_category_id')->references('id')->on('sub_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_translations');
    }
};
