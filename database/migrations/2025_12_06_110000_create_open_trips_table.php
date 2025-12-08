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
        Schema::create('open_trips', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('location');
            $table->text('description');
            $table->string('image');
            $table->decimal('price', 15, 2);
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('duration_days');
            $table->integer('max_participants');
            $table->integer('current_participants')->default(0);
            $table->json('facilities')->nullable(); // AC, WiFi, Meals, etc
            $table->json('itinerary')->nullable(); // Day by day schedule
            $table->text('meeting_point')->nullable();
            $table->time('meeting_time')->nullable();
            $table->enum('status', ['available', 'full', 'closed'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('open_trips');
    }
};
