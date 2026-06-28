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
        if (! Schema::hasTable('sales') || ! Schema::hasTable('inventory')) {
            return;
        }

        Schema::table('sales', function (Blueprint $table) {
            $table->foreign('inventory_id')
                ->references('id')
                ->on('inventory')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('sales')) {
            return;
        }

        Schema::table('sales', function (Blueprint $table) {
            $table->dropForeign(['inventory_id']);
        });
    }
};