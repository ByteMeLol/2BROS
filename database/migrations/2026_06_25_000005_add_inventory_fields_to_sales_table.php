<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('sales')) {
            return;
        }

        if (Schema::hasColumn('sales', 'inventory_id')) {
            return;
        }

        Schema::table('sales', function (Blueprint $table) {
            $table->foreignId('inventory_id')->nullable()->after('company_id')->constrained('inventory')->nullOnDelete();
            $table->integer('quantity')->default(1)->after('billing_terms');
            $table->decimal('unit_price', 12, 2)->default(0)->after('quantity');
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('sales') || ! Schema::hasColumn('sales', 'inventory_id')) {
            return;
        }

        Schema::table('sales', function (Blueprint $table) {
            $table->dropConstrainedForeignId('inventory_id');
            $table->dropColumn(['quantity', 'unit_price']);
        });
    }
};