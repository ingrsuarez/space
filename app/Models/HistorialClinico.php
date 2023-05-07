<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historialClinico extends Model
{
    protected $table = 'historialClinico';
    protected  $primaryKey = 'codPosteo';
    use HasFactory;
}
