<?php

namespace App\BoundedContexts\Times\Application\Mappers;

use App\BoundedContexts\Times\Application\DataTransferObjects\JogadorData;
use App\BoundedContexts\Times\Domain\Entities\Jogador;

class JogadorMapper
{
    public function entityToDataBatch(array $entities): array
    {
        $data = [];
        foreach ($entities as $entity) {
            $data[] = $this->entityToData($entity);
        }
        return $data;
    }

    public function entityToData(Jogador $jogador): JogadorData
    {
        return new JogadorData($jogador->id, $jogador->cpf, $jogador->getNome(), $jogador->getNumero(), $jogador->getNomeDoTime());
    }
}
