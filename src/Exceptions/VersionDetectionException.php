<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Exceptions;

class VersionDetectionException extends ServerThemeException
{
    public static function unableToDetect(): self
    {
        return new self(
            'Unable to auto-detect API version. Please set SERVERTHEME_API_VERSION in your .env file or provide valid credentials.',
            500
        );
    }

    public static function noAccessibleApi(): self
    {
        return new self(
            'Neither Fusion Standard nor Fusion Pro API is accessible. Check your credentials and network.',
            503
        );
    }
}
