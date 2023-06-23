<?php

use App\Models\Course\Course;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar')->index();
            $table->string('title_en')->nullable()->index();
            $table->string('course_number')->unique()->nullable();
            $table->unsignedBigInteger('course_category_id')->nullable();
            $table->unsignedBigInteger('course_type_id')->nullable();
            $table->unsignedBigInteger('course_gender_id')->nullable();
            $table->unsignedBigInteger('course_branch_id')->nullable();
            $table->string('region')->nullable()->index();
            $table->string('map_link')->nullable();
            $table->string('lng')->nullable();
            $table->string('lat')->nullable();
            $table->unsignedInteger('seats')->nullable()->default(0);
            $table->date('date_from')->index();
            $table->date('date_to')->index();
            $table->time('time_from');
            $table->time('time_to');
            $table->json('days')->nullable();
            $table->unsignedInteger('minutes')->default(1);
            $table->unsignedInteger('percentage')->nullable();
            $table->tinyInteger('cost')->default(0);
            $table->unsignedInteger('price')->nullable();
            $table->string('currency')->nullable()->default('SAR');
            $table->tinyInteger('payment_method')->nullable();
            $table->string('image')->nullable();
            $table->json('images')->nullable();
            $table->string('trainer')->nullable();
            $table->text('summary')->nullable();
            $table->longText('content')->nullable();
            $table->string('zoom')->nullable();
            $table->string('youtube')->nullable();
            $table->unsignedBigInteger('template_id')->nullable();
            $table->unsignedBigInteger('questionnaire_id')->nullable()->default(24);
            $table->unsignedInteger('attendance_mins')->nullable();

            $table->integer('status')->default(Course::STATUS_AVAILABLE);

            $table->timestamps();

            $table->foreign('course_category_id')->references('id')->on('courses_categories')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('course_type_id')->references('id')->on('courses_types')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('course_gender_id')->references('id')->on('courses_genders')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('course_branch_id')->references('id')->on('branches')->restrictOnDelete()->cascadeOnUpdate();

            $table->foreign('template_id')->references('id')->on('courses_templates')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('questionnaire_id')->references('id')->on('courses_questionnaires')->restrictOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
