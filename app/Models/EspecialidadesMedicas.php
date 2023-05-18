<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspecialidadesMedicas extends Model
{
    protected $table = 'especialidadesmedicas';
    protected  $primaryKey = 'codEspecialidad';
    use HasFactory;
}
