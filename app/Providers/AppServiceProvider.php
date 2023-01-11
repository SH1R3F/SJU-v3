<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Sms\SmsManager;
use App\Channels\SmsChannel;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Notification;

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
        // Set a new notification channel
        Notification::extend('sms', function () {
            return new SmsChannel;
        });
    }
}
