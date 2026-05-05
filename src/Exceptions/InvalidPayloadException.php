<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Exceptions;

class InvalidPayloadException extends ServerThemeException
{
    public static function missingField(string $field, string $version): self
    {
        return new self(
            "Required field '{$field}' is missing for {$version} API.",
            422
        );
    }
}
