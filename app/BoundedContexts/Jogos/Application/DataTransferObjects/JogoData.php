<?php

namespace App\BoundedContexts\Jogos\Application\DataTransferObjects;

class JogoData
{
    public function __construct(public readonly int $id, public readonly string $data, public readonly string $horaDeInicio, public readonly string $horaDeTermino, public readonly int $primeiroTimeId, public readonly int $segundoTimeId, public readonly array $placar)
    {
    }
}
