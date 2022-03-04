<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question_type');
            $table->integer('lesson_id')->unsigned();
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
            $table->longtext('question_text');
            $table->longText('question_options')->nullable();
            $table->longText('question_answer')->nullable();
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
        Schema::drop('questions');
    }
}
