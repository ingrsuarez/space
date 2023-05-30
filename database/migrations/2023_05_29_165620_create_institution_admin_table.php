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
        if (!Schema::hasTable('institution_admin'))    
        {
            Schema::create('institution_admin', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->unsigned()->index();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->unsignedBigInteger('institution_id')->unsigned()->index();
                $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
                $table->primary(['user_id', 'institution_id']);
                $table->string('status');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institution_admin');
    }
};
