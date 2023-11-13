<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload_file extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function paciente()
    {
        return $this->belongsTo('App\Models\Paciente','paciente_id','codPaciente');
    }

    public function institution()
    {
        return $this->belongsTo('App\Models\Institution');
    }
}
