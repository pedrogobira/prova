<?php

namespace App\BoundedContexts\Times\Domain\Actions;

use App\BoundedContexts\Times\Domain\Entities\Classificacao;
use App\BoundedContexts\Times\Domain\Entities\Time;

class CriaClassificacaoAction
{
    public function execute(Time $time): Time
    {
        $time->setClassificacao(new Classificacao(0, 0));
        return $time;
    }
}
