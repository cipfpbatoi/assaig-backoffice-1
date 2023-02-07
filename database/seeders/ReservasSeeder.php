<?php

namespace Database\Seeders;

use App\Models\Alergeno;
use App\Models\Fecha;
use App\Models\Profesor;
use App\Models\Reserva;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Alergeno::factory()->count(2)->create();
       Profesor::factory()->count(2)->create();
       User::factory()->count(2)->create();
       Reserva::factory()->count(2)->create();
       Fecha::factory()->count(2)->create();
    }
}
