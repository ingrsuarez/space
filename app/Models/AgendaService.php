<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaService extends Model
{
    use HasFactory;

    public function service()
    {
        return $this->belongsTo('App\Models\Service');
    }

    public function institution()
    {
        return $this->belongsTo('App\Models\Institution');
    }

    public function room()
    {
        return $this->belongsTo('App\Models\Room');
    }
}
