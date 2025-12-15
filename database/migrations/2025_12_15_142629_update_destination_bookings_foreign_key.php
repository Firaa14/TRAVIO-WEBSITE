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
        Schema::table('destination_bookings', function (Blueprint $table) {
            // Drop existing foreign key constraint
            $table->dropForeign(['destination_id']);
            
            // Add new foreign key constraint to destinasi table
            $table->foreign('destination_id')->references('id')->on('destinasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('destination_bookings', function (Blueprint $table) {
            // Drop new foreign key constraint
            $table->dropForeign(['destination_id']);
            
            // Restore original foreign key constraint to destinations table
            $table->foreign('destination_id')->references('id')->on('destinations')->onDelete('cascade');
        });
    }
};
