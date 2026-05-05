<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Exceptions;

class InvalidApiVersionException extends ServerThemeException
{
    public static function make(string $version): self
    {
        return new self("Invalid API version: {$version}. Use 'auto', 'standard', or 'pro'.", 422);
    }
}
