<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Tests\Feature;

use PHPUnit\Framework\TestCase;
use ShamimStack\ServerTheme\DTOs\Common\FeedbackPayload;

class FeedbackWebhookTest extends TestCase
{
    public function test_feedback_payload_creation(): void
    {
        $payload = FeedbackPayload::fromArray([
            'order_id' => 'ORD-123',
            'status' => 'success',
            'reference_id' => 'REF001',
            'message' => 'Order completed',
        ]);

        $this->assertEquals('ORD-123', $payload->orderId);
        $this->assertEquals('success', $payload->status);
        $this->assertEquals('REF001', $payload->referenceId);
    }

    public function test_feedback_payload_with_order_uuid(): void
    {
        $payload = FeedbackPayload::fromArray([
            'order_uuid' => 'uuid-123',
            'status' => 'pending',
        ]);

        $this->assertEquals('uuid-123', $payload->orderId);
        $this->assertEquals('pending', $payload->status);
    }
}
