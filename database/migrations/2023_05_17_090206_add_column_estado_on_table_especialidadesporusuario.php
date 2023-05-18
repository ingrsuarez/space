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
        Schema::table('especialidadesporusuario', function (Blueprint $table) {
            $table->timestamp('vencimiento')->after('matricula');
            $table->string('estado')->after('codEspecialidadEPU');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('especialidadesporusuario', function (Blueprint $table) { 
            $table->dropColumn('vencimiento');
            $table->dropColumn('estado');
        });
    }
};
