<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profession;
use App\Models\Entity;

class Registration extends Model
{
    use HasFactory;

    public function users()
    {
        $this->belongsTo('App\Model\User');
    }

    public function profession()
    {
       return Profession::find($this->profession_id)->name;
    }

    public function entity()
    {
       return Entity::find($this->entity_id)->name;
    }
}
