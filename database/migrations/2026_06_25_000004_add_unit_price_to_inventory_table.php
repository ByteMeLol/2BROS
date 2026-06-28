<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('inventory')) {
            return;
        }

        if (Schema::hasColumn('inventory', 'unit_price')) {
            return;
        }

        Schema::table('inventory', function (Blueprint $table) {
            $table->decimal('unit_price', 12, 2)->default(0)->after('category');
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('inventory') || ! Schema::hasColumn('inventory', 'unit_price')) {
            return;
        }

        Schema::table('inventory', function (Blueprint $table) {
            $table->dropColumn('unit_price');
        });
    }
};