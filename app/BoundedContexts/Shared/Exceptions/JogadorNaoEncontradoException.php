<?php

namespace App\BoundedContexts\Shared\Exceptions;

class JogadorNaoEncontradoException extends BusinessException
{
    protected $message = 'Jogador nao encontrado';

    public function render($request)
    {
        return response()->json(['message' => $this->getMessage()], 404);
    }
}
