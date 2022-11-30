<?php

namespace App\BoundedContexts\Shared\Exceptions;

class InformacaoErradaException extends BusinessException
{
    protected $message = 'Informacoes erradas foram informadas';

    public function render($request)
    {
        return response()->json(['message' => $this->getMessage()], 422);
    }
}
