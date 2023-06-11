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
            $table->unsignedBigInteger('codPaciente')->change();

        });
        Schema::table('historialClinico', function (Blueprint $table) {
            $table->unsignedBigInteger('codPacienteHC')->change();
            $table->foreign('codPacienteHC')
                ->references('codPaciente')
                ->on('pacientes')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
