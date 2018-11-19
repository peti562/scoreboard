<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('teams', function (Blueprint $table) {
          $table->primary('team_id')->unsigned();
          $table->string('team_name');
          $table->integer('country_id')->unsigned();
          $table->foreign('country_id')
              ->references('id')
              ->on('countries')
              ->onUpdate('cascade')
              ->onDelete('cascade');
          $table->string('default_background_url')->nullable();
          $table->string('color1')->nullable();
          $table->string('color2')->nullable();
          $table->string('color3')->nullable();
          $table->string('color4')->nullable();
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
        Schema::dropIfExists('teams');
    }
}
