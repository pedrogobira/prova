<?php

namespace App\Http\Controllers\Times;

use App\BoundedContexts\Times\Application\Services\GetJogadorService;
use App\BoundedContexts\Times\Application\Services\StoreJogadorService;
use App\BoundedContexts\Times\Application\Services\UpdateJogadorService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJogadorRequest;
use App\Http\Requests\UpdateJogadorRequest;
use App\Http\Resources\JogadorResource;

class JogadorController extends Controller
{
    public function __construct(private StoreJogadorService $storeJogadorService, private UpdateJogadorService $updateJogadorService, private GetJogadorService $getJogadorService)
    {
    }

    public function store(StoreJogadorRequest $request)
    {
        $this->storeJogadorService->execute($request->validated());
        return response()->json([], 201);
    }

    public function update(int $id, UpdateJogadorRequest $request)
    {
        $this->updateJogadorService->execute($id, $request->validated());
        return response()->json([], 204);
    }

    public function getAll()
    {
        return JogadorResource::collection($this->getJogadorService->getAll());
    }
}
