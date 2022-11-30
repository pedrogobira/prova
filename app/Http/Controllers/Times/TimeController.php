<?php

namespace App\Http\Controllers\Times;

use App\BoundedContexts\Times\Application\Services\GetTimeService;
use App\BoundedContexts\Times\Application\Services\StoreTimeService;
use App\BoundedContexts\Times\Application\Services\UpdateTimeService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTimeRequest;
use App\Http\Resources\TimeResource;

class TimeController extends Controller
{
    public function __construct(private StoreTimeService $storeTimeService, private UpdateTimeService $updateTimeService, private GetTimeService $getTimeService)
    {
    }

    public function store(StoreTimeRequest $request)
    {
        $this->storeTimeService->execute($request->validated());
        return response()->json([], 201);
    }

    public function update(int $id, StoreTimeRequest $request)
    {
        $this->updateTimeService->execute($id, $request->validated());
        return response()->json([], 204);
    }

    public function getAll() {
        return TimeResource::collection($this->getTimeService->getAll());
    }
}
