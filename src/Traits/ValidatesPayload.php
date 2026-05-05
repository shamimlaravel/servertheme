<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Traits;

use ShamimStack\ServerTheme\Exceptions\InvalidPayloadException;

trait ValidatesPayload
{
    protected function validateRequired(array $payload, array $requiredFields, string $version): void
    {
        foreach ($requiredFields as $field) {
            if (!isset($payload[$field]) || empty($payload[$field])) {
                throw InvalidPayloadException::missingField($field, $version);
            }
        }
    }

    protected function validateImei(string $imei): bool
    {
        // Basic IMEI validation - 15 digits
        return preg_match('/^\d{15}$/', $imei) === 1;
    }
}
