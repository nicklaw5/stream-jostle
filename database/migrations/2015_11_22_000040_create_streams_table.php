<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('streams', function (Blueprint $t) 
        {
            $t->engine = 'InnoDB';

            $t->bigIncrements('id');
            $t->bigInteger('channel_id')->unsigned()->nullable();  // FK
            $t->bigInteger('game_id')->unsigned()->nullable();     // FK
            $t->integer('video_height')->nullable();
            $t->boolean('is_playlist')->default(0);
            $t->bigInteger('current_viewers')->nullable();
            $t->bigInteger('max_viewers')->nullable();
            $t->bigInteger('avg_viewers')->nullable();
            $t->double('avg_fps', 15, 8)->nullable();
            $t->integer('delay')->nullable();
            $t->timestamp('created_at')->index();
            $t->timestamp('updated_at')->index();

            // FKs
            $t->foreign('game_id')->references('id')->on('games')->onDelete('set null')->onUpdate('cascade');
            $t->foreign('channel_id')->references('id')->on('channels')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('streams', function(Blueprint $t)
        {
            $t->dropForeign('streams_game_id_foreign');
            $t->dropForeign('streams_channel_id_foreign');
        });

        Schema::drop('streams');
    }
}
