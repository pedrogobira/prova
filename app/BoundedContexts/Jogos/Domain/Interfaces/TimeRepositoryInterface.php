<?php

namespace App\BoundedContexts\Jogos\Domain\Interfaces;

use App\BoundedContexts\Jogos\Domain\Entities\Time;

interface TimeRepositoryInterface
{
    public function getById(int $id): Time|null;
    public function getByNome(string $nome) : Time|null;
}
