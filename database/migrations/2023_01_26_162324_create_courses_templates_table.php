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
        Schema::create('courses_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('layout');
            $table->string('mode');
            $table->string('file')->nullable();
            $table->string('preview')->nullable();
            $table->json('variables')->nullable();
            $table->boolean('with_title');
            $table->string('male_title')->nullable();
            $table->string('female_title')->nullable();
            $table->string('qr_position');
            $table->string('qr_margin_top')->nullable();
            $table->string('qr_margin_right')->nullable();
            $table->string('qr_margin_bottom')->nullable();
            $table->string('qr_margin_left')->nullable();
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
        Schema::dropIfExists('courses_templates');
    }
};
