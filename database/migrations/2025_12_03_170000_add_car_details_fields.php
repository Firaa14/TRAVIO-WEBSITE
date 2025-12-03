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
        Schema::table('car', function (Blueprint $table) {
            // Cek dan tambahkan kolom hanya jika belum ada
            if (!Schema::hasColumn('car', 'license_plate')) {
                $table->string('license_plate')->nullable()->after('image');
            }
            if (!Schema::hasColumn('car', 'brand')) {
                $table->string('brand')->nullable()->after('title');
            }
            if (!Schema::hasColumn('car', 'model')) {
                $table->string('model')->nullable()->after('brand');
            }
            if (!Schema::hasColumn('car', 'year')) {
                $table->year('year')->nullable()->after('model');
            }
            if (!Schema::hasColumn('car', 'transmission')) {
                $table->enum('transmission', ['Manual', 'Automatic'])->default('Manual')->after('year');
            }
            if (!Schema::hasColumn('car', 'fuel_type')) {
                $table->enum('fuel_type', ['Petrol', 'Diesel', 'Electric', 'Hybrid'])->default('Petrol')->after('transmission');
            }
            if (!Schema::hasColumn('car', 'capacity')) {
                $table->integer('capacity')->default(4)->after('fuel_type');
            }
            if (!Schema::hasColumn('car', 'color')) {
                $table->string('color')->nullable()->after('capacity');
            }
            if (!Schema::hasColumn('car', 'interior_image')) {
                $table->string('interior_image')->nullable()->after('image');
            }
            if (!Schema::hasColumn('car', 'gallery_images')) {
                $table->json('gallery_images')->nullable()->after('interior_image');
            }
            if (!Schema::hasColumn('car', 'location')) {
                $table->string('location')->nullable()->after('description');
            }
            if (!Schema::hasColumn('car', 'terms_conditions')) {
                $table->json('terms_conditions')->nullable()->after('facilities');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('car', function (Blueprint $table) {
            $table->dropColumn([
                'license_plate',
                'brand',
                'model',
                'year',
                'transmission',
                'fuel_type',
                'capacity',
                'color',
                'interior_image',
                'gallery_images',
                'location',
                'terms_conditions'
            ]);
        });
    }
};