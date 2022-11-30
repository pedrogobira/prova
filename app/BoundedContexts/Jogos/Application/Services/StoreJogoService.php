<?php

namespace App\BoundedContexts\Jogos\Application\Services;

use App\BoundedContexts\Jogos\Domain\Actions\CriaJogoAction;
use App\BoundedContexts\Jogos\Domain\Interfaces\JogoRepositoryInterface;

class StoreJogoService
{
    public function __construct(private CriaJogoAction $criaJogoAction, private JogoRepositoryInterface $jogoRepository)
    {
    }

    public function execute(array $atributos)
    {
        $jogo = $this->criaJogoAction->execute($atributos['data'], $atributos['horaDeInicio'], $atributos['horaDeTermino'], $atributos['primeiroTimeId'], $atributos['segundoTimeId'], $atributos['jogadores']);
        $this->jogoRepository->store($jogo);
    }
}
