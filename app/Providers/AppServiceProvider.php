<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\MessageRepository;
use App\Repositories\Contracts\MessageRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MessageRepositoryInterface::class, function ($app) {
            return new MessageRepository();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
