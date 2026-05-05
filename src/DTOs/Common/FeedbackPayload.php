<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\DTOs\Common;

final readonly class FeedbackPayload
{
    public function __construct(
        public string $orderId,
        public string $status,
        public ?string $referenceId = null,
        public ?string $message = null,
        public array $raw = [],
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            orderId: $data['order_id'] ?? $data['order_uuid'] ?? '',
            status: $data['status'] ?? 'unknown',
            referenceId: $data['reference_id'] ?? null,
            message: $data['message'] ?? null,
            raw: $data,
        );
    }
}
