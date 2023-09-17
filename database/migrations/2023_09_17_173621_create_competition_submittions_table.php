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
        Schema::create('competition_submittions', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('userable');
            $table->unsignedBigInteger('competition_id');
            $table->timestamps();

            $table->foreign('competition_id')->references('id')->on('competitions')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competition_submittions');
    }
};
