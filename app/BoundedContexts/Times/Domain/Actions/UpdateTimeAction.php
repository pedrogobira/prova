<?php

namespace App\BoundedContexts\Times\Domain\Actions;

use App\BoundedContexts\Shared\Exceptions\TimeJaExisteException;
use App\BoundedContexts\Times\Domain\Entities\Time;
use App\BoundedContexts\Times\Domain\Interfaces\TimeRepositoryInterface;

class UpdateTimeAction
{
    public function __construct(private TimeRepositoryInterface $timeRepository)
    {
    }

    public function execute(Time $registro, string $nome)
    {
        if (!is_null($this->timeRepository->getByNome($nome))) {
            throw new TimeJaExisteException();
        }

        $registro->setNome($nome);
        return $registro;
    }
}
