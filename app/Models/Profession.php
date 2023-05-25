<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    
    
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    public function hasUser($user_id , $profession_id)
    {
        
        $profession = Profession::find($profession_id);
        $hasUser = $profession->users()->where('id', $user_id)->exists();
        return $hasUser;
    }

    
}
