<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JogadorResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'cpf' => $this->cpf,
            'nome' => $this->nome,
            'numero' => $this->numero,
            'nomeDoTime' => $this->nomeDoTime
        ];
    }
}
