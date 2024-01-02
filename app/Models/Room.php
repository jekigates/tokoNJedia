<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory, HasUuids;

    public function roomables()
    {
        return $this->hasMany(Roomable::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
