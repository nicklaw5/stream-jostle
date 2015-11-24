<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channels', function (Blueprint $t)
        {

            $t->engine = 'InnoDB';

            $t->bigIncrements('id');
            $t->bigInteger('owner_id')->unsigned()->nullable();
            $t->string('url');
            $t->text('status')->nullable();
            $t->string('language')->nullable();
            $t->bigInteger('views');
            $t->bigInteger('followers');
            $t->boolean('marture')->default(0);
            $t->boolean('partner')->default(0);
            $t->integer('delay')->nullable();
            $t->timestamp('created_at')->index();
            $t->timestamp('updated_at')->index();

            // FKs
            $t->foreign('owner_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('channels', function(Blueprint $t)
        {
            $t->dropForeign('channels_owner_id_foreign');
        });

        Schema::drop('channels');
    }
}
