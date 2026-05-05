<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Tests\Feature;

use Orchestra\Testbench\TestCase;
use ShamimStack\ServerTheme\Core\Client;
use ShamimStack\ServerTheme\Core\Enums\ApiVersion;
use ShamimStack\ServerTheme\ServerThemeServiceProvider;

class MultiVersionIntegrationTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [ServerThemeServiceProvider::class];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('servertheme.api_version', 'pro');
        $app['config']->set('servertheme.pro', [
            'base_url' => 'https://api.example.com',
            'api_token' => 'test-token',
        ]);
    }

    public function test_client_can_be_instantiated(): void
    {
        $config = ['api_version' => 'pro'];
        $client = new Client($config);
        $this->assertInstanceOf(Client::class, $client);
    }

    public function test_api_version_enum_values(): void
    {
        $this->assertEquals('standard', ApiVersion::STANDARD->value);
        $this->assertEquals('pro', ApiVersion::PRO->value);
    }

    public function test_version_labels(): void
    {
        $this->assertStringContainsString('Legacy', ApiVersion::STANDARD->label());
        $this->assertStringContainsString('RESTful', ApiVersion::PRO->label());
    }
}
