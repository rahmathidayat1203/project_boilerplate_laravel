<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
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
        try {
            $appName = Cache::rememberForever('app_name', function () {
                return Setting::where('key', 'app_name')->first()->value ?? config('app.name');
            });
            View::share('appName', $appName);
        } catch (\Exception $e) {
            View::share('appName', config('app.name'));
        }
    }
}
