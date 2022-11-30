<?php

namespace App\BoundedContexts\Times\Application\Services;

use App\BoundedContexts\Shared\Exceptions\TimeNaoEncontradoException;
use App\BoundedContexts\Times\Domain\Actions\UpdateTimeAction;
use App\BoundedContexts\Times\Domain\Interfaces\TimeRepositoryInterface;

class UpdateTimeService
{
    public function __construct(private UpdateTimeAction $updateTimeAction, private TimeRepositoryInterface $timeRepository)
    {
    }

    public function execute(int $id, array $atributos)
    {
        $registro = $this->timeRepository->getById($id);
        if (is_null($registro)) {
            throw new TimeNaoEncontradoException();
        }
        $registroAtualizado = $this->updateTimeAction->execute($registro, $atributos['nome']);
        $this->timeRepository->update($registroAtualizado);
    }
}
