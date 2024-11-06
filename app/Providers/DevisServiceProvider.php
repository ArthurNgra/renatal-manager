<?php

namespace App\Providers;


use App\Services\DevisService;
use Illuminate\Support\ServiceProvider;

class DevisServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(DevisService::class, function ($app) {
            return new DevisService();
        });
    }

    public function boot(): void
    {
    }
}
