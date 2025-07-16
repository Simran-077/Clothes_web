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
        Schema::create('order_items', function (Blueprint $table) {
             $table->id(); // Primary key
            $table->string('product_name');
            $table->string('image')->nullable();
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2); // For prices like 99999999.99
            $table->decimal('total', 10, 2);
            $table->unsignedBigInteger('order_id'); // Foreign key to orders table
            $table->timestamps();

            // Optional: Foreign key constraint
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
