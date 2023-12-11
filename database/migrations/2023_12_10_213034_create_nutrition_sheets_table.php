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
        Schema::create('nutrition_sheets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('institution_id')->unsigned()->index();
            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
            $table->unsignedBigInteger('paciente_id')->unsigned()->index();
            $table->foreign('paciente_id')->references('codPaciente')->on('pacientes')->onDelete('cascade');
            $table->string('edad')->nullable();
            $table->string('fuma')->nullable();
            $table->string('tipo_actividad')->nullable();
            $table->string('frecuencia_actividad')->nullable();
            $table->string('duracion_actividad')->nullable();
            $table->string('peso')->nullable();
            $table->string('altura')->nullable();
            $table->string('peso_ideal')->nullable();
            $table->string('imc')->nullable();
            $table->string('horas_suenio')->nullable();
            $table->string('ocupacion')->nullable();
            $table->string('jornada')->nullable();
            $table->string('cuello')->nullable();
            $table->string('cintura')->nullable();
            $table->string('desayuno')->nullable();
            $table->string('almuerzo')->nullable();
            $table->string('merienda')->nullable();
            $table->string('cena')->nullable();
            $table->string('colaciones')->nullable();
            $table->string('no_ingiere')->nullable();
            $table->string('predilectos')->nullable();
            $table->string('intolerancias_alergias')->nullable();
            $table->string('alcohol')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('diagnostico_nutricional')->nullable();
            $table->string('indicacion_nutricional')->nullable();
            $table->string('meta_uno')->nullable();
            $table->string('meta_dos')->nullable();
            $table->string('meta_tres')->nullable();
            $table->string('gr_hdc')->nullable();
            $table->string('gr_prot')->nullable();
            $table->string('gr_grasas')->nullable();
            $table->string('pauta_cualitativo')->nullable();
            $table->string('pauta_cuantitativo')->nullable();
            $table->string('pauta_observaciones')->nullable();
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
        Schema::dropIfExists('nutrition_sheets');
    }
};
