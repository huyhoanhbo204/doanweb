<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('voucher_usage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idVoucher')->constrained('vouchers')->onDelete('cascade');
            $table->foreignId('idUser')->constrained('users')->onDelete('cascade');
            $table->foreignId('idBill')->constrained('bills')->onDelete('cascade');
            $table->timestamp('usedAt')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voucher_usage');
    }
}; 