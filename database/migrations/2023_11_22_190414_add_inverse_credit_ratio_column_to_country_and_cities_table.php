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
        Schema::table('country_and_cities', function (Blueprint $table) {
            $table->float('inverse_credit_ratio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('country_and_cities', function (Blueprint $table) {
            $table->dropColumn('inverse_credit_ratio');
        });
    }
};
