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
                users.id AS user_id, CONCAT(users.name,' ',users.lastName) AS nombre, especialidadesMedicas.codEspecialidad , especialidadesMedicas.nombreEspecialidad, especialidadesPorUsuario.estado
            FROM 
               especialidadesPorUsuario 
                    INNER JOIN 
                    users  ON users.id = especialidadesPorUsuario.codUsuarioEPU
                    INNER JOIN
                    especialidadesMedicas ON especialidadesMedicas.codEspecialidad = especialidadesPorUsuario.codEspecialidadEPU
                    ORDER BY especialidadesMedicas.nombreEspecialidad DESC
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
