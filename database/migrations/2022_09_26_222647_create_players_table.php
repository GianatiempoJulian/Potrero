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
        Schema::create('players', function (Blueprint $table) {
            $table->increments('player_id');
            $table->integer('team_id')->unsigned()->nullable();
            $table->integer('created_by')->unsigned();
            $table->string('picture');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('matches');
            $table->integer('matches_win');
            $table->integer('goals');
            $table->float('average');
            $table->integer('today_goals');
            $table->integer('matches_with_this_team');
            $table->integer('goals_with_this_team');
            $table->boolean('plays_today');
            $table->foreign('team_id')->references('team_id')->on('teams');
            $table->foreign('created_by')->references('id')->on('users');
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
        Schema::dropIfExists('players');
    }
};
