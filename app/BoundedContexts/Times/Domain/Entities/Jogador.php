<?php

namespace App\BoundedContexts\Times\Domain\Entities;

class Jogador
{
    public function __construct(public readonly string $cpf, private string $nome, private int $numero, private string $nomeDoTime, private ?RankingDeJogador $rankingDeJogador = null, public readonly ?int $times_id = null, public readonly ?int $id = null)
    {
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    /**
     * @return int
     */
    public function getNumero(): int
    {
        return $this->numero;
    }

    /**
     * @param int $numero
     */
    public function setNumero(int $numero): void
    {
        $this->numero = $numero;
    }

    /**
     * @return string
     */
    public function getNomeDoTime(): string
    {
        return $this->nomeDoTime;
    }

    /**
     * @param string $nomeDoTime
     */
    public function setNomeDoTime(string $nomeDoTime): void
    {
        $this->nomeDoTime = $nomeDoTime;
    }

    /**
     * @return RankingDeJogador|null
     */
    public function getRankingDeJogador(): ?RankingDeJogador
    {
        return $this->rankingDeJogador;
    }

    /**
     * @param RankingDeJogador|null $rankingDeJogador
     */
    public function setRankingDeJogador(?RankingDeJogador $rankingDeJogador): void
    {
        $this->rankingDeJogador = $rankingDeJogador;
    }
}
