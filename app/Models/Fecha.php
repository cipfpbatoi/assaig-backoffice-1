<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fecha extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function profesor_fecha_cocinas()
    {
        return $this->hasMany(Profesor_fecha_cocina::class);
    }

    public function profesor_fecha_salas()
    {
        return $this->hasMany(Profesor_fecha_sala::class);
    }

    public function fechas()
    {
        return $this->hasMany(Fecha::class);
    }

    public function profesor_fecha_cocinas2()
    {
        return $this->belongsToMany(Profesor::class,'profesor_fecha_cocinas');
    }

    public function profesor_fecha_sala2()
    {
        return $this->belongsToMany(Profesor::class,'profesor_fecha_salas');
    }
}
