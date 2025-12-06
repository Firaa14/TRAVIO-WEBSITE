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
        Schema::create('planning_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->json('item_data'); // Store selected destinations, hotels, cars, packages
            $table->integer('guests');
            $table->decimal('total_price', 15, 2);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status')->default('pending'); // pending, confirmed, cancelled
            $table->string('payment_proof')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planning_bookings');
    }
};
