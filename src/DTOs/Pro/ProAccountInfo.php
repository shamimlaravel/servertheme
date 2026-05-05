<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\DTOs\Pro;

final readonly class ProAccountInfo
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
        $d = $data['data'] ?? [];
        return new self(
            balance: (float) ($d['balance'] ?? 0),
            currency: $d['currency'] ?? 'USD',
            name: $d['name'] ?? 'Unknown',
            email: $d['email'] ?? '',
            raw: $data,
        );
    }

    public function toArray(): array
    {
        return $this->raw;
    }
}
