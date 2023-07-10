<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Institution extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    public function admins()
    {
        return $this->belongsToMany('App\Models\User', 'institution_admin', 'institution_id', 'user_id');
    }

    public function watingPatients()
    {
        return $this->belongsToMany('App\Models\Paciente','wating_list','institution_id','paciente_id');
    }

    public function rooms()
    {
        return $this->belongsToMany('App\Models\Room');
    }

}
