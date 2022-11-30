<?php

namespace App\BoundedContexts\Jogos\Domain\Actions;

use App\BoundedContexts\Jogos\Domain\Entities\Jogo;
use App\BoundedContexts\Jogos\Domain\Interfaces\RankingDeJogadorRepositoryInterface;

class AtualizaRankingDosJogadoresAction
{
    public function __construct(private RankingDeJogadorRepositoryInterface $rankingDeJogadorRepository)
    {
    }

    public function execute(Jogo $jogo): Jogo
    {
        $jogadores = $jogo->getJogadores();

        $ranking = [];
        foreach ($jogadores as $jogador) {
            $registro = $this->rankingDeJogadorRepository->getByJogadorId($jogador->id);
            $registro->setGols($registro->getGols() + $jogador->getGols()[0]->getQuantidade());
            $pontuacaoDosCartoes = mb_strtoupper($jogador->getCartoes()[0]->getCor());

            if ($pontuacaoDosCartoes == "V") {
                $registro->setPontuacaoDosCartoes($registro->getPontuacaoDosCartoes() + 2);
            } elseif ($pontuacaoDosCartoes == "A") {
                $registro->setPontuacaoDosCartoes($registro->getPontuacaoDosCartoes() + 1);
            }

            $ranking[] = $registro;
        }

        $jogo->setRankingDosJogadoresParticipantes($ranking);
        return $jogo;
    }
}


