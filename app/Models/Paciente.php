<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Paciente extends Model
{
    protected  $primaryKey = 'codPaciente';
    use HasFactory;


    public function historialclinico()
    {
        return $this->hasMany('App\Models\historialClinico','codPacienteHC','codPaciente');
    }

    public function waitingFor()
    {
        return $this->belongsToMany('App\Models\User', 'wating_list', 'user_id', 'paciente_id');
    }

    

    
}
