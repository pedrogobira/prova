<?php

namespace App\BoundedContexts\Times\Domain\Interfaces;

use App\BoundedContexts\Times\Domain\Entities\Jogador;

interface JogadorRepositoryInterface
{
    public function store(Jogador $jogador);
    public function update(Jogador $jogador);
    public function getAll();
    public function getById(int $id): Jogador|null;
    public function getByCpf(string $nome) : Jogador|null;
}
