<?php

namespace App\BoundedContexts\Shared\Exceptions;

class NumeroJaExisteEmTimeException extends BusinessException
{
    protected $message = 'Numero informado ja existe em time';

    public function render($request)
    {
        return response()->json(['message' => $this->getMessage()], 409);
    }
}
