<?php

namespace App\BoundedContexts\Times\Domain\Actions;

use App\BoundedContexts\Shared\Exceptions\TimeJaExisteException;
use App\BoundedContexts\Times\Domain\Entities\Time;
use App\BoundedContexts\Times\Domain\Interfaces\TimeRepositoryInterface;

class CriaTimeAction
{
    public function __construct(private TimeRepositoryInterface $timeRepository, private CriaClassificacaoAction $criaClassificacaoAction)
    {
    }

    public function execute(string $nome, ?array $jogadores)
    {
        if (!is_null($this->timeRepository->getByNome($nome))) {
            throw new TimeJaExisteException();
        }

        $time = new Time($nome, null, $jogadores);
        $time = $this->criaClassificacaoAction->execute($time);
        return $time;
    }
}
