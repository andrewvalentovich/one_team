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
        Schema::table('landings', function (Blueprint $table) {
            $table->dropColumn('filter_country');
            $table->dropColumn('filter_region');
            $table->dropColumn('filter_complex');
            $table->bigInteger('relation_id')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('landings', function (Blueprint $table) {
            $table->dropColumn('relation_id');
            $table->bigInteger('filter_country')->nullable(true);
            $table->bigInteger('filter_region')->nullable(true);
            $table->bigInteger('filter_complex')->nullable(true);
        });
    }
};
