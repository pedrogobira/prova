<?php

namespace App\BoundedContexts\Jogos\Application\Mappers;

use App\BoundedContexts\Jogos\Application\DataTransferObjects\RankingDeJogadorData;
use App\BoundedContexts\Jogos\Domain\Entities\RankingDeJogador;

class RankingDeJogadorMapper
{
    public function entityToDataBatch(array $entities): array
    {
        $data = [];
        foreach ($entities as $entity) {
            $data[] = $this->entityToData($entity);
        }
        return $data;
    }

    public function entityToData(RankingDeJogador $ranking): RankingDeJogadorData
    {
        return new RankingDeJogadorData($ranking->id, $ranking->getJogadoresId(), $ranking->nomeDoJogador, $ranking->getGols(), $ranking->getPontuacaoDosCartoes(), $ranking->nomeDoTimeDoJogador);
    }
}
