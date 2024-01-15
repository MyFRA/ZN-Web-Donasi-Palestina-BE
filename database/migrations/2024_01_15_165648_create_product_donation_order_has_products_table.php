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
        Schema::create('product_donation_order_has_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_donation_order_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('price');
            $table->integer('qty');
            $table->integer('weight');
            $table->integer('total');
            $table->timestamps();

            $table->foreign('product_donation_order_id', 'foreign_pdohp_product_donation_order_id')->references('id')->on('product_donation_orders');
            $table->foreign('product_id', 'foreign_pdohp_product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_donation_order_has_products');
    }
};
