<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Exceptions;

class ResponseMappingException extends ServerThemeException
{
    public static function unknownSource(): self
    {
        return new self(
            'Unable to map API response. Unknown source format.',
            500
        );
    }
}
