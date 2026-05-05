<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Core\Drivers;

use ShamimStack\ServerTheme\Core\Contracts\FusionStandardInterface;
use ShamimStack\ServerTheme\Core\Enums\StandardAction;
use ShamimStack\ServerTheme\DTOs\Common\AccountInfo;
use ShamimStack\ServerTheme\DTOs\Common\Order;
use ShamimStack\ServerTheme\DTOs\Common\OrderResult;
use ShamimStack\ServerTheme\Support\ResponseNormalizer;

final class FusionStandardDriver extends AbstractDriver implements FusionStandardInterface
{
    private function call(string $action, array $params = []): array
    {
        $cfg = $this->config['standard'] ?? $this->config;
        
        // Ensure base_url ends with /public if not already present
        $baseUrl = rtrim($cfg['base_url'] ?? '', '/');
        if (!str_ends_with($baseUrl, '/public')) {
            $baseUrl .= '/public';
        }

        $payload = array_merge([
            'action' => $action,
            'username' => $cfg['username'] ?? '',
            'api_key' => $cfg['api_key'] ?? '',
        ], $params);

        return $this->executeRequest(
            method: 'post',
            url: $baseUrl,
            data: $payload
        );
    }

    public function getAccountInfo(): AccountInfo
    {
        $response = $this->call(StandardAction::ACCOUNT_INFO->value);
        return ResponseNormalizer::toCommonAccountInfo($response);
    }

    public function getServices(?string $categoryId = null): array
    {
        $response = $this->call(StandardAction::IMEI_SERVICE_LIST->value);
        return ResponseNormalizer::toCommonServiceList($response);
    }

    public function placeOrder(Order $order): OrderResult
    {
        $payload = [
            'imei' => $order->imei,
            'service_id' => $order->serviceId,
            'reference_id' => $order->referenceId,
            'quantity' => $order->quantity,
        ];

        $response = $this->call(StandardAction::PLACE_IMEI_ORDER->value, $payload);
        return ResponseNormalizer::toCommonOrderResult($response);
    }

    public function placeBulkOrders(array $orders): array
    {
        $bulkData = implode("\n", array_map(function (Order $order) {
            return "{$order->imei},{$order->serviceId},{$order->referenceId}";
        }, $orders));

        $response = $this->call(StandardAction::PLACE_IMEI_ORDER_BULK->value, [
            'bulk_data' => $bulkData,
        ]);

        return ResponseNormalizer::toCommonBulkOrderResults($response);
    }

    public function getOrderDetails(string $orderId): OrderResult
    {
        $response = $this->call(StandardAction::GET_IMEI_ORDER->value, [
            'order_id' => $orderId,
        ]);

        return ResponseNormalizer::toCommonOrderResult($response);
    }

    public function processFeedback(array $payload): array
    {
        // Feedback processing for Standard API
        return $payload;
    }
}
