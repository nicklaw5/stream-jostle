<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_summaries', function (Blueprint $t)
        {
            $t->engine = 'InnoDB';

            $t->bigIncrements('id');
            $t->bigInteger('game_id')->unsigned()->index();
            $t->integer('channels');
            $t->integer('viewers');
            $t->timestamp('created_at')->index();

            $t->foreign('game_id')->references('id')->on('games')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('game_summaries', function(Blueprint $t)
        {
            $t->dropForeign('game_summaries_game_id_foreign');
        });

        Schema::drop('game_summaries');
    }
}
