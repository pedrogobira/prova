<?php

namespace App\BoundedContexts\Jogos\Infrastructure\Repositories;

use App\BoundedContexts\Jogos\Domain\Entities\Jogador;
use App\BoundedContexts\Jogos\Domain\Interfaces\JogadorRepositoryInterface;
use App\BoundedContexts\Jogos\Infrastructure\Models\JogadorModel;

class JogadorRepository implements JogadorRepositoryInterface
{
    public function __construct(private JogadorModel $model)
    {
    }

    public function getById(int $id): Jogador|null
    {
        $registro = $this->model::find($id);

        if (is_null($registro)) {
            return null;
        }

        return new Jogador($registro->cpf, $registro->id, $registro->times_id);
    }

    public function getByCpf(string $cpf): Jogador|null
    {
        $registro = $this->model::where('cpf', '=', $cpf)->first();

        if (is_null($registro)) {
            return null;
        }

        return new Jogador($registro->cpf, $registro->id, $registro->times_id);
    }
}
