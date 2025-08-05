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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('barcode');
            $table->string('description')->unique();
            $table->string('category');
            $table->string('unit');
            $table->string('supplier');
            $table->decimal('purchase_price',10,2);
            $table->decimal('sale_price',10,2);
            $table->date('validity');
            $table->integer('minimum_stock');
            $table->integer('maximum_stock');
            $table->integer('available_stock');
            $table->string('location')->unique();
            $table->string('image');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
