<?php

namespace Scolabs\Docker;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;

class DockerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function register()
    {
        $this->app->make(ClientController::class);
        $this->loadViewsFrom(__DIR__ . '/views', 'docker');
        $this->loadTranslationsFrom(__DIR__ . '/translations', 'docker');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/routes.php';
    }
}
