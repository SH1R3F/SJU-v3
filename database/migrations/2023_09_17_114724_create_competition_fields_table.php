<?php

use App\Models\CompetitionField;
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
        Schema::create('competition_fields', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type')->default(CompetitionField::TYPE_TEXT);
            $table->boolean('required')->default(false);
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
        Schema::dropIfExists('competition_fields');
    }
};
