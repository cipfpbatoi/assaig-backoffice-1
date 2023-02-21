<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alergeno extends Model
{
    use HasFactory;

    public function alergeno_reservas()
    {
        return $this->hasMany(Alergeno_Reserva::class);
    }
}
