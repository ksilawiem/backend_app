<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffreAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offre_answers', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->boolean('valid');
            $table->unsignedBigInteger('question_id');
            $table->foreign('question_id')
                  ->references('id')
                  ->on('offre_questions')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('offre_id');
            $table->foreign('offre_id')
                    ->references('id')
                    ->on('offres')
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
        Schema::dropIfExists('offre_answers');
    }
}
