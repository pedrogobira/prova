<?php

namespace App\BoundedContexts\Jogos\Application\Services;

use App\BoundedContexts\Jogos\Domain\Actions\CriaJogoAction;
use App\BoundedContexts\Jogos\Domain\Actions\DesfazPontuacoesPorJogoAction;
use App\BoundedContexts\Jogos\Domain\Interfaces\JogoRepositoryInterface;
use App\BoundedContexts\Shared\Exceptions\JogoNaoEncontradoException;

class UpdateJogoService
{
    public function __construct(private CriaJogoAction $criaJogoAction, private DesfazPontuacoesPorJogoAction $desfazPontuacoesPorJogoAction, private JogoRepositoryInterface $jogoRepository)
    {
    }

    public function execute(int $id, array $atributos)
    {
        $registro = $this->jogoRepository->getById($id);

        if (is_null($registro)) {
            throw new JogoNaoEncontradoException();
        }

        $registro = $this->desfazPontuacoesPorJogoAction->execute($registro);
        $this->jogoRepository->delete($registro);
        $jogo = $this->criaJogoAction->execute($atributos['data'], $atributos['horaDeInicio'], $atributos['horaDeTermino'], $atributos['primeiroTimeId'], $atributos['segundoTimeId'], $atributos['jogadores']);
        $this->jogoRepository->update($jogo);
    }
}
