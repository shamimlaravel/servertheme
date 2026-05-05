<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Exceptions;

use Exception;

class ServerThemeException extends Exception
{
    public function __construct(
        string $message = 'Server Theme API Error',
        int $code = 0,
        ?\Throwable $previous = null,
        public readonly ?array $apiResponse = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
