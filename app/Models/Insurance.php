<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany('App\Models\User','agreements')->withPivot('price','patient_charge');
    }

    public function pacientes()
    {
        return $this->hasMany('App\Models\User');
    }

}
