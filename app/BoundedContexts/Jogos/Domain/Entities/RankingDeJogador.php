<?php

namespace App\BoundedContexts\Jogos\Domain\Entities;

class RankingDeJogador
{
    public function __construct(private int $jogadoresId, private int $gols, private int $pontuacaoDosCartoes, public readonly ?int $id = null, public readonly ?string $nomeDoJogador = null, public readonly ?string $nomeDoTimeDoJogador = null)
    {
    }

    /**
     * @return int
     */
    public function getJogadoresId(): int
    {
        return $this->jogadoresId;
    }

    /**
     * @param int $jogadoresId
     */
    public function setJogadoresId(int $jogadoresId): void
    {
        $this->jogadoresId = $jogadoresId;
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
