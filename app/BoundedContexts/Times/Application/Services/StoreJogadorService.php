<?php

namespace App\BoundedContexts\Times\Application\Services;

use App\BoundedContexts\Times\Domain\Actions\CriaJogadorAction;
use App\BoundedContexts\Times\Domain\Interfaces\JogadorRepositoryInterface;

class StoreJogadorService
{
    public function __construct(private CriaJogadorAction $criaJogadorAction, private JogadorRepositoryInterface $jogadorRepository)
    {
    }

    public function execute(array $atributos)
    {
        $jogador = $this->criaJogadorAction->execute($atributos['cpf'], $atributos['nome'], $atributos['numero'], $atributos['nomeDoTime']);
        $this->jogadorRepository->store($jogador);
    }
}
