<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hotel_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained('hotels')->onDelete('cascade');
            $table->string('facilities')->nullable();
            $table->string('nama');
            $table->string('location');
            $table->text('description')->nullable();
            $table->string('interiorImage')->nullable();
            $table->string('headerImage')->nullable();
            $table->text('syaratKetentuan')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->float('rating')->nullable();
            $table->decimal('price', 12, 2)->nullable();
            $table->string('map_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel_details');
    }
};
