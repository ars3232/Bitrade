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
            $table->string('title')->nullable(); // Product title
            $table->longText('description')->nullable(); // Long text for product description
            $table->string('image')->nullable(); // URL or path to the product image
            $table->string('category')->nullable(); // Product category
            $table->integer('quantity')->nullable(); // Quantity of the product
            $table->decimal('price', 8, 2)->nullable(); // Price of a single unit, two decimal places
            $table->decimal('totalprice', 10, 2)->nullable(); // Total price, two decimal places
            $table->timestamps(); //
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
