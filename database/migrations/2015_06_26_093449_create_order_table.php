<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function($table){

            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->dateTime('date')->nullable();

            $table->string('status', 20)->default('CREATED');
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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::drop('order');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
