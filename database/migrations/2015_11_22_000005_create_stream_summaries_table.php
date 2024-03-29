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
            $t->integer('viewers');
            $t->timestamp('created_at')->index();
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
