<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Sms\SmsManager;
use App\Channels\SmsChannel;
use App\Payment\PaymentManager;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;
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
        // Sms facade
        $this->app->bind('sms', fn ($app) => new SmsManager($app));
        // Payment facade
        $this->app->bind('payment', fn ($app) => new PaymentManager($app));
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

        // URL::forceScheme('https');

        // Schema::defaultStringLength(125);
        // $this->app->bind('path.public', function () {
        //     return base_path() . '/../public_html/v2.sju.org.sa';
        // });
    }
}
