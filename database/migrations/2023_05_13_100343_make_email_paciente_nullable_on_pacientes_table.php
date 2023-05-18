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
        Schema::table('pacientes', function (Blueprint $table) {
            //
            
            $table->integer('codPaisPaciente')->default(54)->change();
            $table->integer('codTipoDocumentoPaciente')->nullable(true)->change();
            $table->date('fechaNacimientoPaciente')->nullable(true)->change();
            $table->string('domicilioPaciente','32')->nullable(true)->change();
            $table->string('localidadPaciente','32')->nullable(true)->change();
            $table->integer('codProvinciaOEstadoPaciente')->nullable(true)->change();
            $table->string('telefonoPaciente','32')->nullable(true)->change();
            $table->string('celularPaciente','32')->nullable(true)->change();
            $table->string('emailPaciente','40')->unique()->nullable(true)->change();
            $table->string('sexoPaciente','1')->nullable(true)->change();
            $table->string('estadoCivilPaciente','40')->nullable(true)->change();
            $table->string('ocupacionPaciente','40')->nullable(true)->change();
            $table->string('numeroAfiliadoPaciente','40')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            //
            $table->integer('codPaisPaciente')->nullable(false)->change();
            $table->integer('codTipoDocumentoPaciente')->nullable(false)->change();
            $table->date('fechaNacimientoPaciente')->nullable(false)->change();
            $table->string('domicilioPaciente','32')->nullable(false)->change();
            $table->string('localidadPaciente','32')->nullable(false)->change();
            $table->integer('codProvinciaOEstadoPaciente')->nullable(false)->change();
            $table->string('telefonoPaciente','32')->nullable(false)->change();
            $table->string('celularPaciente','32')->nullable(false)->change();
            $table->string('emailPaciente','40')->nullable(false)->change();
            $table->string('sexoPaciente','1')->nullable(false)->change();
            $table->string('estadoCivilPaciente','40')->nullable(false)->change();
            $table->string('ocupacionPaciente','40')->nullable(false)->change();
            $table->string('numeroAfiliadoPaciente','40')->nullable(false)->change();
        });
    }
};
