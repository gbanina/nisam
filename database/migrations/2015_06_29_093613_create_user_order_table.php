<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_order', function($table){

            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('order_id')->unsigned();
			$table->integer('place_id')->unsigned();
            $table->text('desc')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Generic
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->engine = 'InnoDB';
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
