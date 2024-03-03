<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;


class Paciente extends Authenticatable
{
    protected  $primaryKey = 'codPaciente';
    use HasFactory, Notifiable;
    protected $guard = 'pacientes';

    protected $fillable = [
        'nombrePaciente',
    ];

    public function getAuthPassword()
    {
        return Hash::make($this->idPaciente);
    }

    public function historialclinico()
    {
        return $this->hasMany('App\Models\historialClinico','codPacienteHC','codPaciente');
    }

    public function watingFor()
    {
        return $this->belongsToMany('App\Models\User','wating_list','paciente_id','user_id')->withPivot('institution_id','created_at')->orderBy('pivot_created_at','ASC');
    }

    public function watingServiceFor()
    {
        return $this->belongsToMany('App\Models\User','wating_service','paciente_id','user_id')->withPivot('institution_id','created_at')->orderBy('pivot_created_at','ASC');
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
