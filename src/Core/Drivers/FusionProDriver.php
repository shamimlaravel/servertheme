<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Core\Drivers;

use ShamimStack\ServerTheme\Core\Contracts\FusionProInterface;
use ShamimStack\ServerTheme\Core\Enums\ProEndpoint;
use ShamimStack\ServerTheme\DTOs\Common\AccountInfo;
use ShamimStack\ServerTheme\DTOs\Common\Order;
use ShamimStack\ServerTheme\DTOs\Common\OrderResult;
use ShamimStack\ServerTheme\Support\ResponseNormalizer;

final class FusionProDriver extends AbstractDriver implements FusionProInterface
{
    private function getEndpoint(string $endpoint, array $query = []): array
    {
        $cfg = $this->config['pro'] ?? $this->config;
        $url = rtrim($cfg['base_url'] ?? '', '/') . '/' . ltrim($endpoint, '/');
        return $this->executeRequest('get', $url, query: $query, token: $cfg['api_token'] ?? null);
    }

    private function postEndpoint(string $endpoint, array $data): array
    {
        $cfg = $this->config['pro'] ?? $this->config;
        $url = rtrim($cfg['base_url'] ?? '', '/') . '/' . ltrim($endpoint, '/');
        return $this->executeRequest('post', $url, data: $data, token: $cfg['api_token'] ?? null);
    }

    public function getAccountInfo(): AccountInfo
    {
        $response = $this->getEndpoint(ProEndpoint::ACCOUNT->value);
        return ResponseNormalizer::toCommonAccountInfo($response);
    }

    public function getServices(?string $categoryId = null): array
    {
        $query = $categoryId ? ['category_id' => $categoryId] : [];
        $response = $this->getEndpoint(ProEndpoint::PRODUCTS->value, $query);
        return ResponseNormalizer::toCommonServiceList($response);
    }

    public function placeOrder(Order $order): OrderResult
    {
        $payload = [
            'product_uuid' => $order->serviceId,
            'reference_id' => $order->referenceId,
            'quantity' => $order->quantity,
            'imei' => $order->imei,
            'username' => $order->username,
            'feedback_url' => $order->feedbackUrl,
            'extra_fields' => $order->extraFields,
        ];

        $response = $this->postEndpoint(ProEndpoint::ORDER->value, $payload);
        return ResponseNormalizer::toCommonOrderResult($response);
    }

    public function placeBulkOrders(array $orders): array
    {
        $payload = [
            'orders' => array_map(function (Order $order) {
                return [
                    'product_uuid' => $order->serviceId,
                    'reference_id' => $order->referenceId,
                    'quantity' => $order->quantity,
                    'imei' => $order->imei,
                ];
            }, $orders),
        ];

        $response = $this->postEndpoint(ProEndpoint::ORDER->value, $payload);
        return ResponseNormalizer::toCommonBulkOrderResults($response);
    }

    public function getOrderDetails(string $orderId): OrderResult
    {
        $response = $this->getEndpoint(ProEndpoint::ORDER->value, ['order_uuid' => $orderId]);
        return ResponseNormalizer::toCommonOrderResult($response);
    }

    public function processFeedback(array $payload): array
    {
        // Feedback processing for Pro API
        return $payload;
    }
}
