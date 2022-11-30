<?php

namespace App\Http\Controllers\Jogos;

use App\BoundedContexts\Jogos\Application\Services\GetClassificacaoService;
use App\BoundedContexts\Jogos\Application\Services\GetJogosService;
use App\BoundedContexts\Jogos\Application\Services\GetRankingDeJogadorService;
use App\BoundedContexts\Jogos\Application\Services\StoreJogoService;
use App\BoundedContexts\Jogos\Application\Services\UpdateJogoService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJogoRequest;
use App\Http\Resources\ClassificacaoResource;
use App\Http\Resources\JogoResource;
use App\Http\Resources\RankingDeJogadorResource;
use Illuminate\Http\Request;

class JogoController extends Controller
{
    public function __construct(private StoreJogoService $storeJogoService, private UpdateJogoService $updateJogoService, private GetJogosService $getJogosService, private GetClassificacaoService $getClassificacaoService, private GetRankingDeJogadorService $getRankingDeJogadorService)
    {
    }

    public function store(StoreJogoRequest $request)
    {
        $this->storeJogoService->execute($request->validated());
        return response()->json([], 201);
    }

    public function update(int $id, StoreJogoRequest $request)
    {
        $this->updateJogoService->execute($id, $request->validated());
        return response()->json([], 204);
    }

    public function getClassificacao(Request $request)
    {
        return ClassificacaoResource::collection($this->getClassificacaoService->getAll());
    }

    public function getJogos(Request $request)
    {
        return JogoResource::collection($this->getJogosService->getAll());
    }

    public function getRankingDeJogador(Request $request)
    {
        return RankingDeJogadorResource::collection($this->getRankingDeJogadorService->getAll());
    }
}
