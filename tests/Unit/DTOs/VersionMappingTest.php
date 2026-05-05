<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Tests\Unit\DTOs;

use PHPUnit\Framework\TestCase;
use ShamimStack\ServerTheme\Support\ResponseNormalizer;

class VersionMappingTest extends TestCase
{
    public function test_normalize_standard_account_info(): void
    {
        $response = [
            'SUCCESS' => [
                [
                    'balance' => 450.78,
                    'currency' => 'EUR',
                    'name' => 'John Doe',
                    'email' => 'john@example.com',
                ],
            ],
        ];

        $account = ResponseNormalizer::toCommonAccountInfo($response);

        $this->assertEquals(450.78, $account->balance);
        $this->assertEquals('EUR', $account->currency);
        $this->assertEquals('standard', $account->apiVersion);
    }

    public function test_normalize_pro_account_info(): void
    {
        $response = [
            'data' => [
                'balance' => 1250.50,
                'currency' => 'USD',
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
            ],
        ];

        $account = ResponseNormalizer::toCommonAccountInfo($response);

        $this->assertEquals(1250.50, $account->balance);
        $this->assertEquals('USD', $account->currency);
        $this->assertEquals('pro', $account->apiVersion);
    }

    public function test_normalize_standard_services(): void
    {
        $response = [
            'SUCCESS' => [
                [
                    'currency' => 'EUR',
                    'services' => [
                        [
                            'service_id' => '123',
                            'name' => 'iCloud Unlock',
                            'price' => 25.00,
                            'category' => 'Apple',
                        ],
                    ],
                ],
            ],
        ];

        $services = ResponseNormalizer::toCommonServiceList($response);

        $this->assertCount(1, $services);
        $this->assertEquals('123', $services[0]->id);
        $this->assertEquals('iCloud Unlock', $services[0]->name);
    }
}
