<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('questionnaire_id');
            $table->string('question');
            $table->boolean('commentable')->comment('1 for commentable answers, 0 for mcq');
            $table->string('answer1')->nullable();
            $table->string('color1')->nullable();
            $table->string('answer2')->nullable();
            $table->string('color2')->nullable();
            $table->string('answer3')->nullable();
            $table->string('color3')->nullable();
            $table->string('answer4')->nullable();
            $table->string('color4')->nullable();
            $table->integer('order')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('questionnaire_id')->references('id')->on('courses_questionnaires')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses_questions');
    }
};
