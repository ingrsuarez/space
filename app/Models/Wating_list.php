<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Wating_list extends Model
{
    use HasFactory;
    protected $table = 'wating_list';
    protected  $primaryKey = 'user_id';

    protected $fillable = [
        'institution_id',
        'user_id',
        'paciente_id'
    ];

}
