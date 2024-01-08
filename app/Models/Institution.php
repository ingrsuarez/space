<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Institution extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }

    public function admins()
    {
        return $this->belongsToMany('App\Models\User', 'institution_admin', 'institution_id', 'user_id')->withTimestamps();
    }

    public function watingPatients()
    {
        return $this->belongsToMany('App\Models\Paciente','wating_list','institution_id','paciente_id')->withTimestamps();
    }

    public function rooms()
    {
        return $this->belongsToMany('App\Models\Room')->withTimestamps();
    }

    public function sheets()
    {
        return $this->belongsToMany('App\Models\Sheet','sheet_institution');
    }

    public function hasSheet($sheet_id)
    {
        $hasSheet = $this->sheets()->where('id', $sheet_id)->exists();
        return $hasSheet;
    }

    public function services()
    {
        return $this->belongsToMany('App\Models\service','service_institution')->withTimestamps();
    }

    public function hasService($service_id)
    {
        $hasService = $this->services()->where('id', $service_id)->exists();
        return $hasService;
    }

    public function hasServicePath($service_path)
    {
        $hasService = $this->services()->where('path', $service_path)->exists();
        return $hasService;
    }

}
