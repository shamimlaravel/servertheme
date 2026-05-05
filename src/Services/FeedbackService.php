<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Services;

use ShamimStack\ServerTheme\Core\Client;

class FeedbackService
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function handle(array $payload): array
    {
        return $this->client->processFeedback($payload);
    }
}
