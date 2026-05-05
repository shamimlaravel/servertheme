<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme;

use Illuminate\Support\ServiceProvider;

class ServerThemeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/servertheme.php',
            'servertheme'
        );

        $this->app->singleton('servertheme', function ($app) {
            return new ServerTheme();
        });

        $this->app->alias(ServerTheme::class, 'servertheme');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/servertheme.php' => config_path('servertheme.php'),
        ], 'servertheme-config');

        if (config('servertheme.log_orders', true)) {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        }

        if (config('servertheme.feedback_route_prefix')) {
            $this->loadRoutesFrom(__DIR__ . '/../routes/webhooks.php');
        }

        if ($this->app->runningInConsole()) {
            // Register commands if any
        }
    }
}
