<?php

namespace App\Providers;

use App\Services\TelegramService;
use App\Services\TelegramServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->app->bind(TelegramServiceInterface::class, TelegramService::class);
    }
}
