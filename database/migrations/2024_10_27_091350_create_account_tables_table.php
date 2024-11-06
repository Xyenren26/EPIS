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
        Schema::table('account_tables', function (Blueprint $table) {
            $table->time('time_in')->nullable(); // Add nullable time_in column
            $table->time('time_out')->nullable(); // Add nullable time_out column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('account_tables', function (Blueprint $table) {
            $table->dropColumn(['time_in', 'time_out']); // Remove time_in and time_out columns
        });
    }
};
