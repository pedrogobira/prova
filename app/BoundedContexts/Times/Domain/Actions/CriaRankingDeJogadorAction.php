<?php

namespace App\BoundedContexts\Times\Domain\Actions;

use App\BoundedContexts\Times\Domain\Entities\Jogador;
use App\BoundedContexts\Times\Domain\Entities\RankingDeJogador;

class CriaRankingDeJogadorAction
{
    public function execute(Jogador $jogador): Jogador
    {
        $jogador->setRankingDeJogador(new RankingDeJogador(0, 0));
        return $jogador;
    }
}
