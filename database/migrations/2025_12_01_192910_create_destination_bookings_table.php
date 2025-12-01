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
        Schema::create('destination_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id', 20)->unique();

            // Relasi ke destinasi
            $table->foreignId('destination_id')->constrained('destinations')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            // Data pemesan
            $table->string('full_name');
            $table->string('phone', 20);
            $table->string('email');
            $table->enum('gender', ['male', 'female']);
            $table->date('dob');
            $table->text('address');
            $table->string('emergency_name');
            $table->string('emergency_phone', 20);

            // Detail booking
            $table->string('trip_title');
            $table->string('trip_date');
            $table->decimal('price_per_person', 10, 2);
            $table->integer('participants');
            $table->decimal('total_price', 10, 2);

            // Pembayaran
            $table->enum('payment_method', ['bank_transfer', 'qris', 'e_wallet', 'cash']);
            $table->string('payment_proof')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_bookings');
    }
};
