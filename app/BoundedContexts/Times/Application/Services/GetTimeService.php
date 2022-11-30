<?php

namespace App\BoundedContexts\Times\Application\Services;

use App\BoundedContexts\Times\Application\Mappers\TimeMapper;
use App\BoundedContexts\Times\Domain\Interfaces\TimeRepositoryInterface;

class GetTimeService
{
    public function __construct(private TimeRepositoryInterface $timeRepository, private TimeMapper $timeMapper)
    {
    }

    public function getAll()
    {
        $times = $this->timeRepository->getAll();
        return $this->timeMapper->entityToDataBatch($times);
    }
}
