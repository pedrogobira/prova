<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JogoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'data' => $this->data,
            'horaDeInicio' => $this->horaDeInicio,
            'horaDeTermino' => $this->horaDeTermino,
            'primeiroTimeId' => $this->primeiroTimeId,
            'segundoTimeId' => $this->segundoTimeId,
            'placar' => [
                'golsPrimeiroTime' => $this->placar['golsPrimeiroTime'],
                'golsSegundoTime' => $this->placar['golsSegundoTime'],
                'vencedorId' => $this->placar['vencedorId']
            ]
        ];
    }
}
