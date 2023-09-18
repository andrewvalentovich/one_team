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
            $table->string('name_de')->nullable(true);
            $table->longText('div_de')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('country_and_cities', function (Blueprint $table) {
            $table->dropColumn('name_de');
            $table->dropColumn('div_de');
        });
    }
};
