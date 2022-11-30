<?php

namespace App\BoundedContexts\Jogos\Application\Mappers;

use App\BoundedContexts\Jogos\Application\DataTransferObjects\JogoData;
use App\BoundedContexts\Jogos\Domain\Entities\Jogo;

class JogoMapper
{
    public function entityToDataBatch(array $entities): array
    {
        $data = [];
        foreach ($entities as $entity) {
            $data[] = $this->entityToData($entity);
        }
        return $data;
    }

    public function entityToData(Jogo $jogo): JogoData
    {
        return new JogoData(id: $jogo->id, data: $jogo->getData(), horaDeInicio: $jogo->getHoraDeInicio(), horaDeTermino: $jogo->getHoraDeTermino(), primeiroTimeId: $jogo->getPrimeiroTimeId(), segundoTimeId: $jogo->getSegundoTimeId(), placar: [
            'golsPrimeiroTime' => $jogo->getPlacar()->getGolsPrimeiroTime(),
            'golsSegundoTime' => $jogo->getPlacar()->getGolsSegundoTime(),
            'vencedorId' => $jogo->getPlacar()->getVencedorId()
        ]);
    }
}
