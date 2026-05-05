<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Support;

use ShamimStack\ServerTheme\Core\Enums\ApiVersion;
use ShamimStack\ServerTheme\Exceptions\InvalidApiVersionException;

final class ConfigValidator
{
    public static function validate(array $config): void
    {
        $version = $config['api_version'] ?? 'pro';

        if (!in_array($version, ['auto', 'standard', 'pro'], true)) {
            throw InvalidApiVersionException::make($version);
        }

        if ($version === 'standard' || $version === 'auto') {
            self::validateStandardConfig($config['standard'] ?? []);
        }

        if ($version === 'pro' || $version === 'auto') {
            self::validateProConfig($config['pro'] ?? []);
        }
    }

    private static function validateStandardConfig(array $config): void
    {
        if (empty($config['base_url'])) {
            throw new \InvalidArgumentException('Standard API base_url is required');
        }
        if (empty($config['api_key'])) {
            throw new \InvalidArgumentException('Standard API api_key is required');
        }
        if (empty($config['username'])) {
            throw new \InvalidArgumentException('Standard API username is required');
        }
    }

    private static function validateProConfig(array $config): void
    {
        if (empty($config['base_url'])) {
            throw new \InvalidArgumentException('Pro API base_url is required');
        }
        if (empty($config['api_token'])) {
            throw new \InvalidArgumentException('Pro API api_token is required');
        }
    }
}
