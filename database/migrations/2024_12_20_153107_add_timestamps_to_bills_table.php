<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToBillsTable extends Migration
{
    public function up()
    {
        Schema::table('bills', function (Blueprint $table) {
            // Add the created_at and updated_at columns
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('bills', function (Blueprint $table) {
            // Remove the created_at and updated_at columns if rolling back the migration
            $table->dropColumn(['created_at', 'updated_at']);
        });
    }
}
