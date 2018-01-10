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
                    __DIR__ . '/../libraries/JQL.min.js' => $this->app->resourcePath() . "/assets/vendors/laravel-thailand-js/JQL.min.js",
                    __DIR__ . '/../libraries/typeahead.bin.js' => $this->app->resourcePath() . "/assets/vendors/laravel-thailand-js/typeahead.bin.js",
                    __DIR__ . '/../libraries/zip.min.js' => $this->app->resourcePath() . "/assets/vendors/laravel-thailand-js/zip.min.js",
                    __DIR__ . '/../libraries/jquery.Thailand.min.js' => $this->app->resourcePath() . "/assets/vendors/laravel-thailand-js/jquery.Thailand.min.js",
                    __DIR__ . '/../libraries/jquery.Thailand.min.css' => $this->app->resourcePath() . "/assets/vendors/laravel-thailand-js/jquery.Thailand.min.css",
                ], 'resources');
            } else {
                $this->publishes([
                    __DIR__ . '/../libraries/JQL.min.js' => $this->app->publicPath() . "/js/laravel-thailand-js/JQL.min.js",
                    __DIR__ . '/../libraries/typeahead.bin.js' => $this->app->publicPath() . "/js/laravel-thailand-js/typeahead.bin.js",
                    __DIR__ . '/../libraries/zip.min.js' => $this->app->publicPath() . "/js/laravel-thailand-js/zip.min.js",
                    __DIR__ . '/../libraries/jquery.Thailand.min.js' => $this->app->publicPath() . "/js/laravel-thailand-js/jquery.Thailand.min.js",
                    __DIR__ . '/../libraries/jquery.Thailand.min.css' => $this->app->publicPath() . "/css/laravel-thailand-js/jquery.Thailand.min.css",
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
                __DIR__.'/../config/thailandjs.php',
                'thailandjs'
            );
        }
    }
}
