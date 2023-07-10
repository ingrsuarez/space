<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class room extends Model
{
    use HasFactory;

    public function agenda()
    {
        return $this->hasMany('App\Models\Agenda');
    }

    


    
}
