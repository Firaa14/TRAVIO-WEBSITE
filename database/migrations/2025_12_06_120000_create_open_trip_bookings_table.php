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
        Schema::create('open_trip_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('open_trip_id')->constrained()->onDelete('cascade');
            $table->string('full_name');
            $table->string('phone');
            $table->string('email');
            $table->enum('gender', ['male', 'female']);
            $table->date('dob');
            $table->text('address');
            $table->string('emergency_name');
            $table->string('emergency_phone');
            $table->integer('participants')->default(1);
            $table->decimal('total_price', 15, 2);
            $table->enum('payment_method', ['bank_transfer', 'qris', 'e_wallet', 'cash']);
            $table->string('payment_proof')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('open_trip_bookings');
    }
};
