<?php

namespace App\BoundedContexts\Times\Application\Services;

use App\BoundedContexts\Times\Application\Mappers\JogadorMapper;
use App\BoundedContexts\Times\Domain\Interfaces\JogadorRepositoryInterface;

class GetJogadorService
{
    public function __construct(private JogadorRepositoryInterface $jogadorRepository, private JogadorMapper $mapper)
    {
    }

    public function getAll()
    {
        $jogadores = $this->jogadorRepository->getAll();
        return $this->mapper->entityToDataBatch($jogadores);
    }
}
