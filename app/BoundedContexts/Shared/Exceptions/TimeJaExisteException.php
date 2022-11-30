<?php

namespace App\BoundedContexts\Shared\Exceptions;

class TimeJaExisteException extends BusinessException
{
    protected $message = 'Time ja cadastrado';

    public function render($request)
    {
        return response()->json(['message' => $this->getMessage()], 409);
    }
}
