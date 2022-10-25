<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_answers', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->boolean('valid');
            $table->unsignedBigInteger('question_id');
            $table->foreign('question_id')
                  ->references('id')
                  ->on('quiz_questions')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('test_id');
            $table->foreign('test_id')
                    ->references('id')
                    ->on('tests')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('quiz_answers');
    }
}
