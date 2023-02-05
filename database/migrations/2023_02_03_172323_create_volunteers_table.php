<?php

use App\Models\Volunteer;
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
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->string('fname_ar')->index()->nullable();
            $table->string('sname_ar')->index()->nullable();
            $table->string('tname_ar')->index()->nullable();
            $table->string('lname_ar')->index()->nullable();
            $table->string('fname_en')->nullable();
            $table->string('sname_en')->nullable();
            $table->string('tname_en')->nullable();
            $table->string('lname_en')->nullable();
            $table->string('gender')->nullable();
            $table->string('country')->nullable();
            $table->unsignedInteger('city')->index()->default(0)->nullable();
            $table->string('nationality')->nullable();
            $table->string('qualification')->nullable();
            $table->unsignedBigInteger('national_id')->index()->nullable();
            $table->string('marital_status')->nullable();
            $table->string('region')->nullable();
            $table->string('governorate')->nullable();
            $table->text('national_address')->nullable();
            $table->string('job_title')->nullable();
            $table->string('residence')->nullable();
            $table->text('fields')->nullable();
            $table->string('education_level')->nullable();
            $table->text('experiences')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedInteger('hearabout')->default(1)->nullable();
            $table->unsignedBigInteger('mobile')->index()->nullable();
            $table->unsignedInteger('mobile_key')->index()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile_photo')->nullable();
            $table->tinyInteger('status')->default(Volunteer::STATUS_INACTIVE);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('branch_id')->references('id')->on('branches')->restrictOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('volunteers');
    }
};
