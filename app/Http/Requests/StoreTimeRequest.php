<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTimeRequest extends FormRequest
{
    public function getNome(): string
    {
        return $this->nome;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required',
        ];
    }
}
