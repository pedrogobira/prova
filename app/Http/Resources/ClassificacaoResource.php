<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassificacaoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'timesId' => $this->timesId,
            'nomeDoTime' => $this->nomeDoTime,
            'pontos' => $this->pontos,
            'pontuacaoDosCartoes' => $this->pontuacaoDosCartoes,
            'quantidadeDeGols' => $this->quantidadeDeGols
        ];
    }
}
