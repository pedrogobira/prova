<?php

namespace App\BoundedContexts\Times\Domain\Entities;

class Classificacao
{
    public function __construct(private int $pontos, private int $pontuacaoDosCartoes, private ?int $times_id = null, public readonly ?int $id = null)
    {
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

    /**
     * @return int|null
     */
    public function getTimesId(): ?int
    {
        return $this->times_id;
    }

    /**
     * @param int|null $times_id
     */
    public function setTimesId(?int $times_id): void
    {
        $this->times_id = $times_id;
    }
}
