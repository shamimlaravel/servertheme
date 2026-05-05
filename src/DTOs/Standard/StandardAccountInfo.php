<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\DTOs\Standard;

final readonly class StandardAccountInfo
{
    public function __construct(
        public float $balance,
        public string $currency,
        public string $name,
        public string $email,
        public array $raw = [],
    ) {}

    public static function fromArray(array $data): self
    {
        $success = $data['SUCCESS'][0] ?? [];
        return new self(
            balance: (float) ($success['balance'] ?? 0),
            currency: $success['currency'] ?? 'USD',
            name: $success['name'] ?? 'Unknown',
            email: $success['email'] ?? '',
            raw: $data,
        );
    }

    public function toArray(): array
    {
        return $this->raw;
    }
}
