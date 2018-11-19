<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Match extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('league_id')->unsigned();
            $table->foreign('league_id')
                ->references('id')
                ->on('leagues')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('hometeam')->unsigned();
            $table->foreign('hometeam')
                ->references('id')
                ->on('teams')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('awayteam')->unsigned();
            $table->foreign('awayteam')
                ->references('id')
                ->on('teams')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('date');
            $table->string('time');
            $table->string('status');
            $table->boolean('live');
            $table->integer('hometeam_score');
            $table->integer('awayteam_score');
            $table->integer('hometeam_halftime_score');
            $table->integer('awayteam_halftime_score');
            $table->integer('hometeam_extra_score');
            $table->integer('awayteam_extra_score');
            $table->integer('hometeam_penalty_score');
            $table->integer('awayteam_penalty_score');
            $table->string('hometeam_system');
            $table->string('awayteam_system');
            $table->text('goalscorer');
            $table->text('cards');
            $table->text('hometeam_lineup');
            $table->text('awayteam_lineup');
            $table->text('statistics');
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
        //
    }
}
