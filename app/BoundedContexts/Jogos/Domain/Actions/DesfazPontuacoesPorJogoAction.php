<?php

namespace App\BoundedContexts\Jogos\Domain\Actions;

use App\BoundedContexts\Jogos\Domain\Entities\Jogador;
use App\BoundedContexts\Jogos\Domain\Entities\Jogo;

class DesfazPontuacoesPorJogoAction
{
    public function __construct()
    {
    }

    public function execute(Jogo $jogo): Jogo
    {
        $jogadores = $jogo->getJogadores();
        $jogadoresComGols = array_filter($jogadores, fn(Jogador $jogador) => !is_null($jogador->getGols()));
        $jogadoresComCartoes = array_filter($jogadores, fn(Jogador $jogador) => !is_null($jogador->getCartoes()));
        $rankingDeJogadores = $jogo->getRankingDosJogadoresParticipantes();
        $classificacoes = $jogo->getClassificacaoDosTimesParticipantes();

        foreach ($jogadoresComGols as $jogador) {
            foreach ($rankingDeJogadores as $ranking) {
                if ($ranking->getJogadoresId() == $jogador->id) {
                    $ranking->setGols($ranking->getGols() - $jogador->getGols()[0]->getQuantidade());
                }
            }
        }

        foreach ($jogadoresComCartoes as $jogador) {
            $pontosParaDeduzir = $jogador->getCartoes()[0]->getCor() == 'V' ? 2 : 1;

            foreach ($rankingDeJogadores as $ranking) {
                if ($ranking->getJogadoresId() == $jogador->id) {
                    $ranking->setPontuacaoDosCartoes($ranking->getPontuacaoDosCartoes() - $pontosParaDeduzir);
                }
            }

            foreach ($classificacoes as $classificacao) {
                if ($classificacao->getTimesId() == $jogador->times_id) {
                    $classificacao->setPontuacaoDosCartoes($classificacao->getPontuacaoDosCartoes() - $pontosParaDeduzir);
                }
            }
        }

        $placar = $jogo->getPlacar();
        if (is_null($placar->getVencedorId())) {
            foreach ($classificacoes as $classificacao) {
                $classificacao->setPontos($classificacao->getPontos() - 1);
            }
        } else {
            foreach ($classificacoes as $classificacao) {
                if ($classificacao->getTimesId() == $placar->getVencedorId()) {
                    $classificacao->setPontos($classificacao->getPontos() - 3);
                }
            }
        }

        return $jogo;
    }
}
