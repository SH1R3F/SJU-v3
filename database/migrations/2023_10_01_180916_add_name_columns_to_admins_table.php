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
        Schema::table('admins', function (Blueprint $table) {
            $table->renameColumn('fname', 'fname_ar');
            $table->renameColumn('lname', 'lname_ar');
            $table->string('sname_ar')->nullable()->after('lname');
            $table->string('tname_ar')->nullable()->after('lname');
            $table->string('fname_en')->nullable()->after('lname');
            $table->string('sname_en')->nullable()->after('lname');
            $table->string('tname_en')->nullable()->after('lname');
            $table->string('lname_en')->nullable()->after('lname');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->renameColumn('fname_ar', 'fname');
            $table->renameColumn('lname_ar', 'lname');
            $table->dropColumn('sname_ar');
            $table->dropColumn('tname_ar');
            $table->dropColumn('fname_en');
            $table->dropColumn('sname_en');
            $table->dropColumn('tname_en');
            $table->dropColumn('lname_en');
        });
    }
};
