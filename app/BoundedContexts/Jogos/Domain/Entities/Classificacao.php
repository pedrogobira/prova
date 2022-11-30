<?php

namespace App\BoundedContexts\Jogos\Domain\Entities;

class Classificacao
{
    public function __construct(private int $times_id, private int $pontos, private int $pontuacaoDosCartoes, public readonly ?int $id = null, public readonly ?string $nomeDoTime = null, public readonly ?int $quantidadeDeGols = null)
    {
    }

    /**
     * @return int
     */
    public function getTimesId(): int
    {
        return $this->times_id;
    }

    /**
     * @param int $times_id
     */
    public function setTimesId(int $times_id): void
    {
        $this->times_id = $times_id;
    }

    /**
     * @return int
     */
    public function getPontos(): int
    {
        return $this->pontos;
    }

    /**
     * @param int $pontos
     */
    public function setPontos(int $pontos): void
    {
        $this->pontos = $pontos;
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
