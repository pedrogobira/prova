<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJogoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'data' => 'required|date|before:tomorrow',
            'horaDeInicio' => 'required|date_format:H:i',
            'horaDeTermino' => 'required|date_format:H:i|after:horaDeInicio',
            'primeiroTimeId' => 'required|numeric',
            'segundoTimeId' => 'required|numeric',
            'jogadores' => 'required|array',
            'jogadores.*' => 'required|array',
            'jogadores.*.cpf' => 'required|distinct|min:11|max:11',
            'jogadores.*.cartao' => 'nullable|min:1|max:1',
            'jogadores.*.gols' => 'required|numeric|min:0',
        ];
    }
}
