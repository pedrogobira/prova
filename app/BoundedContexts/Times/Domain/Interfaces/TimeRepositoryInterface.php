<?php

namespace App\BoundedContexts\Times\Domain\Interfaces;

use App\BoundedContexts\Times\Domain\Entities\Time;

interface TimeRepositoryInterface
{
    public function store(Time $time);
    public function update(Time $novo);
    public function getAll();
    public function getById(int $id): Time|null;
    public function getByNome(string $nome) : Time|null;
}
