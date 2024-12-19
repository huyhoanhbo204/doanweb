<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('description')->nullable();
            $table->decimal('discountValue', 10, 2);
            $table->enum('type', ['percent', 'fixed'])->default('percent')->nullable();
            $table->datetime('validFrom');
            $table->datetime('validTo');
            $table->enum('status', ['active', 'inactive'])->default('active');
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
