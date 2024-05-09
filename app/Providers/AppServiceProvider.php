<?php

namespace App\Providers;

use App\Models\Backend\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // set default pagination css framework
        Paginator::useBootstrap();

        // get general settings
        $generalSetting = Setting::first();

        // set default timezone
        Config::set('app.timezone', $generalSetting->time_zone);

        // share general settings in view
        View::composer('*', function ($view) use ($generalSetting) {
            $view->with('setting', $generalSetting);
        });
    }
}
