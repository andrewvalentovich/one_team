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
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('citizenship')->change()->default(0);
            $table->boolean('grajandstvo')->change()->default(0);
            $table->boolean('parking')->change()->default(0);
            $table->boolean('vnj')->change()->default(0);
            $table->boolean('cryptocurrency')->change()->default(0);
            $table->boolean('complex_or_not')->change()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('citizenship')->change()->nullable();
            $table->string('grajandstvo')->change()->nullable();
            $table->string('parking')->change()->nullable();
            $table->string('vnj')->change()->nullable();
            $table->string('cryptocurrency')->change()->nullable();
            $table->string('complex_or_not')->change()->nullable();
        });
    }
};
