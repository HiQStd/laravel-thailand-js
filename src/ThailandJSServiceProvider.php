<?php

namespace Baraear\ThailandJS;

use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;

class ThailandJSServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app instanceof LaravelApplication) {
            $this->publishes([
                __DIR__ . '/../config/thailandjs.php' => $this->app->configPath() . '/thailandjs.php',
            ], 'config');
            if (config('thailandjs.use-mix')) {
                $this->publishes([
                    __DIR__ . '/../libraries/jquery.Thailand.min.js' => $this->app->resourcePath() . "/assets/vendors/laravel-thailand-js/jquery.Thailand.min.js",
                    __DIR__ . '/../libraries/jquery.Thailand.min.css' => $this->app->resourcePath() . "/assets/vendors/laravel-thailand-js/jquery.Thailand.min.css",
                ], 'resources');
            } else {
                $this->publishes([
                    __DIR__ . '/../libraries/jquery.min.js' => $this->app->publicPath() . config('thailandjs.path.js') . "/jquery.min.js",
                    __DIR__ . '/../libraries/JQL.min.js' => $this->app->publicPath() . config('thailandjs.path.js') . "/JQL.min.js",
                    __DIR__ . '/../libraries/zip.js' => $this->app->publicPath() . config('thailandjs.path.js') . "/zip.js",
                    __DIR__ . '/../libraries/z-worker.js' => $this->app->publicPath() . config('thailandjs.path.js') . "/z-worker.js",
                    __DIR__ . '/../libraries/inflate.js' => $this->app->publicPath() . config('thailandjs.path.js') . "/inflate.js",
                    __DIR__ . '/../libraries/uikit.js' => $this->app->publicPath() . config('thailandjs.path.js') . "/uikit.js",
                    __DIR__ . '/../libraries/uikit.css' => $this->app->publicPath() . config('thailandjs.path.css') .  "/uikit.css",
                    __DIR__ . '/../libraries/typeahead.bundle.js' => $this->app->publicPath() . config('thailandjs.path.js') .  "/typeahead.bundle.js",
                    __DIR__ . '/../libraries/jquery.Thailand.min.js' => $this->app->publicPath() . config('thailandjs.path.js') .  "/jquery.Thailand.min.js",
                    __DIR__ . '/../libraries/jquery.Thailand.min.css' => $this->app->publicPath() . config('thailandjs.path.css') .  "/jquery.Thailand.min.css",
                    __DIR__ . '/../libraries/database' => $this->app->publicPath() . config('thailandjs.path.js') .  "/database",
                ], 'resources');
            }
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app instanceof LaravelApplication) {
            $this->mergeConfigFrom(
                __DIR__ . '/../config/thailandjs.php',
                'thailandjs'
            );
        }
    }
}
