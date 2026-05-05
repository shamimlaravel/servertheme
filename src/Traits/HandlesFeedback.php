<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Traits;

use ShamimStack\ServerTheme\DTOs\Common\FeedbackPayload;
use ShamimStack\ServerTheme\Exceptions\ServerThemeException;

trait HandlesFeedback
{
    public function processFeedback(array $payload): array
    {
        if (empty($payload)) {
            throw new ServerThemeException('Feedback payload is empty', 422);
        }

        $feedback = FeedbackPayload::fromArray($payload);

        return [
            'order_id' => $feedback->orderId,
            'status' => $feedback->status,
            'reference_id' => $feedback->referenceId,
            'message' => $feedback->message,
            'processed_at' => now()->toISOString(),
        ];
    }
}
