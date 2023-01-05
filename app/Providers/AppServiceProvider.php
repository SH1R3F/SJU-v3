<?php

namespace App\Providers;

use App\Channels\SmsChannel;
use App\Sms\SmsManager;
use Illuminate\Support\Facades\Notification;
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
        $this->app->bind('sms', function ($app) {
            return new SmsManager($app);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Notification::extend('sms', function () {
            return new SmsChannel;
        });
    }
}
