<?php

namespace App\BoundedContexts\Shared\Exceptions;

class TimeNaoEncontradoException extends BusinessException
{
    protected $message = 'Time nao encontrado';

    public function render($request)
    {
        return response()->json(['message' => $this->getMessage()], 404);
    }
}
