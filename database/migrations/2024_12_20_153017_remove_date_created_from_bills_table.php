<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveDateCreatedFromBillsTable extends Migration
{
    public function up()
    {
        Schema::table('bills', function (Blueprint $table) {
            // Remove the dateCreated column
            $table->dropColumn('dateCreated');
        });
    }

    public function down()
    {
        Schema::table('bills', function (Blueprint $table) {
            // If rolling back the migration, add the dateCreated column back
            $table->timestamp('dateCreated')->useCurrent();
        });
    }
}
