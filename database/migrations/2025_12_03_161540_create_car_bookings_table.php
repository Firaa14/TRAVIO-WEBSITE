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
        Schema::create('car_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('car_id')->constrained('car');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('passengers');
            $table->enum('duration_type', ['half', 'full']);
            $table->boolean('with_driver')->default(false);
            $table->string('renter_name');
            $table->string('driver_name')->nullable();
            $table->string('ktp_path')->nullable();
            $table->string('sim_path')->nullable();
            $table->decimal('total_price', 12, 2);
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_bookings');
    }
};
