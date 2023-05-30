<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution_admin extends Model
{
    use HasFactory;
    protected $table = 'institution_admin';
    protected  $primaryKey = 'institution_id';
}
