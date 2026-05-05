<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Tests\Unit\Drivers;

use PHPUnit\Framework\TestCase;
use ShamimStack\ServerTheme\Core\Drivers\FusionStandardDriver;
use ShamimStack\ServerTheme\DTOs\Common\Order;

class FusionStandardDriverTest extends TestCase
{
    private array $config;

    protected function setUp(): void
    {
        $this->config = [
            'base_url' => 'https://test.example.com/api/',
            'username' => 'testuser',
            'api_key' => 'testkey',
            'timeout' => 10,
            'retries' => 1,
        ];
    }

    public function test_driver_can_be_instantiated(): void
    {
        $driver = new FusionStandardDriver($this->config);
        $this->assertInstanceOf(FusionStandardDriver::class, $driver);
    }

    public function test_place_order_creates_order_object(): void
    {
        $order = Order::fromArray([
            'service_id' => '123',
            'reference_id' => 'TEST001',
            'imei' => '111111111111119',
        ]);

        $this->assertEquals('123', $order->serviceId);
        $this->assertEquals('TEST001', $order->referenceId);
        $this->assertEquals('111111111111119', $order->imei);
    }
}
