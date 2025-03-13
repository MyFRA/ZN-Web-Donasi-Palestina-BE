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
        Schema::table('virtual_bank_accounts', function (Blueprint $table) {
            $table->enum('type', ['ewallet', 'va', 'qris'])->after('bank_short_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('virtual_bank_accounts', function (Blueprint $table) {
            //
        });
    }
};
