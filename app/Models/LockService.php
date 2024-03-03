<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LockService extends Model
{
    use HasFactory;

    public function service()
    {
        return $this->belongsTo('App\Models\Service');
    }

    public function creator()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function institution()
    {
        return $this->belongsTo('App\Models\Institution');
    }
}
