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
        Schema::table('exchange_rates', function (Blueprint $table) {
            $table->renameColumn('direct_val', 'direct');
            $table->renameColumn('relative_val', 'relative');
            $table->renameColumn('sell_val', 'value');
            $table->dropColumn('buy_val');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exchange_rates', function (Blueprint $table) {
            $table->renameColumn('direct', 'direct_val');
            $table->renameColumn('relative', 'relative_val');
            $table->renameColumn('value', 'sell_val');
            $table->float('buy_val');
        });
    }
};
