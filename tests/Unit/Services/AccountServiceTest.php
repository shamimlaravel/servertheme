<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use ShamimStack\ServerTheme\Core\Client;
use ShamimStack\ServerTheme\DTOs\Common\AccountInfo;
use ShamimStack\ServerTheme\Services\AccountService;

class AccountServiceTest extends TestCase
{
    public function test_service_instantiation(): void
    {
        $client = $this->createMock(Client::class);
        $service = new AccountService($client);
        $this->assertInstanceOf(AccountService::class, $service);
    }
}
