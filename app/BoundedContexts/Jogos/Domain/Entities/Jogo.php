<?php

namespace App\BoundedContexts\Jogos\Domain\Entities;

class Jogo
{
    public function __construct(private string $data, private string $horaDeInicio, private string $horaDeTermino, private int $primeiroTimeId, private int $segundoTimeId, private Placar $placar, private ?array $jogadores = null, private ?array $classificacaoDosTimesParticipantes = null, private ?array $rankingDosJogadoresParticipantes = null, public readonly ?int $id = null)
    {
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @param string $data
     */
    public function setData(string $data): void
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getHoraDeInicio(): string
    {
        return $this->horaDeInicio;
    }

    /**
     * @param string $horaDeInicio
     */
    public function setHoraDeInicio(string $horaDeInicio): void
    {
        $this->horaDeInicio = $horaDeInicio;
    }

    /**
     * @return string
     */
    public function getHoraDeTermino(): string
    {
        return $this->horaDeTermino;
    }

    /**
     * @param string $horaDeTermino
     */
    public function setHoraDeTermino(string $horaDeTermino): void
    {
        $this->horaDeTermino = $horaDeTermino;
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
     * @return array
     */
    public function getJogadores(): array
    {
        return $this->jogadores;
    }

    /**
     * @param array $jogadores
     */
    public function setJogadores(array $jogadores): void
    {
        $this->jogadores = $jogadores;
    }

    /**
     * @return Placar
     */
    public function getPlacar(): Placar
    {
        return $this->placar;
    }

    /**
     * @param Placar $placar
     */
    public function setPlacar(Placar $placar): void
    {
        $this->placar = $placar;
    }

    /**
     * @return array|null
     */
    public function getClassificacaoDosTimesParticipantes(): ?array
    {
        return $this->classificacaoDosTimesParticipantes;
    }

    /**
     * @param array|null $classificacaoDosTimesParticipantes
     */
    public function setClassificacaoDosTimesParticipantes(?array $classificacaoDosTimesParticipantes): void
    {
        $this->classificacaoDosTimesParticipantes = $classificacaoDosTimesParticipantes;
    }

    /**
     * @return array|null
     */
    public function getRankingDosJogadoresParticipantes(): ?array
    {
        return $this->rankingDosJogadoresParticipantes;
    }

    /**
     * @param array|null $rankingDosJogadoresParticipantes
     */
    public function setRankingDosJogadoresParticipantes(?array $rankingDosJogadoresParticipantes): void
    {
        $this->rankingDosJogadoresParticipantes = $rankingDosJogadoresParticipantes;
    }

}
