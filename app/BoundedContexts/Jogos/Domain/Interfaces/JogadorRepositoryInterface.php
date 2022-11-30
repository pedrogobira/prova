<?php

namespace App\BoundedContexts\Jogos\Domain\Interfaces;

use App\BoundedContexts\Jogos\Domain\Entities\Jogador;

interface JogadorRepositoryInterface
{
    public function getById(int $id): Jogador|null;
    public function getByCpf(string $nome) : Jogador|null;
}
