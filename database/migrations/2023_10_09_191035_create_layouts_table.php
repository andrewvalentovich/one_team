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
        Schema::create('layouts', function (Blueprint $table) {
            $table->id();
            $table->string('building')->nullable(true);
            $table->string('name')->nullable(true);
            $table->string('type')->nullable(true);
            $table->bigInteger('price')->nullable(true);
            $table->string('price_code')->nullable(true);
            $table->integer('total_size')->nullable(true);
            $table->integer('living_size')->nullable(true);
            $table->string('number_rooms')->nullable(true);
            $table->integer('floor')->nullable(true);
            $table->integer('number_bedrooms')->nullable(true);
            $table->integer('number_bathrooms')->nullable(true);
            $table->integer('number_balconies')->nullable(true);
            $table->foreignId('complex_id')->nullable()->index()->constrained('products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layouts');
    }
};
