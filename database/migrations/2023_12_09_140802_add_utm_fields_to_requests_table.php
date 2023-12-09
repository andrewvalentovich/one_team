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
        Schema::table('requests', function (Blueprint $table) {
            $table->string('utm_source')->after('status')->nullable();
            $table->string('utm_medium')->after('utm_source')->nullable();
            $table->string('utm_compaign')->after('utm_medium')->nullable();
            $table->string('utm_term')->after('utm_compaign')->nullable();
            $table->string('utm_content')->after('utm_term')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('requests', function (Blueprint $table) {
            $table->dropColumn('utm_source');
            $table->dropColumn('utm_medium');
            $table->dropColumn('utm_compaign');
            $table->dropColumn('utm_term');
            $table->dropColumn('utm_content');
        });
    }
};
