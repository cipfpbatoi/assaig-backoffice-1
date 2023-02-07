<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;

    public function profesor_fecha_cocinas()
    {
        return $this->hasMany(Profesor_fecha_cocina::class);
    }
    public function profesor_fecha_salas()
    {
        return $this->hasMany(Profesor_fecha_sala::class);
    }
}
