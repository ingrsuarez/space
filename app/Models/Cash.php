<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cash extends Model
{

    use HasFactory;
    protected $table = 'cash';

    public function pacientes()
    {
        return $this->belongsTo('App\Models\Paciente','paciente_id','codPaciente');
    }
    public function users()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
}
