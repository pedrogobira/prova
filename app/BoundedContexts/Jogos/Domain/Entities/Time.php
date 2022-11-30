<?php

namespace App\BoundedContexts\Jogos\Domain\Entities;

class Time
{
    public function __construct(private string $nome, public readonly ?int $id, private ?array $jogadores)
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

    /**
     * @return Classificacao|null
     */
    public function getClassificacao(): ?Classificacao
    {
        return $this->classificacao;
    }

    /**
     * @param Classificacao|null $classificacao
     */
    public function setClassificacao(?Classificacao $classificacao): void
    {
        $this->classificacao = $classificacao;
    }


}
