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
        Schema::create('donation_recaps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('foreign_id');
            $table->enum('type', ['user_donations', 'product_donation_orders']);
            $table->string('fullname');
            $table->integer('amount');
            $table->text('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation_recaps');
    }
};
