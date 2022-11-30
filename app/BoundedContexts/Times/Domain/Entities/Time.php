<?php

namespace App\BoundedContexts\Times\Domain\Entities;

class Time
{
    public function __construct(private string $nome, private ?Classificacao $classificacao = null, private ?array $jogadores = null, public readonly ?int $id = null)
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
     * @return Classificacao
     */
    public function getClassificacao(): Classificacao
    {
        return $this->classificacao;
    }

    /**
     * @param Classificacao $classificacao
     */
    public function setClassificacao(Classificacao $classificacao): void
    {
        $this->classificacao = $classificacao;
    }

    /**
     * @return array|null
     */
    public function getJogadores(): ?array
    {
        return $this->jogadores;
    }

    /**
     * @param array|null $jogadores
     */
    public function setJogadores(?array $jogadores): void
    {
        $this->jogadores = $jogadores;
    }
}
