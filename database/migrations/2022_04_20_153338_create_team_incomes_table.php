<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_incomes', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->string('team_member_uid');
            $table->float('profit_ratio');
            $table->float('profit');
            $table->float('team_member_profit');
            $table->integer('genaration')->comment('1,2,3 normal user , 9 for marchents/ceo');
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
        Schema::dropIfExists('team_incomes');
    }
}
