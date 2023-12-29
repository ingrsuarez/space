<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class historialClinico extends Model
{
    protected $table = 'historialClinico';
    protected  $primaryKey = 'codPosteo';
    use HasFactory;

    public function users()
    {
        return $this->belongsTo('App\Models\User','codUsuarioHC');
    }

    public function pacientes()
    {
        return $this->belongsTo('App\Models\Paciente','codPacienteHC','codPaciente');
    }

    public function institutions()
    {
        return $this->belongsTo('App\Models\Institution','codInstitucionHC');
    }
}
