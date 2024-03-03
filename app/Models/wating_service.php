<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wating_service extends Model
{
    use HasFactory;

    protected $table = 'wating_service';
    protected  $primaryKey = 'service_id';

    protected $fillable = [
        'institution_id',
        'service_id',
        'paciente_id'
    ];
    
}
