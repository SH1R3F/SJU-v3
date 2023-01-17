<?php

use App\Models\TechnicalSupportTicket;
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
        Schema::create('technical_support_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->boolean('status')->default(TechnicalSupportTicket::STATUS_OPEN);
            $table->morphs('supportable');
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
        Schema::dropIfExists('technical_support_tickets');
    }
};
