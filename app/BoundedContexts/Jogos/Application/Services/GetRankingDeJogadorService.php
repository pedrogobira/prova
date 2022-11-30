<?php

namespace App\BoundedContexts\Jogos\Application\Services;

use App\BoundedContexts\Jogos\Application\Mappers\RankingDeJogadorMapper;
use App\BoundedContexts\Jogos\Domain\Interfaces\RankingDeJogadorRepositoryInterface;

class GetRankingDeJogadorService
{
    public function __construct(private RankingDeJogadorRepositoryInterface $rankingDeJogadorRepository, private RankingDeJogadorMapper $mapper)
    {
    }

    public function getAll()
    {
        $rankings = $this->rankingDeJogadorRepository->getAll();
        return $this->mapper->entityToDataBatch($rankings);
    }
}
