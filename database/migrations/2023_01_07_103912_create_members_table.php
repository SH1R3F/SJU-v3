<?php

use App\Models\Member;
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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('national_id')->unique();
            $table->string('national_id_source');
            $table->date('national_id_date');

            $table->string('membership_number')->unique()->nullable();

            $table->string('fname_ar');
            $table->string('sname_ar');
            $table->string('tname_ar');
            $table->string('lname_ar');
            $table->string('fname_en');
            $table->string('sname_en');
            $table->string('tname_en');
            $table->string('lname_en');
            $table->boolean('gender')->comment('Female: 1, Male: 0');
            $table->date('birthday_h'); // Hijri date
            $table->date('birthday_m'); // Meladi date
            $table->string('nationality');
            $table->string('qualification');
            $table->string('major');
            $table->string('journalistic_profession');
            $table->string('journalistic_employer');
            $table->tinyInteger('newspaper_type');
            $table->string('non_journalistic_profession');
            $table->string('non_journalistic_employer');

            $table->integer('workphone');
            $table->integer('workphone_ext');
            $table->integer('fax')->nullable();
            $table->integer('fax_ext')->nullable();

            $table->integer('postbox');
            $table->integer('postcode');
            $table->string('postcity');

            $table->unsignedBigInteger('branch_id');
            $table->tinyInteger('delivery_option')->default(Member::DELIVERY_OPTION_PICKUP);
            $table->string('delivery_address')->nullable();
            $table->boolean('delivery_status')->default(Member::DELIVERY_STATUS_DEFAULT);

            $table->string('email')->unique();
            $table->bigInteger('mobile')->unique();
            $table->integer('mobile_code')->nullable();
            $table->string('password');

            $table->string('profile_photo')->nullable();
            $table->string('national_id_photo')->nullable();
            $table->string('statement_photo')->nullable();
            $table->string('license_photo')->nullable();
            $table->string('contract_photo')->nullable();
            $table->json('exp_flds_lngs')->nullable();

            $table->timestamp('mobile_verified_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();

            $table->tinyInteger('status')->default(Member::STATUS_UNAPPROVED);
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
        Schema::dropIfExists('members');
    }
};
