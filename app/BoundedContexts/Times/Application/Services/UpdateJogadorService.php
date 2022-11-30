<?php

namespace App\BoundedContexts\Times\Application\Services;

use App\BoundedContexts\Shared\Exceptions\JogadorNaoEncontradoException;
use App\BoundedContexts\Times\Domain\Actions\UpdateJogadorAction;
use App\BoundedContexts\Times\Domain\Interfaces\JogadorRepositoryInterface;
use App\BoundedContexts\Times\Domain\Interfaces\TimeRepositoryInterface;

class UpdateJogadorService
{
    public function __construct(private UpdateJogadorAction $updateJogadorAction, private JogadorRepositoryInterface $jogadorRepository, private TimeRepositoryInterface $timeRepository)
    {
    }

    public function execute(int $id, array $atributos)
    {
        $registro = $this->jogadorRepository->getById($id);
        if (is_null($registro)) {
            throw new JogadorNaoEncontradoException();
        }
        [$jogadorAtualizado, $timeAtualizado] = $this->updateJogadorAction->execute($registro, $atributos['nome'], $atributos['numero'], $atributos['nomeDoTime']);
        $this->timeRepository->update($timeAtualizado);
        $this->jogadorRepository->update($jogadorAtualizado);
    }
}
