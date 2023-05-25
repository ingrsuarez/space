<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profession_user extends Model
{
    protected $table = 'profession_user';
    protected  $primaryKey = 'profession_id';
    use HasFactory;
}
