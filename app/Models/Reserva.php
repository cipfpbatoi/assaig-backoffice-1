<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    public function fecha()
    {
        return $this->belongsTo(Fecha::class, 'fecha_id');
    }

    public function alergeno_reservas()
    {
        return $this->hasMany(Alergeno_Reserva::class);
    }
}
