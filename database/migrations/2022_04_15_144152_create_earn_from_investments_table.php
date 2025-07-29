<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEarnFromInvestmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('earn_from_investments', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->integer('fixed_deposit_id');
            $table->integer('no_of_days');
            $table->float('profit_ratio');
            $table->string('transaction_id', 40);
            $table->string('transaction_type', 30);
            $table->float('investment_amount');
            $table->float('total_profit');
            $table->float('sub_total')->comment('investment_amount + total_profit');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('earn_from_investments');
    }
}
