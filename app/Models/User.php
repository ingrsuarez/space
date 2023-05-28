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
}
