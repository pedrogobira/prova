<?php

namespace App\BoundedContexts\Shared\Exceptions;

class JogoNaoEncontradoException extends BusinessException
{
    protected $message = 'Jogo nao encontrado';

    public function render($request)
    {
        return response()->json(['message' => $this->getMessage()], 404);
    }
}
