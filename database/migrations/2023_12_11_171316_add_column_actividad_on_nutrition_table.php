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

            $table->string('actividad')->nullable()->after('fuma');
            $table->string('bariatrica')->nullable()->after('jornada');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropColumn('actividad');
        $table->dropColumn('bariatrica');
    }
};
