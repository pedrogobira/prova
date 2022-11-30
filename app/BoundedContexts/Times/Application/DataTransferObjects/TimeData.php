<?php

namespace App\BoundedContexts\Times\Application\DataTransferObjects;

class TimeData
{
    public function __construct(public readonly int $id, public readonly string $nome, public readonly array $jogadores)
    {
    }
}
