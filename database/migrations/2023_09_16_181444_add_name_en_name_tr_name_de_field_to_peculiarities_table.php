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
        Schema::table('peculiarities', function (Blueprint $table) {
            $table->string('name_en')->nullable(true);
            $table->string('name_tr')->nullable(true);
            $table->string('name_de')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peculiarities', function (Blueprint $table) {
            $table->dropColumn('name_en');
            $table->dropColumn('name_tr');
            $table->dropColumn('name_de');
        });
    }
};
