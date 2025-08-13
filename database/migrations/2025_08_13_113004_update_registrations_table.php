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
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->string('surname')->after('id');
            $table->string('athlete_name')->after('surname');
            $table->string('father_name')->after('athlete_name');
            $table->date('dob')->after('father_name');
            $table->float('percentage')->after('dob');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('name')->after('id'); // Re-add 'name'
            $table->dropColumn(['surname', 'athlete_name', 'father_name', 'dob', 'percentage']);
        });
    }
};
