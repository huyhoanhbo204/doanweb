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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->decimal('price', 10, 2); // Đảm bảo kiểu dữ liệu cho giá sản phẩm
            $table->boolean('hot')->default(false); // Sản phẩm nổi bật (hot)
            $table->text('description')->nullable(); // Mô tả sản phẩm
            $table->foreignId('category_id') // Tên trường khóa ngoại (category_id thay vì idCategory)
                ->constrained('categories') // Tên bảng `categories`
                ->onDelete('cascade'); // Khi xóa danh mục, xóa tất cả sản phẩm liên quan
            $table->enum('status', ['active', 'inactive'])->default('active'); // Trạng thái sản phẩm

            // Tạo các trường `created_at` và `updated_at` tự động
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
  
};
