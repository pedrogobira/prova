<?php

namespace App\BoundedContexts\Jogos\Application\DataTransferObjects;

class ClassificacaoData
{
    public function __construct(public readonly int $id, public readonly int $timesId, public readonly string $nomeDoTime, public readonly int $pontos, public readonly int $pontuacaoDosCartoes, public readonly ?int $quantidadeDeGols)
    {
    }
}
