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
        Schema::create('psychological_sheets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('institution_id')->unsigned()->index();
            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
            $table->unsignedBigInteger('paciente_id')->unsigned()->index();
            $table->foreign('paciente_id')->references('codPaciente')->on('pacientes')->onDelete('cascade');
            $table->string('edad')->nullable();
            $table->string('peso')->nullable();
            $table->string('peso_maximo')->nullable();
            $table->string('intencion_cirugia')->nullable();
            $table->string('antecedentes')->nullable();
            $table->string('tto_psicologico')->nullable();
            $table->string('tto_psiquiatrico')->nullable();
            $table->string('conducta_alimentaria')->nullable();
            $table->string('atracon')->nullable();
            $table->string('comedor_nocturno')->nullable();
            $table->string('actividad_fisica')->nullable();
            $table->string('trabajo')->nullable();
            $table->string('familia')->nullable();
            $table->string('perdidas')->nullable();
            $table->string('tto_anteriores')->nullable();
            $table->string('limitaciones')->nullable();
            $table->string('evolucion')->nullable();
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
        Schema::dropIfExists('psychological_sheets');
    }
};
