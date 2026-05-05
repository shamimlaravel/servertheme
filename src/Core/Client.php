<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Core;

use ShamimStack\ServerTheme\Core\Contracts\DhruFusionInterface;
use ShamimStack\ServerTheme\Core\Drivers\FusionProDriver;
use ShamimStack\ServerTheme\Core\Drivers\FusionStandardDriver;
use ShamimStack\ServerTheme\Core\Enums\ApiVersion;
use ShamimStack\ServerTheme\Core\Resolver\VersionResolver;
use ShamimStack\ServerTheme\DTOs\Common\AccountInfo;
use ShamimStack\ServerTheme\DTOs\Common\Order;
use ShamimStack\ServerTheme\DTOs\Common\OrderResult;

class Client
{
    protected DhruFusionInterface $driver;
    protected ApiVersion $activeVersion;
    protected array $config;

    public function __construct(array $config, ?VersionResolver $resolver = null)
    {
        $this->config = $config;
        $resolver = $resolver ?? new VersionResolver();
        $this->activeVersion = $resolver->resolve($config);
        $this->initializeDriver();
    }

    private function initializeDriver(): void
    {
        $this->driver = match ($this->activeVersion) {
            ApiVersion::STANDARD => new FusionStandardDriver($this->config),
            ApiVersion::PRO => new FusionProDriver($this->config),
        };
    }

    public function switchVersion(ApiVersion $version): void
    {
        $this->activeVersion = $version;
        $this->initializeDriver();
    }

    public function getActiveVersion(): ApiVersion
    {
        return $this->activeVersion;
    }

    public function getAccountInfo(): AccountInfo
    {
        return $this->driver->getAccountInfo();
    }

    public function getServices(?string $categoryId = null): array
    {
        return $this->driver->getServices($categoryId);
    }

    public function placeOrder(Order $order): OrderResult
    {
        return $this->driver->placeOrder($order);
    }

    public function placeBulkOrders(array $orders): array
    {
        return $this->driver->placeBulkOrders($orders);
    }

    public function getOrderDetails(string $orderId): OrderResult
    {
        return $this->driver->getOrderDetails($orderId);
    }

    public function processFeedback(array $payload): array
    {
        return $this->driver->processFeedback($payload);
    }
}
