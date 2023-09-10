<?php

use App\Models\MembershipTransfer;
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
        Schema::create('membership_transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('transfer_from');
            $table->unsignedBigInteger('transfer_to');
            $table->tinyInteger('status')->default(MembershipTransfer::STATUS_PENDING);
            $table->unsignedBigInteger('request_by');
            $table->unsignedBigInteger('action_by')->nullable();
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('transfer_from')->references('id')->on('branches')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('transfer_to')->references('id')->on('branches')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('request_by')->references('id')->on('admins')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('action_by')->references('id')->on('admins')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membership_transfers');
    }
};
