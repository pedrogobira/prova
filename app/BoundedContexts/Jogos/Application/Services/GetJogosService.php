<?php

namespace App\BoundedContexts\Jogos\Application\Services;

use App\BoundedContexts\Jogos\Application\Mappers\JogoMapper;
use App\BoundedContexts\Jogos\Domain\Interfaces\JogoRepositoryInterface;

class GetJogosService
{
    public function __construct(private JogoRepositoryInterface $jogoRepository, private JogoMapper $mapper)
    {
    }

    public function getAll()
    {
        $jogos = $this->jogoRepository->getAll();
        return $this->mapper->entityToDataBatch($jogos);
    }
}
