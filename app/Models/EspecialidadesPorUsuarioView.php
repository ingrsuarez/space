<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspecialidadesPorUsuarioView extends Model
{
    protected $table = 'view_especialidades';
    protected  $primaryKey = 'user_id';
    use HasFactory;

}
