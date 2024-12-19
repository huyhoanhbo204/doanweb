<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('address');
            $table->string('phone', 20);
            $table->text('content')->nullable();
            $table->decimal('totalAmount', 10, 2);
            $table->decimal('discountAmount', 10, 2)->default(0.00);
            $table->decimal('finalAmount', 10, 2);
            $table->foreignId('idUser')->constrained('users')->onDelete('cascade');
            $table->foreignId('idVoucher')->nullable()->constrained('vouchers')->onDelete('set null');
            $table->timestamp('dateCreated')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
}; 