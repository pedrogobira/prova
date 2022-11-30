<?php

namespace App\BoundedContexts\Times\Infrastructure;

use App\BoundedContexts\Times\Domain\Entities\Jogador;
use App\BoundedContexts\Times\Domain\Interfaces\JogadorRepositoryInterface;
use Illuminate\Support\Facades\DB;

class JogadorRepository implements JogadorRepositoryInterface
{
    public function __construct(private JogadorModel $model)
    {
    }

    public function store(Jogador $jogador)
    {
        DB::transaction(function () use ($jogador) {
            $id = DB::table($this->model->table)->insertGetId([
                'cpf' => $jogador->cpf,
                'nome' => $jogador->getNome(),
                'numero' => $jogador->getNumero(),
                'times_id' => $jogador->times_id
            ]);

            DB::table('ranking_de_jogadores')->insert([
                'jogadores_id' => $id,
                'gols' => 0,
                'pontuacao_dos_cartoes' => 0
            ]);
        });
    }

    public function update(Jogador $novo)
    {
        $registro = $this->model::find($novo->id);

        if (!is_null($registro)) {
            $registro->nome = $novo->getNome();
            $registro->numero = $novo->getNumero();
            $registro->save();
        }
    }

    public function getAll()
    {
        $registros = $this->model::all();
        $retorno = [];

        foreach ($registros as $registro) {
            $retorno[] = new Jogador(cpf: $registro->cpf, nome: $registro->nome, numero: $registro->numero, nomeDoTime: $registro->time->nome, times_id: $registro->times_id, id: $registro->id);
        }
        return $retorno;
    }

    public function getById(int $id): Jogador|null
    {
        $registro = $this->model::find($id);

        if (is_null($registro)) {
            return null;
        }

        return new Jogador(cpf: $registro->cpf, nome: $registro->nome, numero: $registro->numero, nomeDoTime: $registro->time->nome, times_id: $registro->times_id, id: $registro->id);
    }

    public function getByCpf(string $cpf): Jogador|null
    {
        $registro = $this->model::where('cpf', '=', $cpf)->first();

        if (is_null($registro)) {
            return null;
        }

        return new Jogador(cpf: $registro->cpf, nome: $registro->nome, numero: $registro->numero, nomeDoTime: $registro->time->nome, times_id: $registro->times_id, id: $registro->id);
    }
}
