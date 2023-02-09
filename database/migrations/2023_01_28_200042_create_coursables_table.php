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
        Schema::create('coursables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->morphs('coursable');
            $table->boolean('attendance')->default(0);

            $table->foreign('course_id')->references('id')->on('courses')->cascadeOnDelete()->cascadeOnUpdate();

            $table->unique(['course_id', 'coursable_id', 'coursable_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coursables');
    }
};
