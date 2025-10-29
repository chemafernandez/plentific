<?php

namespace Chema\ApiService\Exceptions;

use Exception;

class ApiException extends Exception
{
    public function __construct(
        string $message = "API request failed",
        int $code = 0,
        ?Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
