<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservaRequest extends FormRequest
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
            'nombre.required' => 'El campo nombre es obligatorio',
            'nombre.min' => 'el nombre debe tener al menos 5 carácteres',
            'email.required' => 'El email es obligastorio',
            'email.email' => 'El formato del email es incorrecto',
            'telefono.required' => 'El campo teléfono es obligatorio',
            'telefono.numeric|digits:10' => 'El formato de teléfono es inválido',
            'comensales.required' => 'El campo comensales es obligatorio',
            'comensales.min' => 'Se debe introducir al menos un comensal',
            'localizador.required' => 'El campo localizador es obligatorio',
            'fecha.required' => 'El campo fecha es obligatorio',
        ];
    }
}
