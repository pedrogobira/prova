<?php

namespace App\BoundedContexts\Jogos\Infrastructure\Repositories;

use App\BoundedContexts\Jogos\Domain\Entities\RankingDeJogador;
use App\BoundedContexts\Jogos\Domain\Interfaces\RankingDeJogadorRepositoryInterface;
use App\BoundedContexts\Jogos\Infrastructure\Models\RankingDeJogadorModel;

class RankingDeJogadorRepository implements RankingDeJogadorRepositoryInterface
{
    public function __construct(private RankingDeJogadorModel $model)
    {
    }

    public function getAll(): array
    {
        $registros = $this->model::query()->orderByDesc('gols')->orderBy('pontuacao_dos_cartoes')->get();

        $retorno = [];
        foreach ($registros as $registro) {
            $retorno[] = new RankingDeJogador($registro->jogadores_id, $registro->gols, $registro->pontuacao_dos_cartoes, $registro->id, $registro->jogador->nome, $registro->jogador->time->nome);
        }

        return $retorno;
    }

    public function getById(int $id): RankingDeJogador|null
    {
        $registro = $this->model::find($id);

        if (is_null($registro)) {
            return null;
        }

        return new RankingDeJogador($registro->jogadores_id, $registro->gols, $registro->pontuacao_dos_cartoes, $registro->id);
    }

    public function getByJogadorId(int $id): RankingDeJogador|null
    {
        $registro = $this->model::where('jogadores_id', '=', $id)->first();

        if (is_null($registro)) {
            return null;
        }

        return new RankingDeJogador($registro->jogadores_id, $registro->gols, $registro->pontuacao_dos_cartoes, $registro->id);
    }
}
