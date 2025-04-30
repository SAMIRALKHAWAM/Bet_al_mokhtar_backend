<?php

namespace App\Exceptions;

use Exception;

class ValidationException extends Exception
{

    protected $code = 422;
    public function render()
    {
        return response()->json(["success" => false,
            "message" => $this->getMessage(),
            "code" => $this->code,
            "data" => null
        ],$this->code);
    }
}
