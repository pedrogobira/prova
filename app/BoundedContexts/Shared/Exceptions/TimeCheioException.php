<?php

namespace App\BoundedContexts\Shared\Exceptions;


class TimeCheioException extends BusinessException
{
    protected $message = 'Time esta cheio';

    public function render($request)
    {
        return response()->json(['message' => $this->getMessage()], 422);
    }
}
