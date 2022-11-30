<?php

namespace App\BoundedContexts\Jogos\Domain\Actions;

use App\BoundedContexts\Jogos\Domain\Entities\Jogo;
use App\BoundedContexts\Jogos\Domain\Interfaces\ClassificacaoRepositoryInterface;

class AtualizaClassificacaoAction
{
    public function __construct(private ClassificacaoRepositoryInterface $classificacaoRepository)
    {
    }

    public function execute(Jogo $jogo): Jogo
    {
        $primeiro = $this->classificacaoRepository->getByTimeId($jogo->getPlacar()->getPrimeiroTimeId());
        $segundo = $this->classificacaoRepository->getByTimeId($jogo->getPlacar()->getSegundoTimeId());
        $vencedorId = $jogo->getPlacar()->getVencedorId();

        if ($primeiro->getTimesId() == $vencedorId) {
            $primeiro->setPontos($primeiro->getPontos() + 3);
        } elseif ($segundo->getTimesId() == $vencedorId) {
            $segundo->setPontos($segundo->getPontos() + 3);
        } else {
            $primeiro->setPontos($primeiro->getPontos() + 1);
            $segundo->setPontos($segundo->getPontos() + 1);
        }

        $primeiroCartoes = 0;
        $segundoCartoes = 0;
        foreach ($jogo->getJogadores() as $jogador) {
            if ($jogador->times_id == $primeiro->getTimesId()) {
                $cartao = mb_strtoupper($jogador->getCartoes()[0]->getCor());
                if ($cartao == "A") {
                    $primeiroCartoes += 1;
                } elseif ($cartao == "V") {
                    $primeiroCartoes += 2;
                }
            } else {
                $cartao = $jogador->getCartoes()[0]->getCor();
                if ($cartao == "A") {
                    $segundoCartoes += 1;
                } elseif ($cartao == "V") {
                    $segundoCartoes += 2;
                }
            }
        }

        $primeiro->setPontuacaoDosCartoes($primeiro->getPontuacaoDosCartoes() + $primeiroCartoes);
        $segundo->setPontuacaoDosCartoes($segundo->getPontuacaoDosCartoes() + $segundoCartoes);
        $jogo->setClassificacaoDosTimesParticipantes([$primeiro, $segundo]);

        return $jogo;
    }
}


