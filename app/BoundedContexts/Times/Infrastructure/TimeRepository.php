<?php

namespace App\BoundedContexts\Times\Infrastructure;

use App\BoundedContexts\Times\Domain\Entities\Time;
use App\BoundedContexts\Times\Domain\Interfaces\TimeRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TimeRepository implements TimeRepositoryInterface
{
    public function __construct(private TimeModel $model)
    {
    }

    public function store(Time $time)
    {
        DB::transaction(function () use ($time) {
            $id = DB::table($this->model->table)->insertGetId([
                'nome' => $time->getNome()
            ]);

            DB::table('classificacoes')->insert([
                'times_id' => $id,
                'pontos' => 0,
                'pontuacao_dos_cartoes' => 0
            ]);
        });
    }

    public function update(Time $novo)
    {
        $registro = $this->model::find($novo->id);

        if (!is_null($registro)) {
            $registro->nome = $novo->getNome();
            $registro->save();
        }
    }

    public function getAll()
    {
        $registros = $this->model::all();
        $retorno = [];

        foreach ($registros as $registro) {
            $retorno[] = new Time(nome: $registro->nome, jogadores: $registro->jogadores->toArray(), id: $registro->id);
        }
        return $retorno;
    }

    public function getById(int $id): Time|null
    {
        $registro = $this->model::find($id);

        if (is_null($registro)) {
            return null;
        }

        return new Time(nome: $registro->nome, jogadores: $registro->jogadores->toArray(), id: $registro->id);
    }

    public function getByNome(string $nome): Time|null
    {
        $registro = $this->model::where('nome', '=', $nome)->first();

        if (is_null($registro)) {
            return null;
        }

        return new Time(nome: $registro->nome, jogadores: $registro->jogadores->toArray(), id: $registro->id);
    }
}
