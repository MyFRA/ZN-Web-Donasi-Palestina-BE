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
        Schema::create('user_donations', function (Blueprint $table) {
            $table->id();
            $table->uuid('order_id');
            $table->integer('amount');
            $table->string('fullname');
            $table->string('whatsapp_number')->nullable();
            $table->string('email')->nullable();
            $table->text('message')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('platform_payment_method');
            $table->enum('status', ['pending', 'failed', 'success']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_donations');
    }
};
