<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_progress', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('userId');
            $table->tinyInteger('timeRemaining');
            $table->integer('rocks');
            $table->integer('magic');
            $table->integer('quarries');
            $table->integer('libraries');
            $table->integer('defenders');
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
        Schema::dropIfExists('game_progress');
    }
}
