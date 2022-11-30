<?php

namespace App\BoundedContexts\Shared\Exceptions;

class JogadorJaExisteException extends BusinessException
{
    protected $message = 'Jogador ja cadastrado';

    public function render($request)
    {
        return response()->json(['message' => $this->getMessage()], 409);
    }
}
