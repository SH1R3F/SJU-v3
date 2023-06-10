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
        Schema::table('invitations', function (Blueprint $table) {
            $table->string('qr_position')->default('none')->after('variables');
            $table->string('qr_position_x')->nullable()->after('qr_position');
            $table->string('qr_position_y')->nullable()->after('qr_position_x');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invitations', function (Blueprint $table) {
            $table->dropColumn('qr_position');
            $table->dropColumn('qr_position_x');
            $table->dropColumn('qr_position_y');
        });
    }
};
