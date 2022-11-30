<?php

namespace App\BoundedContexts\Times\Domain\Actions;

use App\BoundedContexts\Shared\Exceptions\NumeroJaExisteEmTimeException;
use App\BoundedContexts\Shared\Exceptions\TimeJaExisteException;
use App\BoundedContexts\Times\Domain\Entities\Jogador;
use App\BoundedContexts\Times\Domain\Interfaces\TimeRepositoryInterface;

class UpdateJogadorAction
{
    public function __construct(private TimeRepositoryInterface $timeRepository)
    {
    }

    public function execute(Jogador $registro, string $nome, int $numero, string $nomeDoTime): array
    {
        if (!is_null($this->timeRepository->getByNome($nomeDoTime)) && $nomeDoTime != $registro->getNomeDoTime()) {
            throw new TimeJaExisteException();
        }

        $time = $this->timeRepository->getById($registro->times_id);
        $time->setNome($nomeDoTime);
        $registro->setNome($nome);

        foreach ($time->getJogadores() as $jogador) {
            if ($jogador['numero'] == $numero) {
                throw new NumeroJaExisteEmTimeException();
            }
        }

        $registro->setNumero($numero);

        return [$registro, $time];
    }
}
