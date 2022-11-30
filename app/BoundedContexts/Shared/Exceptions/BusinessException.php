<?php

namespace App\BoundedContexts\Shared\Exceptions;

class BusinessException extends \RuntimeException
{
    public function render($request)
    {
        return response()->json(['message' => $this->getMessage()], 400);
    }
}
