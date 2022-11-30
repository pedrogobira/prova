<?php

namespace App\BoundedContexts\Times\Domain\Entities;

class RankingDeJogador
{
    public function __construct(private int $gols, private int $pontuacaoDosCartoes, private ?int $jogadores_id = null, public readonly ?int $id)
    {
    }

    /**
     * @return int
     */
    public function getJogadoresId(): int
    {
        return $this->jogadores_id;
    }

    /**
     * @param int $jogadores_id
     */
    public function setJogadoresId(int $jogadores_id): void
    {
        $this->jogadores_id = $jogadores_id;
    }

    /**
     * @return int
     */
    public function getGols(): int
    {
        return $this->gols;
    }

    /**
     * @param int $gols
     */
    public function setGols(int $gols): void
    {
        $this->gols = $gols;
    }

    /**
     * @return int
     */
    public function getPontuacaoDosCartoes(): int
    {
        return $this->pontuacaoDosCartoes;
    }

    /**
     * @param int $pontuacaoDosCartoes
     */
    public function setPontuacaoDosCartoes(int $pontuacaoDosCartoes): void
    {
        $this->pontuacaoDosCartoes = $pontuacaoDosCartoes;
    }
}
