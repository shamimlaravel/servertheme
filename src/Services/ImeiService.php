<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Services;

use ShamimStack\ServerTheme\Core\Client;
use ShamimStack\ServerTheme\DTOs\Common\Order;
use ShamimStack\ServerTheme\DTOs\Common\OrderResult;

class ImeiService
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function placeOrder(string $imei, string $serviceId, string $referenceId, int $quantity = 1): OrderResult
    {
        $order = new Order(
            serviceId: $serviceId,
            referenceId: $referenceId,
            quantity: $quantity,
            imei: $imei
        );

        return $this->client->placeOrder($order);
    }

    /**
     * @return OrderResult[]
     */
    public function placeBulkOrders(array $imeiOrders): array
    {
        $orders = array_map(
            fn(array $item) => new Order(
                serviceId: $item['service_id'],
                referenceId: $item['reference_id'],
                imei: $item['imei'],
                quantity: $item['quantity'] ?? 1
            ),
            $imeiOrders
        );

        return $this->client->placeBulkOrders($orders);
    }
}
