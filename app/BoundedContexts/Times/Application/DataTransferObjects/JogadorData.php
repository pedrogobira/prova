<?php

namespace App\BoundedContexts\Times\Application\DataTransferObjects;

class JogadorData
{
    public function __construct(public readonly int $id, public readonly string $cpf, public readonly string $nome, public readonly int $numero, public readonly string $nomeDoTime)
    {
    }
}
