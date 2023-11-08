<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Paciente extends Model
{
    protected  $primaryKey = 'codPaciente';

    protected $fillable = [
        'nombrePaciente',
    ];
    use HasFactory;


    public function historialclinico()
    {
        return $this->hasMany('App\Models\historialClinico','codPacienteHC','codPaciente');
    }

    public function watingFor()
    {
        return $this->belongsToMany('App\Models\User','wating_list','paciente_id','user_id')->withPivot('institution_id','created_at')->orderBy('pivot_created_at','ASC');
    }
    
    public function waitingIn()
    {
        return $this->belongsToMany('App\Models\Institution', 'wating_list', 'institution_id', 'paciente_id');
    }

    public function appointments()
    {
        return $this->hasMany('App\Models\Appointment','paciente_id','codPaciente');
    }

    public function insurance()
    {
        return $this->belongsTo('App\Models\Insurance','insurance_id','id');
    }
    
}
