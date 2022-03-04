<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_test', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('test_id')->unsigned();
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
            $table->integer('question_id')->unsigned();
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
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
        Schema::drop('question_test');
    }
}
