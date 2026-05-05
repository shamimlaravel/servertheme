<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use ShamimStack\ServerTheme\Core\Client;
use ShamimStack\ServerTheme\Services\ProductService;

class ProductServiceTest extends TestCase
{
    public function test_service_instantiation(): void
    {
        $client = $this->createMock(Client::class);
        $service = new ProductService($client);
        $this->assertInstanceOf(ProductService::class, $service);
    }
}
