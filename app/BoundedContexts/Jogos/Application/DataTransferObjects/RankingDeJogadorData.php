<?php

namespace App\BoundedContexts\Jogos\Application\DataTransferObjects;

class RankingDeJogadorData
{
    public function __construct(public readonly int $id, public readonly int $jogadoresId, public readonly string $nomeDoJogador, public readonly int $gols, public readonly int $pontuacaoDosCartoes, public readonly string $nomeDoTimeDoJogador)
    {
    }
}
