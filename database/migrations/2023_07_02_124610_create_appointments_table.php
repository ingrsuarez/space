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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institution_id')->unsigned()->index();
            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('paciente_id')->unsigned()->index();
            $table->foreign('paciente_id')->references('codPaciente')->on('pacientes')->onDelete('cascade');
            $table->unsignedBigInteger('room_id')->unsigned()->index();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->dateTime('start'); //hour
            $table->dateTime('end'); //hour
            $table->string('medicare');
            $table->string('obs');
            $table->boolean('overturn');
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
        Schema::dropIfExists('appointments');
    }
};
