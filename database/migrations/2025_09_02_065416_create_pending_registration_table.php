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
        Schema::create('pending_registration', function (Blueprint $table) {
            $table->id();
            $table->string('surname');
            $table->string('athlete_name');
            $table->string('father_name');
            $table->date('dob');
            $table->float('percentage'); // e.g. 99.99
            $table->string('email')->unique();
            $table->string('phone', 15)->unique();
            $table->text('address')->nullable();
            $table->string('age_group');
            $table->string('gender');
            $table->string('disability');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_registration');
    }
};
