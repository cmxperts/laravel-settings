<?php

namespace CmXperts\Settings;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;

class SettingsServiceProvider extends ServiceProvider
{

    public function boot(Router $router, Dispatcher $event)
    {
        if (!$this->app->routesAreCached()) {
            require  __DIR__ . '/../routes/web.php';
        }

        if ($this->app->runningInConsole()) {
            $this->publishResource();
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'cmxperts');

    }

    public function register()
    {
        // Register Resources
        $this->registerResource();
    }

    /**
     * Register Package Resource.
     *
     * @return void
     */
    protected function registerResource()
    {
        $this->loadMigrationsFrom(realpath(__DIR__ . '/../database/migrations'));
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'cmxperts');
        $this->registerRoutes();
    }

    protected function registerRoutes()
    {
        Route::middleware('web')
            ->namespace('CmXperts\\Settings\\Http\\Controllers')
            ->group(function () {
                require __DIR__ . '/../routes/web.php';
            });
    }

    /**
     * Publish Package Resource.
     *
     * @return void
     */
    protected function publishResource()
    {
        // Publish Config File
        $this->publishes([
            __DIR__ . '/../config/cmx_settings.php' => config_path('cmx_settings.php'),
        ], 'cmx-settings-config');
        // Publish View Files
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/cmxperts'),
        ], 'cmx-settings-views');
        // Publish Migration Files
        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'cmx-settings-migrations');
    }

}
