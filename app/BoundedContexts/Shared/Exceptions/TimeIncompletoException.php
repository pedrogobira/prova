<?php

namespace App\BoundedContexts\Shared\Exceptions;

class TimeIncompletoException extends BusinessException
{
    protected $message = 'Time incompleto';

    public function render($request)
    {
        return response()->json(['message' => $this->getMessage()], 422);
    }
}
