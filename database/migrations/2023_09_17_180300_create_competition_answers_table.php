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
        Schema::create('competition_answers', function (Blueprint $table) {
            $table->id();
            $table->text('answer_text')->nullable();
            $table->string('answer_file')->nullable();
            $table->date('answer_date')->nullable();
            $table->unsignedBigInteger('competition_submittion_id');
            $table->unsignedBigInteger('competition_field_id');
            $table->timestamps();

            $table->foreign('competition_submittion_id')->references('id')->on('competition_submittions')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('competition_field_id')->references('id')->on('competition_fields')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competition_answers');
    }
};
