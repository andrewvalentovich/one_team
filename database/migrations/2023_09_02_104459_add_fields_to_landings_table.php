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
            $table->string('phone')->nullable();
            $table->string('main_title')->nullable();
            $table->text('main_content')->nullable();
            $table->string('main_photo')->nullable();
            $table->json('main_lists')->nullable();
            $table->string('objects_title')->nullable();
            $table->string('about_title')->nullable();
            $table->string('about_subtitle')->nullable();
            $table->json('about_description')->nullable();
            $table->json('purchase_terms')->nullable();
            $table->string('territory')->nullable();
            $table->string('vnj_title')->nullable();
            $table->text('vnj_content')->nullable();
            $table->text('map')->nullable();
            $table->string('sight_title')->nullable();
            $table->json('sight_cards')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('landings', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('main_title');
            $table->dropColumn('main_content');
            $table->dropColumn('main_photo');
            $table->dropColumn('main_lists');
            $table->dropColumn('objects_title');
            $table->dropColumn('about_title');
            $table->dropColumn('about_subtitle');
            $table->dropColumn('about_description');
            $table->dropColumn('purchase_terms');
            $table->dropColumn('territory');
            $table->dropColumn('vnj_title');
            $table->dropColumn('vnj_content');
            $table->dropColumn('map');
            $table->dropColumn('sight_title');
            $table->dropColumn('sight_cards');
        });
    }
};
