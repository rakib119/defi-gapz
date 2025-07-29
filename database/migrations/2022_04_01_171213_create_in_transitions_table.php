<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInTransitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_transitions', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->string('transaction_id')->unique()->nullable();
            $table->string('transaction_type');
            $table->float('transaction_amount');
            $table->float('transaction_fee');
            $table->float('subtotal');
            $table->string('wallet_address')->nullable();
            $table->integer('status')->default('0');
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
        Schema::dropIfExists('in_transitions');
    }
}
