<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\DTOs\Common;

use InvalidArgumentException;

final readonly class Order
{
    public function __construct(
        public string $serviceId,
        public string $referenceId,
        public int $quantity = 1,
        public ?string $imei = null,
        public ?string $username = null,
        public ?string $feedbackUrl = null,
        public array $extraFields = [],
    ) {
        if ($this->quantity < 1) {
            throw new InvalidArgumentException('Quantity must be at least 1');
        }
    }

    public static function fromArray(array $data): self
    {
        return new self(
            serviceId: $data['service_id'] ?? $data['product_uuid'] ?? throw new InvalidArgumentException('Service ID required'),
            referenceId: $data['reference_id'] ?? (string) uniqid('order_', true),
            quantity: (int) ($data['quantity'] ?? $data['Quantity'] ?? 1),
            imei: $data['imei'] ?? $data['IMEI'] ?? null,
            username: $data['username'] ?? null,
            feedbackUrl: $data['feedback_url'] ?? null,
            extraFields: array_diff_key($data, array_flip(['service_id', 'product_uuid', 'reference_id', 'quantity', 'Quantity', 'imei', 'IMEI', 'username', 'feedback_url'])),
        );
    }
}
