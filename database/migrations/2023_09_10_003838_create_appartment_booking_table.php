<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppartmentBookingTable extends Migration
{
    public function up()
    {
        Schema::create('appartment_booking', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('booking_id')->constrained();
            $table->foreignId('appartment_id')->constrained();
            $table->foreignId('guest_id')->nullable()->constrained();
            $table->date('checkin_date')->nullable();
            $table->date('checkout_date')->nullable();
            $table->enum('status', ['reserved', 'hold', 'canceled'])->default('reserved');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appartment_booking');
    }
}
