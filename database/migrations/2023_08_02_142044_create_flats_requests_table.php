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
        Schema::create('flats_requests', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->string('first_name')->nullable(true);
            $table->string('last_name')->nullable(true);
            $table->string('middle_name')->nullable(true);
            $table->dateTime('birth_date')->nullable(true);
            $table->integer('age')->nullable(true);
            $table->string('ip')->nullable(true);
            $table->string('utm_source')->nullable(true);
            $table->string('utm_medium')->nullable(true);
            $table->string('utm_campaign')->nullable(true);
            $table->string('utm_term')->nullable(true);
            $table->string('utm_content')->nullable(true);
            $table->string('referer')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flats_requests');
    }
};
