<?php

namespace App\Exceptions;

use Exception;

class MissingIntegrationConfigException extends Exception
{
    public function __construct(string $integrationName, string $configKey, string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        $message = sprintf('`%s` config is missing for `%s` integration. %s', $configKey, $integrationName, $message);

        parent::__construct($message, $code, $previous);
    }
}
