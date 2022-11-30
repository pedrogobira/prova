<?php

namespace App\BoundedContexts\Jogos\Domain\Interfaces;

use App\BoundedContexts\Jogos\Domain\Entities\Jogo;

interface JogoRepositoryInterface
{
    public function store(Jogo $time);
    public function update(Jogo $jogo);
    public function delete(Jogo $registro);
    public function getAll(): array;
    public function getById(int $id): Jogo|null;
}
