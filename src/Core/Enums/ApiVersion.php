<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Core\Enums;

enum ApiVersion: string
{
    case STANDARD = 'standard';
    case PRO = 'pro';

    public function label(): string
    {
        return match ($this) {
            self::STANDARD => 'Dhru Fusion Standard (Legacy Action-based)',
            self::PRO => 'Dhru Fusion Pro (RESTful)',
        };
    }

    public function isLegacy(): bool
    {
        return $this === self::STANDARD;
    }
}
