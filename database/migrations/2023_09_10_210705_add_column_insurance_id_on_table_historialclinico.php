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
        Schema::table('historialClinico', function (Blueprint $table) {

            $table->unsignedBigInteger('insurance_id')->unsigned()->index()->nullable()->after('entrada');
            $table->foreign('insurance_id')->references('id')->on('insurances')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('historialClinico', function (Blueprint $table) { 
            $table->dropColumn('insurance_id');
        });
    }


};
