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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id(); // Creates BIGINT UNSIGNED AUTO_INCREMENT primary key 'id'
            $table->string('title')->nullable(); // Title for the slide
            $table->text('description')->nullable(); // Description for the slide
            $table->string('image_path'); // Path to the image file (e.g., 'images/sliders/slide1.jpg')
            $table->boolean('is_active')->default(false); // Whether the image is active (1) or inactive (0)
            $table->unsignedInteger('order_index')->default(0); // Order of active images (1, 2, 3...)
            
            // Timestamps for creation and modification
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};