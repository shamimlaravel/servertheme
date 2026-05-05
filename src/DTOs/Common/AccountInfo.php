<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\DTOs\Common;

final readonly class AccountInfo
{
    public function __construct(
        public float $balance,
        public string $currency,
        public string $name,
        public string $email,
        public ?string $apiVersion = null,
        public array $raw = [],
    ) {}

    public function formattedBalance(): string
    {
        $currencySymbols = ['USD' => '$', 'EUR' => '€', 'GBP' => '£'];
$symbol = $currencySymbols[$this->currency] ?? $this->currency . ' ';
return $symbol . number_format($this->balance, 2);
    }

    public static function fromArray(array $data): self
    {
        return new self(
            balance: (float) ($data['balance'] ?? 0),
            currency: $data['currency'] ?? 'USD',
            name: $data['name'] ?? 'Unknown',
            email: $data['email'] ?? '',
            apiVersion: $data['apiVersion'] ?? null,
            raw: $data,
        );
    }
}
