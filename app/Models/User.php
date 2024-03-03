<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\casts\Attribute;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Registration;
use App\Models\Profession_user;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastName',
        'email',
        'tipo',
        'password',
        'estado',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function historialclinicos()
    {
        return $this->hasMany('App\Models\historialClinico','codUsuarioHC');
    }

    public function professions()
    {
        return $this->belongsToMany('App\Models\Profession');
    }

    public function hasProfession($profession_id)
    {
        
        $user = User::find(Auth::user()->id);
        $hasProfession = $user->professions()->where('id', $profession_id)->exists();
        return $hasProfession;
    }

    public function registrations()
    {
        return $this->hasMany('App\Models\Registration');
    }

    public function institutions()
    {
        return $this->belongsToMany('App\Models\Institution')->withTimestamps();
    }

    public function hasInstitution($institution_id)
    {
        
        $user = User::find(Auth::user()->id);
        $hasInstitution = $user->institutions()->where('id', $institution_id)->exists();
        return $hasInstitution;
    }

    public function hasInstitutionUser($institution_id)
    {
        
        
        $hasInstitution = $this->institutions()->where('id', $institution_id)->exists();
        return $hasInstitution;
    }

    public function adminInstitutions()
    {
        return $this->belongsToMany('App\Models\Institution', 'institution_admin', 'user_id', 'institution_id');
    }

    public function adminsInstitution($institution_id)
    {
        $hasInstitution = $this->adminInstitutions()->where('id', $institution_id)->exists();
        return $hasInstitution;
    }

    public function currentInstitution()
    {
        return $this->belongsTo(Institution::class,'institution_id');
    }

    public function watingMe()
    {
        return $this->belongsToMany('App\Models\Paciente','wating_list','user_id','paciente_id')->withPivot('institution_id','created_at')->orderBy('pivot_created_at','ASC');
    }

    public function myPatients()
    {
        return $this->belongsToMany('App\Models\Paciente','historialclinico','codUsuarioHC','codPacienteHC')->withPivot('entrada', 'created_at')->orderByPivot('created_at', 'desc');
    }

    public function appointments()
    {
        return $this->hasMany('App\Models\Appointments');
    }

    public function agenda()
    {
        return $this->hasMany('App\Models\Agenda');
    }

    public function insurances()
    {
        return $this->belongsToMany('App\Models\Insurance','agreements')->withPivot('price','patient_charge');
    }

    public function hasInsurance($insurance_id)
    {
        
        $user = Auth::user();
        $hasInsurance = $user->insurances()->where('insurance_id', $insurance_id)->exists();
        return $hasInsurance;
    }

    public function services()
    {
        return $this->belongsToMany('App\Models\Service');
    }

    public function hasService($service_id)
    {
        
        $user = Auth::user();
        $hasService = $user->services()->where('id',$service->id)->exists();
        return $hasService;
    }
}
