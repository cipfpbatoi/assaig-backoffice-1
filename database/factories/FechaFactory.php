<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fecha>
 */
class FechaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        static $date;
        $openTime = new DateTime();
        $openTime->setTime(14, 0);
        $closeTime = new DateTime();
        $closeTime->setTime(16, 0);

        if (! $date) {
            $date = Carbon::now();
            while ($date->dayOfWeek !== Carbon::FRIDAY) {
                $date->addDay();
            }
        } else {
            $date->addWeek();
        }

        return [
            'fecha' => $date,
            'pax' => 15,
            'overbooking' => 5,
            'pax_espera' => 0,
            'horario_apertura' => $openTime,
            'horario_cierre' => $closeTime,
            'user_id' => User::inRandomOrder()->first()->id,

        ];
    }
}
