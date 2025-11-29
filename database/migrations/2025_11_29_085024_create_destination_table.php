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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('destinasi_id');
            $table->string('location');
            $table->text('detail');
            $table->text('itinerary');
            $table->text('price_details');

            $table->timestamps();

            $table->foreign('destinasi_id')
                ->references('id')
                ->on('destinasi')
                ->onDelete('cascade');
        });
    }

};



