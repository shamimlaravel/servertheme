<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Tests\Unit\Resolver;

use PHPUnit\Framework\TestCase;
use ShamimStack\ServerTheme\Core\Enums\ApiVersion;
use ShamimStack\ServerTheme\Core\Resolver\VersionResolver;
use ShamimStack\ServerTheme\Exceptions\VersionDetectionException;

class VersionResolverTest extends TestCase
{
    private VersionResolver $resolver;

    protected function setUp(): void
    {
        $this->resolver = new VersionResolver();
    }

    public function test_resolve_pro_version_explicit(): void
    {
        $config = ['api_version' => 'pro'];
        $version = $this->resolver->resolve($config);
        $this->assertEquals(ApiVersion::PRO, $version);
    }

    public function test_resolve_standard_version_explicit(): void
    {
        $config = ['api_version' => 'standard'];
        $version = $this->resolver->resolve($config);
        $this->assertEquals(ApiVersion::STANDARD, $version);
    }

    public function test_auto_detect_pro_when_token_present(): void
    {
        $config = [
            'api_version' => 'auto',
            'pro' => ['api_token' => 'some-token'],
            'standard' => ['api_key' => '', 'username' => ''],
        ];
        $version = $this->resolver->resolve($config);
        $this->assertEquals(ApiVersion::PRO, $version);
    }

    public function test_auto_detect_standard_when_credentials_present(): void
    {
        $config = [
            'api_version' => 'auto',
            'pro' => ['api_token' => ''],
            'standard' => ['api_key' => 'key', 'username' => 'user'],
        ];
        $version = $this->resolver->resolve($config);
        $this->assertEquals(ApiVersion::STANDARD, $version);
    }

    public function test_auto_detect_throws_exception_when_no_credentials(): void
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
