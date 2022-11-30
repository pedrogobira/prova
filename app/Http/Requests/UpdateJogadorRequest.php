<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJogadorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nome' => 'required',
            'numero' => 'required|numeric',
            'nomeDoTime' => 'required'
        ];
    }
}
