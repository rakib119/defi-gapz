<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->float('old_balance');
            $table->string('transaction_id')->unique()->nullable();
            $table->string('transaction_type');
            $table->float('transaction_amount');
            $table->float('transaction_fee')->default(0);
            $table->float('profit')->default(0);
            $table->string('wallet_address')->nullable();
            $table->float('subtotal');
            $table->float('current_balance');
            $table->string('transfer_from')->nullable();
            $table->string('transfer_to')->nullable();
            $table->integer('withdrawal_method')->nullable();
            $table->timestamps();
            $table->integer('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_transactions');
    }
}
