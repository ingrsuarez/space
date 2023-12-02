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
        Schema::create('clinical_sheets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('institution_id')->unsigned()->index();
            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
            $table->unsignedBigInteger('paciente_id')->unsigned()->index();
            $table->foreign('paciente_id')->references('codPaciente')->on('pacientes')->onDelete('cascade');
            $table->string('fibroscan')->nullable();
            $table->string('efca')->nullable();
            $table->string('cx_bariatrica')->nullable();
            $table->string('hta')->nullable();
            $table->string('dbt')->nullable();
            $table->string('cx')->nullable();
            $table->string('otros')->nullable();
            $table->string('oam')->nullable();
            $table->string('ginecologo')->nullable();
            $table->string('vacunas')->nullable();
            $table->string('obesidad')->nullable();
            $table->string('internacion')->nullable();
            $table->string('ta')->nullable();
            $table->float('peso')->nullable();
            $table->float('altura')->nullable();
            $table->float('imc')->nullable();
            $table->float('cintura')->nullable();
            $table->float('cuello')->nullable();
            $table->string('resp')->nullable();
            $table->string('cv')->nullable();
            $table->string('abdomen')->nullable();
            $table->string('mmii')->nullable();
            $table->string('actividad_fisica')->nullable();
            $table->string('oh')->nullable();
            $table->string('tbq')->nullable();
            $table->string('drogas')->nullable();
            $table->string('alergias')->nullable();
            $table->string('sueño')->nullable();
            $table->string('catarsis')->nullable();
            $table->string('diuresis')->nullable();
            $table->string('gpca')->nullable();
            $table->string('fum')->nullable();
            $table->string('aco')->nullable();
            $table->string('ant_familiares')->nullable();
            $table->string('vive_con')->nullable();
            $table->string('farmacos')->nullable();
            $table->string('plan')->nullable();
            $table->string('problemas')->nullable();
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
        Schema::dropIfExists('clinical_sheets');
    }
};
