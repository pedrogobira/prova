<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RankingDeJogadorResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'jogadoresId' => $this->jogadoresId,
            'nomeDoJogador' => $this->nomeDoJogador,
            'gols' => $this->gols,
            'pontuacaoDosCartoes' => $this->pontuacaoDosCartoes,
            'nomeDoTimeDoJogador' => $this->nomeDoTimeDoJogador,
        ];
    }
}
