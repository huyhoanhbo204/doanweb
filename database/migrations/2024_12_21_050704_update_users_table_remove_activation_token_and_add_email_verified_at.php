<?php

// database/migrations/xxxx_xx_xx_xxxxxx_update_users_table_remove_activation_token_and_add_email_verified_at.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTableRemoveActivationTokenAndAddEmailVerifiedAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the activation_token column
            $table->dropColumn('activation_token');
            
            // Add email_verified_at column
            $table->timestamp('email_verified_at')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add the activation_token column back
            $table->string('activation_token', 64)->nullable()->after('status');
            
            // Drop the email_verified_at column
            $table->dropColumn('email_verified_at');
        });
    }
}
