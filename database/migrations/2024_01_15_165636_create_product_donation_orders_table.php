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
        Schema::create('product_donation_orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('order_id');
            $table->string('origin_province');
            $table->string('origin_province_id');
            $table->string('origin_city');
            $table->string('origin_city_id');
            $table->string('destination_province');
            $table->string('destination_province_id');
            $table->string('destination_city');
            $table->string('destination_city_id');
            $table->string('destination_district');
            $table->string('destination_village');
            $table->string('home_office_address');
            $table->char('postal_code', 5);
            $table->string('courier');
            $table->string('courier_cost_service');
            $table->string('courier_cost_value');
            $table->string('courier_cost_etd');
            $table->string('full_name');
            $table->string('whatsapp_number');
            $table->string('email');
            $table->enum('shipment_status', ['Waiting for Payment', 'Payment Received', 'Product Shipped']);
            $table->string('payment_method')->nullable();
            $table->string('platform_payment_method');
            $table->enum('payment_status', ['pending', 'failed', 'success']);
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_donation_orders');
    }
};
