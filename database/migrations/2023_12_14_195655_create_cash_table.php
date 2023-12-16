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
        Schema::create('cash', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('owner_id')->unsigned()->index();
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('institution_id')->unsigned()->index();
            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
            $table->unsignedBigInteger('paciente_id')->unsigned()->index()->nullable();
            $table->foreign('paciente_id')->references('codPaciente')->on('pacientes')->onDelete('cascade');
            $table->string('description')->nullable();
            $table->float('debit')->nullable();
            $table->float('credit')->nullable();
            $table->unsignedBigInteger('book_id')->unsigned()->index()->nullable();
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
        Schema::dropIfExists('cash');
    }
};
