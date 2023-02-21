<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FechaUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'fecha' => 'date',
            'pax' => 'integer',
            'overbooking' => 'integer',
            'pax_espera' => 'integer',
            'horario_apertura' => 'date_format:H:i',
            'horario_cierre' => 'date_format:H:i',
            'profesores_sala' => 'required|exists:profesors,id',
            'profesores_cocina' => 'required|exists:profesors,id'
        ];
    }

    public function messages()
    {
        return [
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha debe ser una fecha válida.',
            'pax.required' => 'El número de pax es obligatorio.',
            'pax.integer' => 'El número de pax debe ser un número entero.',
            'overbooking.required' => 'El número de overbooking es obligatorio.',
            'overbooking.integer' => 'El número de overbooking debe ser un número entero.',
            'pax_espera.required' => 'El número de pax en espera es obligatorio.',
            'pax_espera.integer' => 'El número de pax en espera debe ser un número entero.',
            'horario_apertura.required' => 'El horario de apertura es obligatorio.',
            'horario_apertura.date_format' => 'El horario de apertura debe tener un formato válido (HH:MM).',
            'horario_cierre.required' => 'El horario de cierre es obligatorio.',
            'horario_cierre.date_format' => 'El horario de cierre debe tener un formato válido (HH:MM).',
            'profesores_sala.required' => 'Se debe seleccionar al menos un profesor de sala',
            'profesores_sala.exists' => 'No existe el profesor seleccionado',
            'profesores_cocina.required' => 'Se debe seleccionar al menos un profesor de cocina',
            'profesores_cocina.exists' => 'No existe el profesor seleccionado',
        ];
    }
}
