<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('match_id');
            $table->integer('team1_id')->unsigned();
            $table->integer('team2_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('team1_goals');
            $table->integer('team2_goals');
            $table->string('max_scorer_name');
            $table->integer('max_scorer_amount');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('team1_id')->references('team_id')->on('teams');
            $table->foreign('team2_id')->references('team_id')->on('teams');
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
        Schema::dropIfExists('matches');
    }
};
