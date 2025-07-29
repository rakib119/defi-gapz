<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitionTransitionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competition_transition_details', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->string('order_no')->unique();
            $table->string('region')->nullable();
            $table->string('supplier')->nullable();
            $table->float('market_price');
            $table->float('transition_amount');
            $table->float('order_amount');
            $table->float('profit');
            $table->integer('batch_no')->default(0);
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
        Schema::dropIfExists('competition_transition_details');
    }
}
