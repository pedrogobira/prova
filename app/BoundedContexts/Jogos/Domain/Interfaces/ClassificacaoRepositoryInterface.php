<?php

namespace App\BoundedContexts\Jogos\Domain\Interfaces;

use App\BoundedContexts\Jogos\Domain\Entities\Classificacao;

interface ClassificacaoRepositoryInterface
{
    public function getAll(): array;
    public function getById(int $id): Classificacao|null;
    public function getByTimeId(int $timeId) : Classificacao|null;
}
