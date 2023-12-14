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
        Schema::table('nutrition_sheets', function (Blueprint $table) {

            $table->string('masa_grasa')->nullable()->after('pauta_observaciones');
            $table->string('exceso_imc_perdido')->nullable()->after('pauta_observaciones');
            $table->string('peso_perdido')->nullable()->after('pauta_observaciones');
            $table->string('imc_perdido')->nullable()->after('pauta_observaciones');
            $table->string('imc_inicial')->nullable()->after('pauta_observaciones');
            $table->string('peso_ajustado')->nullable()->after('pauta_observaciones');
            $table->string('peso_inicial')->nullable()->after('pauta_observaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nutrition_sheets', function (Blueprint $table) {

            $table->dropColumn('peso_inicial');
            $table->dropColumn('peso_ajustado');
            $table->dropColumn('imc_inicial');
            $table->dropColumn('imc_perdido');
            $table->dropColumn('peso_perdido');
            $table->dropColumn('exceso_imc_perdido');
            $table->dropColumn('masa_grasa');
        });
    }
};
