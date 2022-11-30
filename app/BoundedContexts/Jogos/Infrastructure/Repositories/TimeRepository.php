<?php

namespace App\BoundedContexts\Jogos\Infrastructure\Repositories;

use App\BoundedContexts\Jogos\Domain\Entities\Time;
use App\BoundedContexts\Jogos\Domain\Interfaces\TimeRepositoryInterface;
use App\BoundedContexts\Jogos\Infrastructure\Models\TimeModel;

class TimeRepository implements TimeRepositoryInterface
{
    public function __construct(private TimeModel $model)
    {
    }

    public function getById(int $id): Time|null
    {
        $registro = $this->model::find($id);

        if (is_null($registro)) {
            return null;
        }

        return new Time($registro->nome, $registro->id, $registro->jogadores->toArray());
    }

    public function getByNome(string $nome): Time|null
    {
        $registro = $this->model::where('nome', '=', $nome)->first();

        if (is_null($registro)) {
            return null;
        }

        return new Time($registro->nome, $registro->id, $registro->jogadores->toArray());
    }
}
