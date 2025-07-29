<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountStatementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_statements', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->float('total_deposite')->default(0.00);
            $table->float('total_withdraw')->default(0.00);
            $table->float('total_investment')->default(0.00);
            $table->float('investment_profit')->default(0.00);
            $table->float('total_transfer')->default(0.00);
            $table->float('team_income')->default(0.00);
            $table->float('total_depposite_with_profit')->default(0.00);
            $table->float('balance')->default(0.00);
            $table->string('updated_by',11)->nullable();
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
        Schema::dropIfExists('account_statements');
    }
}
