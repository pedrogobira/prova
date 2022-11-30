<?php

namespace App\BoundedContexts\Jogos\Domain\Entities;

class Jogador
{
    public function __construct(public readonly string $cpf, public readonly int $id, public readonly int $times_id, private ?array $gols = null, private ?array $cartoes = null)
    {
    }

    /**
     * @return array|null
     */
    public function getGols(): ?array
    {
        return $this->gols;
    }

    /**
     * @param array|null $gols
     */
    public function setGols(?array $gols): void
    {
        $this->gols = $gols;
    }

    /**
     * @return array|null
     */
    public function getCartoes(): ?array
    {
        return $this->cartoes;
    }

    /**
     * @param array|null $cartoes
     */
    public function setCartoes(?array $cartoes): void
    {
        $this->cartoes = $cartoes;
    }
}
