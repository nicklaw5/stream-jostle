<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $t)
        {
            $t->engine = 'InnoDB';

            $t->bigIncrements('id');
            $t->bigInteger('twitch_id')->unsigned()->index();
            $t->bigInteger('giantbomb_id')->unsigned()->index();
            $t->string('name')->index();
            $t->string('box_small');
            $t->string('box_medium');
            $t->string('box_large');
            $t->string('logo_small');
            $t->string('logo_medium');
            $t->string('logo_large');
            $t->timestamp('created_at')->index();
            $t->timestamp('updated_at')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('games');
    }
}