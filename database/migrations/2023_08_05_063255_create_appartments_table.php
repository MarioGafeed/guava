<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppartmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appartments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('hasBeds');
            $table->integer('availableBeds');
            $table->integer('bedshold')->default(0);
            $table->integer('reservedBeds')->default(0);
            $table->foreignId('place_id')->constrained();
            $table->boolean('active')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appartments');
    }
}
