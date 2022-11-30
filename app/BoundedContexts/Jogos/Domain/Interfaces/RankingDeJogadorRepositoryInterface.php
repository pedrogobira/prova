<?php

namespace App\BoundedContexts\Jogos\Domain\Interfaces;

use App\BoundedContexts\Jogos\Domain\Entities\RankingDeJogador;

interface RankingDeJogadorRepositoryInterface
{
    public function getById(int $id): RankingDeJogador|null;
    public function getByJogadorId(int $id) : RankingDeJogador|null;
}
