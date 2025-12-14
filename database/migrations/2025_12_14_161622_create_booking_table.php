<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('booking_code')->unique();
            $table->string('full_name');
            $table->string('phone', 20);
            $table->string('email');
            $table->enum('gender', ['male', 'female']);
            $table->date('dob');
            $table->text('address');
            $table->integer('guests');
            $table->string('emergency_name')->nullable();
            $table->string('emergency_phone', 20)->nullable();
            $table->enum('payment_method', ['bank_transfer', 'qris', 'e_wallet']);
            $table->string('payment_proof')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('total_price')->default(0);
            $table->json('item_data')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'cancelled'])->default('pending');
            $table->enum('payment_status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->index('booking_code');
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};