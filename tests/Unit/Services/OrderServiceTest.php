<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use ShamimStack\ServerTheme\Core\Client;
use ShamimStack\ServerTheme\Services\OrderService;

class OrderServiceTest extends TestCase
{
    public function test_service_instantiation(): void
    {
        $client = $this->createMock(Client::class);
        $service = new OrderService($client);
        $this->assertInstanceOf(OrderService::class, $service);
    }
}
