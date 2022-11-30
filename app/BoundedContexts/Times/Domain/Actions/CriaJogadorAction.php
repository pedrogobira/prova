<?php

namespace App\BoundedContexts\Times\Domain\Actions;

use App\BoundedContexts\Shared\Exceptions\InformacaoErradaException;
use App\BoundedContexts\Shared\Exceptions\JogadorJaExisteException;
use App\BoundedContexts\Shared\Exceptions\NumeroJaExisteEmTimeException;
use App\BoundedContexts\Shared\Exceptions\TimeCheioException;
use App\BoundedContexts\Times\Domain\Entities\Jogador;
use App\BoundedContexts\Shared\Exceptions\TimeNaoEncontradoException;
use App\BoundedContexts\Times\Domain\Interfaces\JogadorRepositoryInterface;
use App\BoundedContexts\Times\Domain\Interfaces\TimeRepositoryInterface;

class CriaJogadorAction
{
    public function __construct(private TimeRepositoryInterface $timeRepository, private JogadorRepositoryInterface $jogadorRepository)
    {
    }

    public function execute(string $cpf, string $nome, int $numero, string $nomeDoTime): Jogador
    {
        if (!is_null($this->jogadorRepository->getByCpf($cpf))) {
            throw new JogadorJaExisteException();
        }

        $time = $this->timeRepository->getByNome($nomeDoTime);

        if (is_null($time)) {
            throw new TimeNaoEncontradoException();
        }

        if(count($time->getJogadores()) >= 5) {
            throw new TimeCheioException();
        }

        foreach($time->getJogadores() as $jogador) {
            if($jogador['numero'] == $numero) {
                throw new NumeroJaExisteEmTimeException();
            }
        }

        return new Jogador($cpf, $nome, $numero, $nomeDoTime, null, $time->id);
    }
}
