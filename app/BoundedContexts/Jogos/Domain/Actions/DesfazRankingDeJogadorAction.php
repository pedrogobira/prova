<?php

namespace App\BoundedContexts\Jogos\Domain\Actions;

use App\BoundedContexts\Jogos\Domain\Entities\Jogador;
use App\BoundedContexts\Jogos\Domain\Entities\Jogo;
use App\BoundedContexts\Jogos\Domain\Interfaces\JogadorRepositoryInterface;
use App\BoundedContexts\Jogos\Domain\Interfaces\TimeRepositoryInterface;

class DesfazRankingDeJogadorAction
{
    public function execute(array $jogadores, array $rankingDeJogadores): array
    {
        $jogadoresComGols = array_filter($jogadores, fn(Jogador $jogador) => !is_null($jogador->getGols()));
        $jogadoresComCartoes = array_filter($jogadores, fn(Jogador $jogador) => !is_null($jogador->getCartoes()));

        foreach ($jogadoresComGols as $jogador) {
            foreach ($rankingDeJogadores as $ranking) {
                if ($ranking->getJogadoresId() == $jogador->id) {
                    $ranking->setGols($ranking->getGols() - $jogador->getGols()[0]->getQuantidade());
                }
            }
        }

        foreach ($jogadoresComCartoes as $jogador) {
            foreach ($rankingDeJogadores as $ranking) {
                if ($ranking->getJogadoresId() == $jogador->id) {
                    $ranking->setPontuacaoDosCartoes($ranking->getPontuacaoDosCartoes() - ($jogador->getCartoes()[0]->getCor() == 'V' ? 2 : 1));
                }
            }
        }

        return $rankingDeJogadores;
    }
}
