<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentService extends Model
{
    use HasFactory;

    public function service()
    {
        return $this->belongsTo('App\Models\Service');
    }

    public function paciente()
    {
        return $this->belongsTo('App\Models\Paciente','paciente_id','codPaciente');
    }

    public function institution()
    {
        return $this->belongsTo('App\Models\Institution');
    }

    public function insurance()
    {
        return $this->belongsTo('App\Models\Insurance');
    }
}
