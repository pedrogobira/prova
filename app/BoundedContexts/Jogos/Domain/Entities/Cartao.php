<?php

namespace App\BoundedContexts\Jogos\Domain\Entities;

class Cartao
{
    public function __construct(private int $jogadores_id, private int $jogadores_times_id, private string $cor, public readonly ?int $jogos_id = null, public readonly ?int $id = null)
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
    public function getJogadoresTimesId(): int
    {
        return $this->jogadores_times_id;
    }

    /**
     * @param int $jogadores_times_id
     */
    public function setJogadoresTimesId(int $jogadores_times_id): void
    {
        $this->jogadores_times_id = $jogadores_times_id;
    }

    /**
     * @return string
     */
    public function getCor(): string
    {
        return $this->cor;
    }

    /**
     * @param string $cor
     */
    public function setCor(string $cor): void
    {
        $this->cor = $cor;
    }
}
