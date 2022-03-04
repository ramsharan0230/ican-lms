<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lesson_id')->unsigned();
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
            $table->text('name');
            $table->integer('duration')->default(0);
            $table->integer('repetition')->default(0);
            $table->boolean('published_status')->default(false);
            $table->longText('description')->nullable();
            $table->float('full_marks')->default(0.00);
            $table->float('pass_marks')->default(0.00);
            $table->boolean('shuffle_questions')->default(false);
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
        Schema::drop('tests');
    }
}
