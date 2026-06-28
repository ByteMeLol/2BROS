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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            
            $table->string('sku')->unique(); // e.g., CPL-HP-90
            $table->string('description');   // e.g., High-Pressure Hydraulic Coupler
            $table->string('category');      // e.g., mechanical, tools
            $table->decimal('unit_price', 12, 2)->default(0);
            
            $table->integer('stock_count')->default(0);
            $table->integer('safety_threshold')->default(5); // M
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
