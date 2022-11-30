<?php

namespace App\BoundedContexts\Jogos\Domain\Entities;

class Placar
{
    public function __construct(private int $primeiroTimeId, private int $segundoTimeId, private int $golsPrimeiroTime, private int $golsSegundoTime, private ?int $vencedorId, public readonly ?int $id = null)
    {
    }

    /**
     * @return int
     */
    public function getPrimeiroTimeId(): int
    {
        return $this->primeiroTimeId;
    }

    /**
     * @param int $primeiroTimeId
     */
    public function setPrimeiroTimeId(int $primeiroTimeId): void
    {
        $this->primeiroTimeId = $primeiroTimeId;
    }

    /**
     * @return int
     */
    public function getSegundoTimeId(): int
    {
        return $this->segundoTimeId;
    }

    /**
     * @param int $segundoTimeId
     */
    public function setSegundoTimeId(int $segundoTimeId): void
    {
        $this->segundoTimeId = $segundoTimeId;
    }

    /**
     * @return int
     */
    public function getGolsPrimeiroTime(): int
    {
        return $this->golsPrimeiroTime;
    }

    /**
     * @param int $golsPrimeiroTime
     */
    public function setGolsPrimeiroTime(int $golsPrimeiroTime): void
    {
        $this->golsPrimeiroTime = $golsPrimeiroTime;
    }

    /**
     * @return int
     */
    public function getGolsSegundoTime(): int
    {
        return $this->golsSegundoTime;
    }

    /**
     * @param int $golsSegundoTime
     */
    public function setGolsSegundoTime(int $golsSegundoTime): void
    {
        $this->golsSegundoTime = $golsSegundoTime;
    }

    /**
     * @return int|null
     */
    public function getVencedorId(): ?int
    {
        return $this->vencedorId;
    }

    /**
     * @param int|null $vencedorId
     */
    public function setVencedorId(?int $vencedorId): void
    {
        $this->vencedorId = $vencedorId;
    }
}
