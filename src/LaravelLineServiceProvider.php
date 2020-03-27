<?php
/**
 * Created by naingminkhant
 * Date: 27/03/2020
 * Time: 16:31
 * Project: laravel-line
 */

namespace Arga\LaravelLine;

use Arga\LaravelLine\Contracts\LineManager;
use Illuminate\Support\ServiceProvider;

class LaravelLineServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $source = realpath(__DIR__.'/../config/laravel-line.php');
        $this->publishes([$source => $this->app->configPath('laravel-line.php')]);
        $this->mergeConfigFrom($source, 'laravel-line');
    }

    public function register()
    {
        $this->app->singleton(LineManager::class, LineService::class);
    }
}