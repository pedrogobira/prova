<?php

namespace App\BoundedContexts\Jogos\Application\Services;

use App\BoundedContexts\Jogos\Application\Mappers\ClassificacaoMapper;
use App\BoundedContexts\Jogos\Domain\Interfaces\ClassificacaoRepositoryInterface;

class GetClassificacaoService
{
    public function __construct(private ClassificacaoRepositoryInterface $classificacaoRepository, private ClassificacaoMapper $mapper)
    {
    }

    public function getAll()
    {
        $classificacoes = $this->classificacaoRepository->getAll();
        return $this->mapper->entityToDataBatch($classificacoes);
    }
}
