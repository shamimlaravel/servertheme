<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Tests\Feature;

use PHPUnit\Framework\TestCase;
use ShamimStack\ServerTheme\Core\Enums\ApiVersion;
use ShamimStack\ServerTheme\Core\Resolver\VersionResolver;
use ShamimStack\ServerTheme\Exceptions\VersionDetectionException;

class AutoDetectionTest extends TestCase
{
    private VersionResolver $resolver;

    protected function setUp(): void
    {
        $this->resolver = new VersionResolver();
    }

    public function test_detect_pro_when_only_pro_credentials(): void
    {
        $config = [
            'api_version' => 'auto',
            'pro' => ['api_token' => 'token123'],
            'standard' => ['api_key' => '', 'username' => ''],
        ];

        $version = $this->resolver->resolve($config);
        $this->assertEquals(ApiVersion::PRO, $version);
    }

    public function test_detect_standard_when_only_standard_credentials(): void
    {
        $config = [
            'api_version' => 'auto',
            'pro' => ['api_token' => ''],
            'standard' => ['api_key' => 'key123', 'username' => 'user'],
        ];

        $version = $this->resolver->resolve($config);
        $this->assertEquals(ApiVersion::STANDARD, $version);
    }

    public function test_pro_takes_priority_in_auto_detection(): void
    {
        $config = [
            'api_version' => 'auto',
            'pro' => ['api_token' => 'token123'],
            'standard' => ['api_key' => 'key123', 'username' => 'user'],
        ];

        $version = $this->resolver->resolve($config);
        $this->assertEquals(ApiVersion::PRO, $version);
    }

    public function test_throw_exception_when_no_credentials_for_auto(): void
    {
        $config = [
            'api_version' => 'auto',
            'pro' => ['api_token' => ''],
            'standard' => ['api_key' => '', 'username' => ''],
        ];

        $this->expectException(VersionDetectionException::class);
        $this->resolver->resolve($config);
    }
}
