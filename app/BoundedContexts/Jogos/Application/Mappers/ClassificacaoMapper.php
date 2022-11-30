<?php

namespace App\BoundedContexts\Jogos\Application\Mappers;

use App\BoundedContexts\Jogos\Application\DataTransferObjects\ClassificacaoData;
use App\BoundedContexts\Jogos\Domain\Entities\Classificacao;

class ClassificacaoMapper
{
    public function entityToDataBatch(array $entities): array
    {
        $data = [];
        foreach ($entities as $entity) {
            $data[] = $this->entityToData($entity);
        }
        return $data;
    }

    public function entityToData(Classificacao $classificacao): ClassificacaoData
    {
        return new ClassificacaoData($classificacao->id, $classificacao->getTimesId(), $classificacao->nomeDoTime, $classificacao->getPontos(), $classificacao->getPontuacaoDosCartoes(), $classificacao->quantidadeDeGols);
    }
}
