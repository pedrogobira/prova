<?php

namespace App\BoundedContexts\Jogos\Infrastructure\Repositories;

use App\BoundedContexts\Jogos\Domain\Entities\Classificacao;
use App\BoundedContexts\Jogos\Domain\Interfaces\ClassificacaoRepositoryInterface;
use App\BoundedContexts\Jogos\Infrastructure\Models\ClassificacaoModel;

class ClassificacaoRepository implements ClassificacaoRepositoryInterface
{
    public function __construct(private ClassificacaoModel $model)
    {
    }

    public function getAll(): array
    {
        $registros = $this->model::query()->orderByDesc('pontos')->orderBy('pontuacao_dos_cartoes')->get();

        $retorno = [];
        foreach ($registros as $registro) {
            $gols = array_reduce($registro->time->gols->toArray(), function ($acumulador, $item) {
                $acumulador += $item['quantidade'];
                return $acumulador;
            });
            $retorno[] = new Classificacao(times_id: $registro->times_id, pontos: $registro->pontos, pontuacaoDosCartoes: $registro->pontuacao_dos_cartoes, id: $registro->id, nomeDoTime: $registro->time->nome, quantidadeDeGols: $gols);
        }

        return $retorno;
    }

    public function getById(int $id): Classificacao|null
    {
        $registro = $this->model::find($id);

        if (is_null($registro)) {
            return null;
        }

        return new Classificacao($registro->times_id, $registro->pontos, $registro->pontuacao_dos_cartoes, $registro->id);
    }

    public function getByTimeId(int $timeId): Classificacao|null
    {
        $registro = $this->model::where('times_id', '=', $timeId)->first();

        if (is_null($registro)) {
            return null;
        }

        return new Classificacao($registro->times_id, $registro->pontos, $registro->pontuacao_dos_cartoes, $registro->id);
    }

}
