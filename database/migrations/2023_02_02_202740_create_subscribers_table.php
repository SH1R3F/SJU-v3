<?php

use App\Models\Subscriber;
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
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('fname_ar')->index();
            $table->string('sname_ar')->index();
            $table->string('tname_ar')->index();
            $table->string('lname_ar')->index();
            $table->string('fname_en')->nullable();
            $table->string('sname_en')->nullable();
            $table->string('tname_en')->nullable();
            $table->string('lname_en')->nullable();
            $table->string('gender');
            $table->date('birthday_m')->nullable();
            $table->date('birthday_h')->nullable();
            $table->string('country');
            $table->integer('city')->default(0);
            $table->string('nationality');
            $table->integer('qualification');
            $table->integer('hearabout')->default(1);
            $table->unsignedBigInteger('mobile');
            $table->integer('mobile_key');
            $table->string('email')->unique()->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->tinyInteger('status')->default(Subscriber::STATUS_INACTIVE);
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
        Schema::dropIfExists('subscribers');
    }
};
