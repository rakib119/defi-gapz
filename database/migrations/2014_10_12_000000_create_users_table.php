<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->string('country')->nullable();
            $table->string('account_number')->nullable();
            $table->string('full_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('bank_account_no')->nullable();
            $table->string('swift_or_iban_code')->nullable();
            $table->string('wallet_address')->nullable();
            $table->string('reference')->nullable();
            $table->string('role')->default('0')->comment('0 for user and 1 for admin 2 for merchants/CEO');
            $table->timestamp('identification_request_time')->nullable();
            $table->string('identification_image')->nullable();
            $table->integer('identification_status')->nullable()->comment('1 for verified, 2 for rejected, 3 for pending');
            $table->timestamp('identification_time')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('password');
            $table->string('transaction_password')->nullable();
            $table->string('telegram')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
