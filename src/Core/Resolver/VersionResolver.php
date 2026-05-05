<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Core\Resolver;

use ShamimStack\ServerTheme\Core\Enums\ApiVersion;
use ShamimStack\ServerTheme\Exceptions\VersionDetectionException;

final class VersionResolver
{
    public function resolve(array $config): ApiVersion
    {
        $requested = $config['api_version'] ?? 'pro';

        return match ($requested) {
            'auto' => $this->autoDetect($config),
            'standard' => ApiVersion::STANDARD,
            'pro' => ApiVersion::PRO,
            default => throw new \InvalidArgumentException(
                "Invalid API version: {$requested}. Use 'auto', 'standard', or 'pro'."
            ),
        };
    }

    private function autoDetect(array $config): ApiVersion
    {
        $hasProConfig = !empty($config['pro']['api_token'] ?? null);
        $hasStandardConfig = !empty($config['standard']['api_key'] ?? null)
            && !empty($config['standard']['username'] ?? null);

        if ($hasProConfig) {
            return ApiVersion::PRO;
        }

        if ($hasStandardConfig) {
            return ApiVersion::STANDARD;
        }

        throw VersionDetectionException::unableToDetect();
    }
}
