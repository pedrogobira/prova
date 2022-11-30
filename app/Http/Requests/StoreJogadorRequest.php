<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJogadorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'cpf' => 'required|min:11|max:11',
            'nome' => 'required',
            'numero' => 'required|numeric',
            'nomeDoTime' => 'required'
        ];
    }
}
