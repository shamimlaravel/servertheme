<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme;

use ShamimStack\ServerTheme\Core\Client;
use ShamimStack\ServerTheme\Core\Enums\ApiVersion;
use ShamimStack\ServerTheme\DTOs\Common\AccountInfo;
use ShamimStack\ServerTheme\DTOs\Common\Order;
use ShamimStack\ServerTheme\DTOs\Common\OrderResult;

final class ServerTheme
{
    private Client $client;

    public function __construct(?string $version = null)
    {
        $config = config('servertheme');
        if ($version) {
            $config['api_version'] = $version;
        }
        $this->client = new Client($config);
    }

    public function useStandard(): self
    {
        $this->client->switchVersion(ApiVersion::STANDARD);
        return $this;
    }

    public function usePro(): self
    {
        $this->client->switchVersion(ApiVersion::PRO);
        return $this;
    }

    public function getActiveVersion(): ApiVersion
    {
        return $this->client->getActiveVersion();
    }

    public function getAccountInfo(): AccountInfo
    {
        return $this->client->getAccountInfo();
    }

    public function getServices(?string $categoryId = null): array
    {
        return $this->client->getServices($categoryId);
    }

    public function placeOrder(Order $order): OrderResult
    {
        return $this->client->placeOrder($order);
    }

    public function placeBulkOrders(array $orders): array
    {
        return $this->client->placeBulkOrders($orders);
    }

    public function getOrderDetails(string $orderId): OrderResult
    {
        return $this->client->getOrderDetails($orderId);
    }

    public function handleFeedback(array $payload): array
    {
        return $this->client->processFeedback($payload);
    }
}
