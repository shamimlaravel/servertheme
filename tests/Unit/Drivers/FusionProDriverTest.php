<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Tests\Unit\Drivers;

use PHPUnit\Framework\TestCase;
use ShamimStack\ServerTheme\Core\Drivers\FusionProDriver;

class FusionProDriverTest extends TestCase
{
    private array $config;

    protected function setUp(): void
    {
        $this->config = [
            'base_url' => 'https://api.dhrufusion.com',
            'api_token' => 'test-token',
            'timeout' => 10,
            'retries' => 1,
        ];
    }

    public function test_driver_can_be_instantiated(): void
    {
        $driver = new FusionProDriver($this->config);
        $this->assertInstanceOf(FusionProDriver::class, $driver);
    }
}
