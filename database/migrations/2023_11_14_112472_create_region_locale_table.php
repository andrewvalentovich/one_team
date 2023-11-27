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
        Schema::create('region_locale', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->nullable()->index()->constrained('country_and_cities')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('locale_id')->nullable()->index()->constrained('locales')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name')->nullable();
            $table->longText('div')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('region_locale');
    }
};
