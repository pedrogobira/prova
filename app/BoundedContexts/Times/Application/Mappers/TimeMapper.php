<?php

namespace App\BoundedContexts\Times\Application\Mappers;

use App\BoundedContexts\Times\Application\DataTransferObjects\TimeData;
use App\BoundedContexts\Times\Domain\Entities\Time;

class TimeMapper
{
    public function entityToDataBatch(array $times): array
    {
        $data = [];
        foreach ($times as $time) {
            $data[] = $this->entityToData($time);
        }
        return $data;
    }

    public function entityToData(Time $time): TimeData
    {
        return new TimeData($time->id, $time->getNome(), $time->getJogadores());
    }
}
