<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('package', function (Blueprint $table) {
            $table->string('location')->nullable()->after('description');
            $table->string('duration')->nullable()->after('location');
            $table->text('include')->nullable()->after('duration');
            $table->json('facilities')->nullable()->after('include');
            $table->json('itinerary')->nullable()->after('facilities');
            $table->json('price_details')->nullable()->after('itinerary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('package', function (Blueprint $table) {
            $table->dropColumn(['location', 'duration', 'include', 'facilities', 'itinerary', 'price_details']);
        });
    }
};
