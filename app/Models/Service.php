<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function watingMe()
    {
        return $this->belongsToMany('App\Models\Paciente','wating_service','service_id','paciente_id')->withPivot('institution_id','created_at')->orderBy('pivot_created_at','ASC');
    }
    
}
