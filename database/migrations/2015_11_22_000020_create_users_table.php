<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $t)
        {

            $t->engine = 'InnoDB';

            $t->bigIncrements('id');
            $t->string('name')->index();
            $t->string('display_name')->index();
            $t->timestamp('created_at')->index();
            $t->timestamp('updated_at')->index();
            $t->timestamp('deleted_at')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
