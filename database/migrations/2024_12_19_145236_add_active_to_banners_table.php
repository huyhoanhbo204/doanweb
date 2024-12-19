<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActiveToBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banners', function (Blueprint $table) {
            // Thêm cột 'active' với kiểu boolean
            $table->boolean('active')->default(1); // Giá trị mặc định là 1 (kích hoạt)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banners', function (Blueprint $table) {
            // Xóa cột 'active'
            $table->dropColumn('active');
        });
    }
}
