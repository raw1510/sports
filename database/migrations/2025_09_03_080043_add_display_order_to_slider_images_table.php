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
        Schema::table('slider_images', function (Blueprint $table) {
            //
            $table->unsignedSmallInteger('display_order')->nullable()->default(null)->after('order_index');
            $table->unique('display_order', 'unique_slider_display_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('slider_images', function (Blueprint $table) {
            //
                        $table->dropUnique('unique_slider_display_order');
            // Drop the column
            $table->dropColumn('display_order');
        });
    }
};
