<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Core\Contracts;

use ShamimStack\ServerTheme\DTOs\Common\AccountInfo;
use ShamimStack\ServerTheme\DTOs\Common\Order;
use ShamimStack\ServerTheme\DTOs\Common\OrderResult;

interface DhruFusionInterface
{
    public function getAccountInfo(): AccountInfo;
    public function getServices(?string $categoryId = null): array;
    public function placeOrder(Order $order): OrderResult;
    public function placeBulkOrders(array $orders): array;
    public function getOrderDetails(string $orderId): OrderResult;
    public function processFeedback(array $payload): array;
}
