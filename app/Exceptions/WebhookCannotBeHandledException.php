<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class WebhookCannotBeHandledException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        $message = "Webhook cannot be handled. " . $message;

        parent::__construct($message, $code, $previous);
    }
}
