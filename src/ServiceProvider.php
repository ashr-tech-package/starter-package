<?php

namespace Ashr\Starter;

use Ashr\Starter\Middleware\MicroserviceAccessMiddleware;
use Ashr\Starter\Services\MicroserviceServiceLayer;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        /**
         * Bootstrap the application services.
         *
         * @return void
         */
        $this->publishes([
            __DIR__.'/../config/microservice.php' => $this->app->configPath('microservice.php')
        ], 'ashr-starter');

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'ashr-starter');
    }

    /**
     * {@inheritDoc}
     */
    public function register()
    {
        app('router')->aliasMiddleware('can-access', MicroserviceAccessMiddleware::class);

        $this->mergeConfigFrom(__DIR__.'/../config/microservice.php', 'microservice');

        $this->app->singleton(MicroserviceServiceLayer::class, function (Container $app) {
            return new MicroserviceServiceLayer($app['config']['microservice']);
        });
    }
}