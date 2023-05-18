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
        DB::statement("DROP VIEW IF EXISTS view_especialidades");
        DB::statement("
            CREATE VIEW view_especialidades
            AS
            SELECT 
                users.id AS user_id, CONCAT(users.name,' ',users.lastName) AS nombre, especialidadesmedicas.codEspecialidad , especialidadesmedicas.nombreEspecialidad, especialidadesporusuario.estado
            FROM 
               especialidadesporusuario 
                    INNER JOIN 
                    users  ON users.id = especialidadesporusuario.codUsuarioEPU
                    INNER JOIN
                    especialidadesmedicas ON especialidadesmedicas.codEspecialidad = especialidadesporusuario.codEspecialidadEPU
                    ORDER BY especialidadesmedicas.nombreEspecialidad DESC
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS view_especialidades");
    }
};
