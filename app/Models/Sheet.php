<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sheet extends Model
{
    use HasFactory;


    public function institutions()
    {
        return $this->belongsToMany('App\Models\Institution');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
