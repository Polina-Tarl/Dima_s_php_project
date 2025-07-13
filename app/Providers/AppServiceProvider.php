<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Здесь можно регистрировать сервисы или контейнерные биндинги
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Здесь настраиваются глобальные вещи, если нужно
    }
}
