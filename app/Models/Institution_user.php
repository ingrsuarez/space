<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution_user extends Model
{

    use HasFactory;
    protected $table = 'institution_user';
    protected  $primaryKey = 'institution_id';
    
}
