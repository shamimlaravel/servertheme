<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Services;

use ShamimStack\ServerTheme\Core\Client;
use ShamimStack\ServerTheme\DTOs\Common\Order;
use ShamimStack\ServerTheme\DTOs\Common\OrderResult;

class OrderService
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function place(Order $order): OrderResult
    {
        return $this->client->placeOrder($order);
    }

    /**
     * @param Order[] $orders
     * @return OrderResult[]
     */
    public function placeBulk(array $orders): array
    {
        return $this->client->placeBulkOrders($orders);
    }

    public function getDetails(string $orderId): OrderResult
    {
        return $this->client->getOrderDetails($orderId);
    }
}
