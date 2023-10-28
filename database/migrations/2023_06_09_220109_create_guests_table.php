<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('phone')->required(); // For mobile Phone
            $table->bigInteger('identity')->nullable(); // For Identity
            $table->tinyInteger('vacation_day_start');
            $table->tinyInteger('vacation_day_end');
            $table->boolean('active')->default(0);
            $table->foreignId('workplace_id')->constrained()->default(1);
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
        Schema::dropIfExists('guests');
    }
}
