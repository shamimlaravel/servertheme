<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Tests\Unit\DTOs;

use PHPUnit\Framework\TestCase;
use ShamimStack\ServerTheme\DTOs\Common\AccountInfo;
use ShamimStack\ServerTheme\DTOs\Common\Order;
use ShamimStack\ServerTheme\DTOs\Common\OrderResult;

class CommonDtoTest extends TestCase
{
    public function test_account_info_creation(): void
    {
        $account = new AccountInfo(
            balance: 100.50,
            currency: 'USD',
            name: 'John Doe',
            email: 'john@example.com'
        );

        $this->assertEquals(100.50, $account->balance);
        $this->assertEquals('USD', $account->currency);
        $this->assertEquals('$100.50', $account->formattedBalance());
    }

    public function test_order_from_array_with_service_id(): void
    {
        $order = Order::fromArray([
            'service_id' => '123',
            'reference_id' => 'REF001',
            'imei' => '111111111111119',
        ]);

        $this->assertEquals('123', $order->serviceId);
        $this->assertEquals('REF001', $order->referenceId);
    }

    public function test_order_from_array_with_product_uuid(): void
    {
        $order = Order::fromArray([
            'product_uuid' => 'uuid-123',
            'reference_id' => 'REF002',
        ]);

        $this->assertEquals('uuid-123', $order->serviceId);
    }

    public function test_order_result_success(): void
    {
        $result = OrderResult::success([
            'order_id' => 'ORD-1',
            'status' => 'pending',
        ]);

        $this->assertTrue($result->success);
        $this->assertEquals('ORD-1', $result->orderId);
        $this->assertEquals('pending', $result->status);
    }

    public function test_order_result_failed(): void
    {
        $result = OrderResult::failed('Order rejected');

        $this->assertFalse($result->success);
        $this->assertEquals('failed', $result->status);
        $this->assertEquals('Order rejected', $result->message);
    }
}
