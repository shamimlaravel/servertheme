<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\DTOs\Common;

final readonly class OrderResult
{
    public function __construct(
        public bool $success,
        public string $orderId,
        public string $status,
        public ?string $referenceId = null,
        public ?float $amount = null,
        public ?string $currency = null,
        public ?string $message = null,
        public array $raw = [],
    ) {}

    public static function success(array $data): self
    {
        return new self(
            success: true,
            orderId: $data['order_id'] ?? $data['order_uuid'] ?? '',
            status: $data['status'] ?? 'pending',
            referenceId: $data['reference_id'] ?? null,
            amount: isset($data['amount']) ? (float) $data['amount'] : null,
            currency: $data['currency_code'] ?? null,
            message: $data['message'] ?? null,
            raw: $data,
        );
    }

    public static function failed(string $message, array $data = []): self
    {
        return new self(
            success: false,
            orderId: '',
            status: 'failed',
            message: $message,
            raw: $data,
        );
    }
}
