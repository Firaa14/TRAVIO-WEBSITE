<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('package', function (Blueprint $table) {
            $table->text('exclude')->nullable()->after('include');
            $table->text('terms_conditions')->nullable()->after('price_details');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('package', function (Blueprint $table) {
            $table->dropColumn(['exclude', 'terms_conditions']);
        });
    }
};
