<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->integer('rating')->check('rating >= 1 AND rating <= 5');
            $table->foreignId('idUser')->constrained('users')->onDelete('cascade');
            $table->foreignId('idProduct')->constrained('products')->onDelete('cascade');
            $table->timestamp('dateCreated')->useCurrent();
            $table->timestamp('dateUpdated')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
}; 