<?php

namespace App\BoundedContexts\Times\Application\Services;

use App\BoundedContexts\Times\Domain\Actions\CriaTimeAction;
use App\BoundedContexts\Times\Domain\Interfaces\TimeRepositoryInterface;

class StoreTimeService
{
    public function __construct(private CriaTimeAction $criaTimeAction, private TimeRepositoryInterface $timeRepository)
    {
    }

    public function execute(array $atributos)
    {
        $time = $this->criaTimeAction->execute($atributos['nome'], null);
        $this->timeRepository->store($time);
    }
}
