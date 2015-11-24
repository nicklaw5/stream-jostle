<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStreamSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stream_summaries', function (Blueprint $t)
        {
            $t->engine = 'InnoDB';
            
            $t->bigIncrements('id');
            $t->integer('channels');
            // $t->integer('channels_min')->nullable();
            // $t->integer('channels_max')->nullable();
            $t->integer('viewers');
            // $t->integer('viewers_min')->nullable();
            // $t->integer('viewer_max')->nullable();
            $t->dateTime('created_at')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stream_summaries');
    }
}
